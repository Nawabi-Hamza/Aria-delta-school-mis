<?php
// Database connection
include("../includes/db_connection.php");

// Enable error reporting for debugging SQL issues
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Global variable to track the class-hour assignments
$class_hour_map = [];

// Function to fetch class's subject assignments from the main-table
function fetchClassAssignments($class_id) {
    global $conn;

    // Query to get the class's schedule (subject, teacher) from the main-table
    $sql = "
        SELECT 
            mt.class_id,
            mt.sub_id,
            mt.teacher_id,
            s.subject_name,
            t.teacherName
        FROM
            `main-table` mt
        JOIN subjects s ON mt.sub_id = s.id
        JOIN teachers t ON mt.teacher_id = t.id
        WHERE mt.class_id = ? 
        ORDER BY mt.sub_id";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $assignments = [];

    while ($row = $result->fetch_assoc()) {
        $assignments[] = [
            'teacher_id' => $row['teacher_id'],
            'sub_id' => $row['sub_id'],
            'subject_name' => $row['subject_name'],
            'teacher_name' => $row['teacherName'],
            'class_id' => $row['class_id']
        ];
    }
    return $assignments;
}

// Function to fetch subject details (including duration)
function fetchSubjects($subject_ids) {
    global $conn;

    // If no subject IDs are provided, return an empty array
    if (empty($subject_ids)) {
        return [];
    }

    // Prepare the subject ids for the query
    $subject_ids_placeholder = implode(',', array_fill(0, count($subject_ids), '?'));
    $sql = "SELECT id, subject_name, subject_duration FROM subjects WHERE id IN ($subject_ids_placeholder)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('SQL Error: ' . $conn->error);
    }

    // Bind the subject ids
    $stmt->bind_param(str_repeat('i', count($subject_ids)), ...$subject_ids);
    $stmt->execute();
    $result = $stmt->get_result();

    $subjects = [];
    while ($row = $result->fetch_assoc()) {
        $subjects[$row['id']] = [
            'subject_name' => $row['subject_name'],
            'subject_duration' => $row['subject_duration']
        ];
    }

    return $subjects;
}

// Function to check if the teacher is already scheduled in the same time slot
function isTeacherAvailable($day, $hour_index, $teacher) {
    global $class_hour_map;

    // Check if the teacher already has a class in this time slot
    return !isset($class_hour_map[$day][$hour_index]) || $class_hour_map[$day][$hour_index]['teacher'] !== $teacher;
}

// Function to save schedule to teacher_schedule table
function saveScheduleToTeacherSchedule($teacher_id, $day, $hour, $class_id, $subject_id) {
    global $conn;

    // Prepare the SQL query to insert the schedule into the teacher_schedule table
    $sql = "INSERT INTO teacher_schedule (teacher_id, `day`, `hour`, class_id, subject_id) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('SQL Error: ' . $conn->error);
    }
    // Bind parameters and execute the query
    $stmt->bind_param("isiii", $teacher_id, $day, $hour, $class_id, $subject_id);
    $stmt->execute();
}

// Function to check if a schedule already exists
function isScheduleGenerated() {
    global $conn;

    $sql = "SELECT COUNT(*) AS count FROM teacher_schedule";
    $result = $conn->query($sql);
    
    if ($result) {
        $row = $result->fetch_assoc();
        return $row['count'] > 0; // If count > 0, timetable already exists
    }

    return false; // If query fails, assume timetable is not generated
}

// Check before generating a new schedule
if (!isScheduleGenerated()) {
    generateWeeklyScheduleForAllClasses();
} else {
    echo "<h2>Timetable is already generated.</h2>";
}


