<?php
// include("../includes/db_connection.php");

// Database connection details
$host = 'localhost';
$username = 'root';
$password = 'mysqlroot';
$dbname = 'school';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle payment update or insert
if (isset($_POST['btn-payment'])) {
    $student_id = $_POST['student_id'];
    $month = $_POST['month'];
    $paid = $_POST['paid'];
    $due = $_POST['due'];
    $discount = $_POST['discount'];

    // Ensure month is properly set for paid and due columns
    $column_paid = $month . '_total_paid';
    $column_due = $month . '_total_due';

    // Check if the student already has a record in monthly_payments table
    $check_query = "SELECT * FROM monthly_payments WHERE student_id = ?";
    $check_stmt = $conn->prepare($check_query);
    
    if ($check_stmt === false) {
        die('Error preparing check query: ' . $conn->error);
    }
    
    $check_stmt->bind_param("i", $student_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    // Check if the student exists in the students table
    $check_student_query = "SELECT id FROM students WHERE id = ?";
    $check_student_stmt = $conn->prepare($check_student_query);
    $check_student_stmt->bind_param("i", $student_id);
    $check_student_stmt->execute();
    $check_student_result = $check_student_stmt->get_result();

    if ($check_student_result->num_rows > 0) {
        // Student exists, proceed with insert or update
        if ($result->num_rows > 0) {
            $student_id = $_POST['student_id'];
            $month = $_POST['month'];  // Example: 3 for March
            $paid = $_POST['paid']; 
            $discount = $_POST['discount'];

            // Generate column names dynamically
            $month_name = strtolower(date("F", mktime(0, 0, 0, $month, 1))); // e.g., "march"
            $column_paid = "{$month_name}_total_paid";
            $column_due = "{$month_name}_total_due";

            // Prepare SQL query
            $query = "UPDATE monthly_payments 
                    SET 
                        $column_paid = ?,
                        total_paid = COALESCE(january_total_paid, 0) + COALESCE(february_total_paid, 0) + COALESCE(march_total_paid, 0) + COALESCE(april_total_paid, 0),
                        total_due = (2000 * ?) - total_paid,
                        $column_due = total_due  -- Update only the current month's due
                        -- discount = ?
                    WHERE student_id = 3";

            $stmt = $conn->prepare($query);
            $stmt->bind_param("didi", $paid, $month, $discount, $student_id);

            if ($stmt->execute()) {
                echo "Payment updated successfully ✔️";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            // Insert new record for the specific month
            $insert_query = "INSERT INTO monthly_payments (student_id, $column_paid, $column_due, discount) VALUES (?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bind_param("dddi", $paid, $due, $discount, $student_id);
            
            if ($insert_stmt->execute()) {
                echo "New record has been inserted ✔️";
            } else {
                echo "Error: " . $insert_stmt->error;
            }
        }
        
        // Now, calculate and update the total dues and total paid across all months in the `monthly_payments` table
        $total_paid = 0;
        $total_due = 0;

        // Sum all paid and due amounts across all months
        $sum_query = "SELECT * FROM monthly_payments WHERE student_id = ?";
        $sum_stmt = $conn->prepare($sum_query);
        $sum_stmt->bind_param("i", $student_id);
        $sum_stmt->execute();
        $sum_result = $sum_stmt->get_result();

        while ($payment = $sum_result->fetch_assoc()) {
            foreach ($payment as $key => $value) {
                if (strpos($key, '_total_paid') !== false) {
                    $total_paid += (float)$value;
                }
                if (strpos($key, '_total_due') !== false) {
                    $total_due += (float)$value;
                }
            }
        }

        // Update the total_paid and total_due columns in the `monthly_payments` table for this student
        $update_total_query = "UPDATE monthly_payments SET paid = ?, total_due = ? WHERE student_id = ?";
        $update_total_stmt = $conn->prepare($update_total_query);

        // Check if the prepared statement was created successfully
        if ($update_total_stmt === false) {
            die('Error preparing the update total query: ' . $conn->error);
        }

        $update_total_stmt->bind_param("ddi", $paid, $total_due, $student_id);
        
        // Execute the update statement
        if ($update_total_stmt->execute()) {
            echo "Total paid and due updated ✔️";
        } else {
            echo "Error updating total paid and due: " . $update_total_stmt->error;
        }

        // Insert total_due in the last month (for example, February) in the `monthly_payments` table
        $last_entry_update_query = "UPDATE monthly_payments SET $column_due = ? WHERE student_id = ? ORDER BY id DESC LIMIT 1";
        $last_entry_update_stmt = $conn->prepare($last_entry_update_query);
        $last_entry_update_stmt->bind_param("di", $total_due, $student_id);

        if ($last_entry_update_stmt->execute()) {
            echo "Last entry's due column updated with total due ✔️";
        } else {
            echo "Error updating last entry's due column: " . $last_entry_update_stmt->error;
        }

    } else {
        // Student does not exist, handle the error or notify the user
        echo "Error: Student ID does not exist in the database.";
    }

    // Close prepared statements
    $check_stmt->close();
    $check_student_stmt->close();
}

// Fetch students from the database
// $sql_students = "SELECT students.*, classes.class_name, classes.grade_level, classes.class_fee 
//                  FROM students 
//                  INNER JOIN classes ON students.class_id = classes.id";
// $result_students = $conn->query($sql_students);

// Check if the query executed successfully
// if ($result_students === false) {
//     die('Error fetching students: ' . $conn->error);
// }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Payments</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .mb-3 {
            background: #e7eef0;
            border-radius: 0px 0px 10px;
            padding: 20px;
            width: 30vw;
            text-align: center;
            position: relative;
            left: 20rem;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }
    </style>
</head>
<body>

<!-- Student Table -->
<div class="container">
    <h2 class="mb-3">Student Payment Details</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Father Name</th>
                <th>Class</th>
                <th>Grade Level</th>
                <?php 
                    $months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
                    foreach ($months as $month): 
                ?>
                    <th><?= ucfirst($month) ?> Paid</th>
                    <th><?= ucfirst($month) ?> Due</th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
        <?php 
        // Fetch student details and display them in the table
        // while ($student = $result_students->fetch_assoc()): 
        //     // Fetch the payment details for each student
        //     $sql_payments = "SELECT * FROM monthly_payments WHERE student_id = '" . $student['id'] . "'";
        //     $result_payments = $conn->query($sql_payments);
        //     $payments = ($result_payments->num_rows > 0) ? $result_payments->fetch_assoc() : [];

        //     foreach ($months as $month) {
        //         if (!isset($payments[$month . '_total_paid'])) $payments[$month . '_total_paid'] = 'N/A';
        //         if (!isset($payments[$month . '_total_due'])) $payments[$month . '_total_due'] = 'N/A';
        //     }
        ?>
            <tr>
                <td><?= $student['id'] ?></td>
                <td><?= $student['name'] . " " . $student['lastname'] ?></td>
                <td><?= $student['father_name'] ?></td>
                <td><?= $student['class_name'] ?></td>
                <td><?= $student['grade_level'] ?></td>

                <?php // foreach ($months as $month): ?>
                    <td>
                        <?= $payments[$month . '_total_paid'] ?>
                        <button class="btn btn-outline-primary btn-sm edit-btn"
                                data-month="<?= $month ?>"
                                data-student-id="<?= $student['id'] ?>"
                                data-student-name="<?= $student['name'] . ' ' . $student['lastname'] ?>"
                                data-class-fee="<?= $student['class_fee'] ?>"
                                data-paid="<?= $payments[$month . '_total_paid'] ?>"
                                data-due="<?= $payments[$month . '_total_due'] ?>"
                                data-toggle="modal"
                                data-target="#payModal">Edit</button>      
                    </td>
                    <td><?= $payments[$month . '_total_due'] ?></td>
                <?php // endforeach; ?>
            </tr>
        <?php // endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Modal to Edit Payment -->
<div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="payModalLabel">Edit Payment for <span id="studentName"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <input type="hidden" id="student_id" name="student_id">
                    <input type="hidden" id="month" name="month">

                    <div class="form-group">
                        <label for="paid">Paid Amount</label>
                        <input type="number" class="form-control" id="paid" name="paid" required>
                    </div>

                    <div class="form-group">
                        <label for="due">Due Amount</label>
                        <input type="number" class="form-control" id="due" name="due" required>
                    </div>

                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="number" class="form-control" id="discount" name="discount">
                    </div>

                    <button type="submit" name="btn-payment" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Populate modal with student details
    $('.edit-btn').click(function() {
        var studentId = $(this).data('student-id');
        var studentName = $(this).data('student-name');
        var month = $(this).data('month');
        var paid = $(this).data('paid');
        var due = $(this).data('due');
        var classFee = $(this).data('class-fee');

        $('#student_id').val(studentId);
        $('#month').val(month);
        $('#studentName').text(studentName);
        $('#paid').val(paid);
        $('#due').val(due);
    });
</script>

</body>
</html>
