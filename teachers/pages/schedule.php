<?php
// Step 1: Database connection (adjust as needed for your DB)
$mysqli = new mysqli("localhost", "root", "", "school");

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Step 2: Fetch the IDs from `main-table` (with backticks)
$query = "SELECT id FROM `main-table`";  // Ensure backticks around table name
$result = $mysqli->query($query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $mysqli->error);
}

$ids = [];
while ($row = $result->fetch_assoc()) {
    $ids[] = $row['id'];
}

// Step 3: Fetch related data from other tables (using backticks around table names)
$subjects = [];
$teachers = [];
$rooms = [];
foreach ($ids as $id) {
    $subjectQuery = "SELECT * FROM `subjects` WHERE id = '$id'";
    $teacherQuery = "SELECT * FROM `teachers` WHERE id = '$id'";


    $subjectResult = $mysqli->query($subjectQuery);
    $teacherResult = $mysqli->query($teacherQuery);


    // Check if each query is successful
    if (!$subjectResult) {
        die("Subject query failed: " . $mysqli->error);
    }
    if (!$teacherResult) {
        die("Teacher query failed: " . $mysqli->error);
    }
   

    while ($row = $subjectResult->fetch_assoc()) {
        $subjects[] = $row;
    }
    while ($row = $teacherResult->fetch_assoc()) {
        $teachers[] = $row;
    }
  
}

// Step 4: Create Weekly Timetable
$weeklyTimetable = [];
$daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];  // You can modify this as per your requirement
$hoursPerDay = 6; // 6 hours per day
$maxHoursPerTeacherPerWeek = 2; // 2 hours per teacher per week

// Initialize empty timetable with 6 hours per day and 5 days
foreach ($teachers as $teacher) {
    $teacherId = $teacher['id'];
    $teacherName = $teacher['teacherName'];

    // Initialize the timetable for the teacher (6 hours per day, 5 days)
    $teacherTimetable = array_fill_keys($daysOfWeek, array_fill(0, $hoursPerDay, null));

    // Allocate subjects to teachers, ensuring each teacher teaches a total of 2 hours per week
    $allocatedHours = 0;
    foreach ($subjects as $subject) {
        $subjectId = $subject['id'];
        $subjectName = $subject['subject_name'];

        // Try to allocate this subject to 2 hours in the timetable
        for ($day = 0; $day < count($daysOfWeek); $day++) {
            for ($hour = 0; $hour < $hoursPerDay; $hour++) {
                if ($allocatedHours < $maxHoursPerTeacherPerWeek && $teacherTimetable[$daysOfWeek[$day]][$hour] === null) {
                    $teacherTimetable[$daysOfWeek[$day]][$hour] = [
                        'subject' => $subjectName,
                        'teacher' => $teacherName
                    ];
                    $allocatedHours++;

                    // Break out of the loop once the teacher has been allocated 2 hours for the week
                    if ($allocatedHours >= $maxHoursPerTeacherPerWeek) {
                        break 2;
                    }
                }
            }
        }
    }

    // Add this teacher's timetable to the overall weekly timetable
    $weeklyTimetable[$teacherName] = $teacherTimetable;
}

// Step 5: Print the timetable in a structured way
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Teacher</th><th>Time Slot</th><th>Subject</th><th>Room</th></tr>"; // Heading Row

// Loop through each teacher's timetable and print it
foreach ($weeklyTimetable as $teacherName => $teacherTimetable) {
    foreach ($teacherTimetable as $day => $hours) {
        foreach ($hours as $hour => $lesson) {
            if ($lesson !== null) {
                // Printing each subject the teacher is assigned to
                echo "<tr>";
                echo "<td>" . $teacherName . "</td>";
                echo "<td>" . $day . " - Hour " . ($hour + 1) . "</td>";
                echo "<td>" . $lesson['subject'] . "</td>";
                echo "<td>" . "Room" . rand(101, 199) . "</td>"; // Assuming random room allocation for simplicity
                echo "</tr>";
            }
        }
    }
}

echo "</table>";

// Step 6: Close the DB connection
$mysqli->close();

?>
