<?php
include('../includes/db_connection.php');
include('check_access.php');

$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $teacher_id = $user_id; // Teacher's ID from session
    $class_id = $_POST['class_id'];
    $assignment_title = $_POST['assignment_title'];
    $open_date = $_POST['open_date'];
    $close_date = $_POST['close_date'];

    // Prepare and bind (Using PDO's bindParam for binding variables)
    $stmt = $conn->prepare("INSERT INTO student_assignments (teacher_id, class_id, assignment_title, open_date, close_date, created_at) 
                            VALUES (:teacher_id, :class_id, :assignment_title, :open_date, :close_date, NOW())");

    // Bind the parameters
    $stmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
    $stmt->bindParam(':class_id', $class_id, PDO::PARAM_INT);
    $stmt->bindParam(':assignment_title', $assignment_title, PDO::PARAM_STR);
    $stmt->bindParam(':open_date', $open_date, PDO::PARAM_STR);
    $stmt->bindParam(':close_date', $close_date, PDO::PARAM_STR);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Assignment created successfully!";
    } else {
        echo "Error: " . $stmt->errorInfo()[2]; // For detailed error message
    }

    $stmt->close();
    $conn = null; // Close the connection
}
?>
