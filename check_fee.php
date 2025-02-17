


<?php
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

    if (isset($_POST["btn-payment"])) {
        $student_id = (int) $_POST['student_id'];
        $month = (int) $_POST['month'];  // Example: 3 for March
        $paid = (int) $_POST['paid']; 
    
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
                    january_total_due = 0,
                    february_total_due = 0,
                    march_total_due = 0,
                    april_total_due = 0,
                    $column_due = total_due  
                WHERE student_id = 3";
    
        $stmt = $conn->prepare($query);
    
        if (!$stmt) {
            die("SQL Error: " . $conn->error);
        }
    
        // Bind only 2 parameters (not 4)
        $stmt->bind_param("di", $paid, $month);
    
        if ($stmt->execute()) {
            echo "Payment updated successfully ✔️";
        } else {
            echo "Error: " . $stmt->error;
        }
    
        $stmt->close();
    }
    

?>


<form method="post" action="">
    <input type="hidden" id="student_id" name="student_id">
    <div class="form-group">
        <select name="month" id="month">
        <script>
            let html = ''
            let months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
            months.forEach(month => {
                html += `<option value="${months.indexOf(month) + 1}">${month.charAt(0).toUpperCase() + month.slice(1)}</option>`
            });
            document.getElementById("month").insertAdjacentHTML("beforeend", html);
        </script>
        </select>
    </div>
    <!-- <input type="number" value="3" id="month"  name="month"> -->

    <div class="form-group">
        <label for="paid">Paid Amount</label>
        <input type="number" class="form-control" id="paid" name="paid" required>
    </div>

    <!-- <div class="form-group">
        <label for="due">Due Amount</label>
        <input type="number" class="form-control" id="due" name="due" required>
    </div> -->

    <div class="form-group">
        <label for="discount">Discount</label>
        <input type="number" class="form-control" id="discount" name="discount">
    </div>

    <button type="submit" name="btn-payment" class="btn btn-primary">Save</button>
</form>