// Function to generate weekly schedule for all classes and save to teacher_schedule table
function generateWeeklyScheduleForAllClasses() {
    global $conn, $class_hour_map;

    // Query to get all unique class IDs from the main-table
    $sql = "SELECT DISTINCT class_id FROM `main-table`";
    $result = $conn->query($sql);

    if ($result === false) {
        die("SQL Error: " . $conn->error);
    }

    if ($result->num_rows == 0) {
        echo "No classes found in the main-table.<br>";
        return;
    }

    // Begin the transaction
    $conn->begin_transaction();

    try {
        // Loop through all classes
        while ($class = $result->fetch_assoc()) {
            $class_id = $class['class_id'];

            // Fetch the class's subject schedule (all subjects assigned to the class)
            $assignments = fetchClassAssignments($class_id);

            if (empty($assignments)) {
                echo "No subjects assigned to class $class_id.<br>";
                continue;
            }

            // Get the subject IDs assigned to the class
            $subject_ids = array_map(function ($item) {
                return $item['sub_id'];
            }, $assignments);

            // Fetch the subjects and their durations
            $subjects = fetchSubjects($subject_ids);

            // Initialize a weekly schedule for the class (6 days, 6 hours each day)
            $weekly_schedule = [
                "Saturday" => [null, null, null, null, null, null],
                "Sunday" => [null, null, null, null, null, null],
                "Monday" => [null, null, null, null, null, null],
                "Tuesday" => [null, null, null, null, null, null],
                "Wednesday" => [null, null, null, null, null, null],
                "Thursday" => [null, null, null, null, null, null],
                "Friday" => [null, null, null, null, null, null],
            ];

            // Randomly shuffle the assignments and distribute them
            shuffle($assignments);

            // Loop through the assigned subjects and allocate them across the week
            foreach ($assignments as $assignment) {
                $subject = $assignment['subject_name'];
                $teacher = $assignment['teacher_name'];
                $subject_duration = $subjects[$assignment['sub_id']]['subject_duration'];
                $teacher_id = $assignment['teacher_id']; // Get teacher ID
                $subject_id = $assignment['sub_id']; // Get subject ID

                // Track how many hours have been assigned for this subject
                $subject_assigned = 0;

                // Loop through the days
                foreach ($weekly_schedule as $day => &$hours) {
                    // If the subject has remaining hours to be assigned
                    if ($subject_assigned < $subject_duration) {
                        // Find free slots (empty hours) in this day
                        $free_slots = array_filter($hours, function ($v) { return $v === null; });

                        // If there are free slots available
                        if (count($free_slots) > 0) {
                            // Assign subject to free slots until its full duration is met
                            foreach ($hours as $hour_index => &$hour) {
                                if ($hour === null && $subject_assigned < $subject_duration) {
                                    // Check if the teacher is already assigned in the same hour on this day across any class
                                    $teacher_assigned = false;

                                    // Check all the previous classes for the teacher's availability at this hour and day
                                    if (isset($class_hour_map[$day][$hour_index])) {
                                        if ($class_hour_map[$day][$hour_index]['teacher'] === $teacher) {
                                            $teacher_assigned = true;
                                        }
                                    }

                                    // If the teacher is already assigned, skip this hour
                                    if ($teacher_assigned) {
                                        continue;
                                    }

                                    // Assign the subject and teacher to this slot
                                    $hour = ['subject' => $subject, 'teacher' => $teacher];
                                    $class_hour_map[$day][$hour_index] = ['teacher' => $teacher, 'subject' => $subject];
                                    $subject_assigned++;

                                    // Save this assignment to teacher_schedule table
                                    saveScheduleToTeacherSchedule($teacher_id, $day, $hour_index + 1, $class_id, $subject_id);

                                    // Break if we've assigned enough hours for this subject
                                    if ($subject_assigned >= $subject_duration) {
                                        break 2; // Break out of both the inner and outer loops
                                    }
                                }
                            }
                        }
                    }
                }

                // If the subject was not assigned its full duration, retry or log an error
                if ($subject_assigned < $subject_duration) {
                    echo "Unable to assign full duration for subject: $subject. Only $subject_assigned hours assigned.<br>";
                }
            }

            // Print the schedule for the class
            echo "<h2>Weekly Schedule for Class: $class_id</h2>";
            echo "<table border='1' cellpadding='5' cellspacing='0'>";
            echo "<tr><th>Day</th><th>Hour 1</th><th>Hour 2</th><th>Hour 3</th><th>Hour 4</th><th>Hour 5</th><th>Hour 6</th></tr>";

            // Output each day's schedule
            foreach ($weekly_schedule as $day => $hours) {
                echo "<tr><td>" . $day . "</td>";
                foreach ($hours as $hour) {
                    if ($hour === null) {
                        echo "<td>No class</td>";
                    } else {
                        echo "<td>" . $hour['subject'] . "<br>Teacher: " . $hour['teacher'] . "</td>";
                    }
                }
                echo "</tr>";
            }

            echo "</table><br>";
        }

        // Commit the transaction
        $conn->commit();

    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();
        echo "Failed to generate schedule: " . $e->getMessage();
    }
}

// Example usage - generate weekly schedule for all classes
generateWeeklyScheduleForAllClasses();

// Close the connection
$conn->close();
?>
