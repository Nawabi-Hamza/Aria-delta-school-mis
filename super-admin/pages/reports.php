<?php

include('../includes/db_connection.php'); 
include('check_access.php'); 

$adminId = $user_id;


$today = new DateTime();
$currentMonthStart = new DateTime('first day of this month');
$currentMonthEnd = new DateTime('last day of this month');


function getReport($period, $adminId, $conn, $selectedMonth = null) {
    global $today, $currentMonthStart, $currentMonthEnd;  


    $selectedMonthDate = DateTime::createFromFormat('Y-m', $selectedMonth);

    if ($selectedMonthDate > $today) {
        return "No data available for future months.";
    }

    
    if ($period == 'daily') {
        if ($selectedMonthDate == $today) {
          
            $query = "
                SELECT COUNT(*) AS customer_count, DATE(customers.create_at) AS date
                FROM customers
                JOIN staff ON customers.staff_id = staff.id
                WHERE customers.create_at BETWEEN ? AND ? 
                AND staff.superadmin_id = ? 
                GROUP BY DATE(customers.create_at)";
            
            $stmt = $conn->prepare($query);
            if ($stmt === false) {
                die('Error preparing query: ' . $conn->error);
            }
            $stmt->bind_param("sss", $currentMonthStart->format('Y-m-d'), $currentMonthEnd->format('Y-m-d'), $adminId);
        } else {
          
            $startOfMonth = $selectedMonthDate->format('Y-m-01');
            $endOfMonth = $selectedMonthDate->modify('first day of next month')->format('Y-m-d');
            
            $query = "
                SELECT COUNT(*) AS customer_count, DATE(customers.create_at) AS date
                FROM customers
                JOIN staff ON customers.staff_id = staff.id
                WHERE customers.create_at >= ? AND customers.create_at < ? 
                AND staff.superadmin_id = ? 
                GROUP BY DATE(customers.create_at)";
            
            $stmt = $conn->prepare($query);
            if ($stmt === false) {
                die('Error preparing query: ' . $conn->error);
            }
            $stmt->bind_param("sss", $startOfMonth, $endOfMonth, $adminId);
        }

     
        $stmt->execute();
        $result = $stmt->get_result();

        if ($selectedMonthDate == $today) {
   
            $customerCount = 0;
            while ($row = $result->fetch_assoc()) {
                $customerCount += $row['customer_count'];
            }
            return $customerCount;
        } else {
          
            $totalCount = 0;
            $daysCount = 0;
            while ($row = $result->fetch_assoc()) {
                $totalCount += $row['customer_count'];
                $daysCount++;
            }
            return ($daysCount > 0) ? round($totalCount / $daysCount) : 0;
        }
    } elseif ($period == 'weekly') {
        if ($selectedMonthDate == $today) {
        
            $query = "
                SELECT COUNT(*) AS customer_count, WEEK(customers.create_at) AS week
                FROM customers
                JOIN staff ON customers.staff_id = staff.id
                WHERE customers.create_at BETWEEN ? AND ? 
                AND staff.superadmin_id = ? 
                GROUP BY WEEK(customers.create_at)";
            
            $stmt = $conn->prepare($query);
            if ($stmt === false) {
                die('Error preparing query: ' . $conn->error);
            }
            $stmt->bind_param("sss", $currentMonthStart->format('Y-m-d'), $currentMonthEnd->format('Y-m-d'), $adminId);
        } else {
      
            $startOfMonth = $selectedMonthDate->format('Y-m-01');
            $endOfMonth = $selectedMonthDate->modify('first day of next month')->format('Y-m-d');
            
            $query = "
                SELECT COUNT(*) AS customer_count, WEEK(customers.create_at) AS week
                FROM customers
                JOIN staff ON customers.staff_id = staff.id
                WHERE customers.create_at >= ? AND customers.create_at < ? 
                AND staff.superadmin_id = ? 
                GROUP BY WEEK(customers.create_at)";
            
            $stmt = $conn->prepare($query);
            if ($stmt === false) {
                die('Error preparing query: ' . $conn->error);
            }
            $stmt->bind_param("sss", $startOfMonth, $endOfMonth, $adminId);
        }

   
        $stmt->execute();
        $result = $stmt->get_result();

        if ($selectedMonthDate == $today) {
       
            $customerCount = 0;
            while ($row = $result->fetch_assoc()) {
                $customerCount += $row['customer_count'];
            }
            return $customerCount;
        } else {
       
            $totalCount = 0;
            $weeksCount = 0;
            while ($row = $result->fetch_assoc()) {
                $totalCount += $row['customer_count'];
                $weeksCount++;
            }
            return ($weeksCount > 0) ? round($totalCount / $weeksCount) : 0;
        }
    } elseif ($period == 'monthly') {
    
        $startOfMonth = $selectedMonthDate->format('Y-m-01');
        $endOfMonth = $selectedMonthDate->modify('first day of next month')->format('Y-m-d');
        
        $query = "
            SELECT COUNT(*) AS customer_count
            FROM customers
            JOIN staff ON customers.staff_id = staff.id
            WHERE customers.create_at >= ? AND customers.create_at < ? 
            AND staff.superadmin_id = ?";
        
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            die('Error preparing query: ' . $conn->error);
        }
        $stmt->bind_param("sss", $startOfMonth, $endOfMonth, $adminId);

        
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        return $row['customer_count'];
    } else {
        return "Invalid period selected";
    }
}


$period = isset($_POST['period']) ? $_POST['period'] : 'daily'; 


$selectedMonth = isset($_POST['month']) ? $_POST['month'] : $today->format('Y-m'); 

?>

    

<div class="bg-white mb-4 rounded rounded-3 shadow animate__animated animate__fadeInUp animate__delay-0.5s">
    <div class="container p-4">
        <h1>Customer Report</h1>
        <form method="post" action="" class="d-flex flex-wrap justify-content-end gap-2 ">
            <select name="month" class="btn btn-outline-info ">
                <?php
               
                    for ($i = 1; $i <= 12; $i++) {
                     
                        $tempDate = new DateTime();
                        $tempDate->setDate($today->format('Y'), $i, 1); 
                        $monthValue = $tempDate->format('Y-m'); 
                        echo "<option value='$monthValue'" . ($selectedMonth == $monthValue ? " selected" : "") . ">" . $tempDate->format('F Y') . "</option>";
                    }
                ?>
            </select>
            <button type="submit" class="btn btn-outline-info" name="period" value="daily">Daily Report</button>
            <button type="submit" class="btn btn-outline-info" name="period" value="weekly">Weekly Report</button>
            <button type="submit" class="btn btn-outline-info" name="period" value="monthly">Monthly Report</button>
        </form>
    
        <h2>Selected Report: <?php echo ucfirst($period); ?></h2>
        <div class="table-responsive">
            <table class="table table-info border border-1">
                <thead>
                    <tr>
                        <th>Period</th>
                        <th>Customer Count</th>
                    </tr>
                </thead>
                <tbody class="table-light ">
                    <tr>
                        <td>Period</td>
                        <td>Customer Count</td>
                    </tr>
                    <tr>
                        <td><?php echo ucfirst($period); ?> Report</td>
                        <td><?php echo getReport($period, $adminId, $conn, $selectedMonth); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    
    </div>
</div>


