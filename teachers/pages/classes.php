


<title>Teachers | Classes</title>


<?php

// Database connection
$host = "localhost"; // Your database host
$dbname = "school"; // Your database name
$username = "root"; // Your database username
$password = ""; // Your database password
include('check_access.php');  

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Assuming $user_id is provided
$user_id = $_SESSION['user_id'];

// Step 1: Get teacher_id from teachers table
$query = "SELECT id FROM teachers WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($teacher_id);

// Check if the teacher exists
if ($stmt->num_rows > 0) {
    $stmt->fetch();

    // Step 2: Get subject_ids from subjects_teachers table for that teacher_id
    $subject_query = "SELECT subject_id FROM subjects_teachers WHERE teacher_id = ?";
    $subject_stmt = $conn->prepare($subject_query);
    $subject_stmt->bind_param("i", $teacher_id);
    $subject_stmt->execute();
    $subject_stmt->store_result();
    $subject_stmt->bind_result($subject_id);

    // Step 3: Fetch subject names from subjects table
    if ($subject_stmt->num_rows > 0) {
        echo "<div class='timetable-container animate__animated animate__fadeInUp animate__delay-0.5s'>";
        echo "<h2>Timetable for Teacher ID $teacher_id</h2>";
        echo "<table>";
        echo "<tr><th>Subject Name</th></tr>"; // Table header

        while ($subject_stmt->fetch()) {
            $subject_name_query = "SELECT subject_name FROM subjects WHERE id = ?";
            $subject_name_stmt = $conn->prepare($subject_name_query);
            $subject_name_stmt->bind_param("i", $subject_id);
            $subject_name_stmt->execute();
            $subject_name_stmt->store_result();
            $subject_name_stmt->bind_result($subject_name);
            
            // Fetch the subject name
            if ($subject_name_stmt->num_rows > 0) {
                $subject_name_stmt->fetch();
                echo "<tr><td>$subject_name</td></tr>";
            }
        }

        echo "</table>";
        echo "</div>";
    } else {
        echo "No subjects found for teacher ID $teacher_id.<br>";
    }
} else {
    echo "Teacher not found with ID $user_id.<br>";
}

// Close connections
$stmt->close();
$subject_stmt->close();
$subject_name_stmt->close();
$conn->close();
?>

<!-- Add CSS styling -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .timetable-container {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 60%;
        text-align: center;
    }

    h2 {
        color: #333;
        font-size: 1.8em;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    tr:hover {
        background-color: #f1f1f1;
    }
</style>

