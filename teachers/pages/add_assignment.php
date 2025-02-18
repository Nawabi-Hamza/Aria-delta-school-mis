<?php
include('../includes/db_connection.php');
include('check_access.php');

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get selected class IDs and subject IDs
    $class_ids = $_POST['class_id']; // Array of selected class IDs
    $subject_ids = $_POST['subject_id']; // Array of selected subject IDs
    $assignment_title = $_POST['assignment_title'];
    $open_date = $_POST['open_date'];
    $close_date = $_POST['close_date'];
    $teacher_id = $_SESSION['user_id'];

    // Loop through each class and subject to insert the assignment
    foreach ($class_ids as $class_id) {
        foreach ($subject_ids as $subject_id) {
            // Prepare the SQL statement
            $sql = "INSERT INTO assignments (teacher_id, class_id, subject_id, assignment_title, open_date, close_date, created_at) 
                    VALUES (:teacher_id, :class_id, :subject_id, :assignment_title, :open_date, :close_date, NOW())";

            // Prepare the statement
            $stmt = $conn->prepare($sql);

            // Bind the parameters
            $stmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
            $stmt->bindParam(':class_id', $class_id, PDO::PARAM_INT);
            $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
            $stmt->bindParam(':assignment_title', $assignment_title, PDO::PARAM_STR);
            $stmt->bindParam(':open_date', $open_date, PDO::PARAM_STR);
            $stmt->bindParam(':close_date', $close_date, PDO::PARAM_STR);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Assignment created successfully!<br>";
            } else {
                echo "Error: " . implode(", ", $stmt->errorInfo()) . "<br>";
            }
        }
    }

    // Close the connection
    $stmt = null;
    $conn = null;
}

// Fetch Classes based on teacher_id
$sql_classes = "SELECT c.id, c.class_name FROM classes c
                JOIN classes_teachers ct ON c.id = ct.class_id
                WHERE ct.teacher_id = :teacher_id";
$stmt_classes = $conn->prepare($sql_classes);
$stmt_classes->bindParam(':teacher_id', $user_id, PDO::PARAM_INT);
$stmt_classes->execute();
$result_classes = $stmt_classes->fetchAll(PDO::FETCH_ASSOC);

// Fetch Subjects based on teacher_id
$sql_subjects = "SELECT s.id, s.subject_name FROM subjects s
                 JOIN subjects_teachers st ON s.id = st.subject_id
                 WHERE st.teacher_id = :teacher_id";
$stmt_subjects = $conn->prepare($sql_subjects);
$stmt_subjects->bindParam(':teacher_id', $user_id, PDO::PARAM_INT);
$stmt_subjects->execute();
$result_subjects = $stmt_subjects->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Form</title>
</head>
<body>
    <h2>Insert Assignment</h2>

    <form action="insert_assignment.php" method="POST">
        <!-- Class Selection as Checkboxes -->
        <label>Select Classes:</label><br>
        <?php
        if (count($result_classes) > 0) {
            // Loop through each class and display as a checkbox
            foreach ($result_classes as $row) {
                echo "<input type='checkbox' name='class_id[]' value='{$row['id']}'> {$row['class_name']}<br>";
            }
        } else {
            echo "<p>No classes found for your teacher ID.</p>";
        }
        ?>

        <br><br>

        <!-- Subject Selection as Checkboxes -->
        <label>Select Subjects:</label><br>
        <?php
        if (count($result_subjects) > 0) {
            // Loop through each subject and display as a checkbox
            foreach ($result_subjects as $row) {
                echo "<input type='checkbox' name='subject_id[]' value='{$row['id']}'> {$row['subject_name']}<br>";
            }
        } else {
            echo "<p>No subjects found for your teacher ID.</p>";
        }
        ?>

        <br><br>

        <!-- Assignment Title -->
        <label for="assignment_title">Assignment Title:</label>
        <input type="text" name="assignment_title" id="assignment_title" required><br><br>

        <!-- Open Date -->
        <label for="open_date">Open Date:</label>
        <input type="datetime-local" name="open_date" id="open_date" required><br><br>

        <!-- Close Date -->
        <label for="close_date">Close Date:</label>
        <input type="datetime-local" name="close_date" id="close_date" required><br><br>

        <!-- Submit Button -->
        <input type="submit" value="Insert Assignment">
    </form>
</body>
</html>

<?php
$stmt_classes = null;
$stmt_subjects = null;
$conn = null;
?>
