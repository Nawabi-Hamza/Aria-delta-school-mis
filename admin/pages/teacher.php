<?php 
// Include check_access.php to ensure access control
// include('check_access.php');

// // Use the user_id from the session, which is set in check_access.php
// include('../includes/db_connection.php');
// $user_id = $_SESSION['user_id'];

// // Database connection parameters
// $host = 'localhost';
// $dbname = 'school';
// $username = 'root';
// $password = '';

// try {
//     // Establish database connection using PDO
//     $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
// } catch (PDOException $e) {
//     // Handle connection errors
//     die("Connection failed: " . $e->getMessage());
// }

// SQL query to fetch teacher details where staff_id matches the logged-in user
// $sql = "SELECT 
//             id,
//             teacherName,
//             password,
//             role,
//             lastname,
//             father_name,
//             gender,
//             province,
//             district,
//             permanent_address,
//             current_address,
//             qualification,
//             salary,
//             subjects_taught,
//             email,
//             mobile,
//             photo,
//             created_at,
//             staff_id
//         FROM teachers 
//         WHERE staff_id = :staff_id";

// $stmt = $conn->prepare($sql);
// $stmt->bindParam(':staff_id', $user_id, PDO::PARAM_INT); // Bind the user_id as staff_id
// $stmt->execute();

// // Fetch all the matching results
// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result = false;

// Start HTML output
?>

    
<div class="container mt-4">
    <h2>Teacher Details Managed by You</h2>
    
    
     <div class="table-responsive">
         <table class="table table-hover table-info mt-4">
             <thead>
                 <tr>
                     <th>Teacher Name</th>
                     <th>Last Name</th>
                     <th>Father Name</th>
                     <th>Gender</th>
                     <th>Province</th>
                     <th>District</th>
                     <th>Permanent Address</th>
                     <th>Current Address</th>
                     <th>Qualification</th>
                     <th>Salary</th>
                     <th>Subjects Taught</th>
                     <th>Email</th>
                     <th>Mobile</th>
                     <th>Photo</th>
                     <th>Created At</th>
                 </tr>
             </thead>
             
             <?php if ($result): ?>
             <tbody class="table-light">
                
                 <?php foreach ($result as $row): ?>
                     <tr>
                         <td><?php echo htmlspecialchars($row["teacherName"]); ?></td>
                         <td><?php echo htmlspecialchars($row["lastname"]); ?></td>
                         <td><?php echo htmlspecialchars($row["father_name"]); ?></td>
                         <td><?php echo htmlspecialchars($row["gender"]); ?></td>
                         <td><?php echo htmlspecialchars($row["province"]); ?></td>
                         <td><?php echo htmlspecialchars($row["district"]); ?></td>
                         <td><?php echo htmlspecialchars($row["permanent_address"]); ?></td>
                         <td><?php echo htmlspecialchars($row["current_address"]); ?></td>
                         <td><?php echo htmlspecialchars($row["qualification"]); ?></td>
                         <td><?php echo htmlspecialchars($row["salary"]); ?></td>
                         <td><?php echo htmlspecialchars($row["subjects_taught"]); ?></td>
                         <td><?php echo htmlspecialchars($row["email"]); ?></td>
                         <td><?php echo htmlspecialchars($row["mobile"]); ?></td>
                         <td>
                             <?php if ($row["photo"]): ?>
                                 <img src="uploads/<?php echo htmlspecialchars($row["photo"]); ?>" alt="Teacher Photo">
                             <?php else: ?>
                                 No Photo Available
                             <?php endif; ?>
                         </td>
                         <td><?php echo htmlspecialchars($row["created_at"]); ?></td>
                     </tr>
                 <?php endforeach; ?>
             </tbody>
             <?php else: ?>
                 <p class="no-results">No teachers found for this staff member.</p>
             <?php endif; ?>
         </table>
     </div>
</div>


<?php
// Close database connection
// $conn = null;
?>