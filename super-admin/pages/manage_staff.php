
<?php
include('check_access.php');
include('../includes/db_connection.php');


$Admin_id = $user_id;

if(isset($_POST['btn-register'])){


  
    // Don't forget to fix the folder variable name $folder and ensure $imag is correct
    $insert = $conn->prepare("INSERT INTO staff(username, `password`, `role`, last_name, father_name, gender, province, district, position, department, salary, salary_type, `status`, email, mobile, photo, superAdmin_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    move_uploaded_file($dis, $folder);
    $insert->bind_param('ssssssssssisssssi', $firstName, $password, $role, $lastName, $fatherName, $gender, $province, $district, $position, $dept, $salary, $type, $status, $email, $mobile, $imag, $Admin_id);
    
    if($insert){
        header("location:./");
    }else{
        die('Error in the query: '.$conn->connect_error);
    }

    $insert->execute();
    $conn->close();
}
?>



<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
    }

  

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .top-title {
        text-align: left;
        margin-bottom: 20px;
    }

    h3 {
        font-size: 24px;
        color: #343a40;
    }

    .add-staff-btn {
        margin-bottom: 15px;
    }

    /* .table {
        width: 100%;
        margin-left: 0;
        margin-right: 0;
        border: 1px solid #ddd;
    } */

    .table th, .table td {
        text-align: left;
        padding: 12px;
        text-wrap: nowrap;
    }

    .table th {
        /* background-color: #f1f1f1; */
        /* color: #343a40; */
        font-weight: bold;
    }

    /* .table td {
        background-color: #fff;
    } */

    .table img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .table a {
        text-decoration: none;
    }

    .btn {
        margin-right: 5px;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .modal-header {
        background-color: #f8f9fa;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-footer {
        background-color: #f1f1f1;
    }

    .modal-title {
        color: #343a40;
    }
</style>
<title>Super Admin | Manage Staff</title>

<div class="mb-5 animate__animated animate__fadeInUp animate__delay-0.5s">
    <div class="container">
        <div class="top-title">
            <div class="d-flex justify-content-between">
                <h3>Current Registered Staff</h3>
                <!-- Add New Staff Button (Triggers the Modal) -->
                <button class="btn btn-outline-primary  add-staff-btn" id="addNewStaffBtn">Add New Staff</button>
            </div>
            <hr>
            <!-- Modal Structure -->
            <div class="modal fade" id="add-new-staff-modal" tabindex="-1" aria-labelledby="addNewStaffModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewStaffModalLabel">Manage Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <!-- iframe to load manage_users.php -->
                        <?php include "./manage_users.php" ?>
                    <!-- <iframe src="manage_users.php" style="width:100%; height:500px;" frameborder="0"></iframe> -->
                </div>
                </div>
            </div>
            </div>
            <script>
                // JavaScript to trigger the modal when the button is clicked
                document.getElementById('addNewStaffBtn').addEventListener('click', function() {
                    var myModal = new bootstrap.Modal(document.getElementById('add-new-staff-modal'));
                    myModal.show();
                });
            </script>

        </div>
        
        <div class="table-responsive">
            <table class="table table-primary border table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>FirstName</th>
                        <th>LastName</th>
                        <th>Role</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Join Date</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Status</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-light">
                    <tr>
                        <td>#</td>
                        <td>FirstName</td>
                        <td>LastName</td>
                        <td>Role</td>
                        <td>Position</td>
                        <td>Department</td>
                        <td>Join Date</td>
                        <td>Email</td>
                        <td>Mobile</td>
                        <td>Status</td>
                        <td>Photo</td>
                        <td>Action</td>
                    </tr>
                    <?php 
                
                        $query = "SELECT * FROM staff WHERE superAdmin_id = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $Admin_id);  
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        while ($row = $result->fetch_assoc()) { 
                    ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['last_name']; ?></td>
                            <td><?php echo $row['role']; ?></td>
                            <td><?php echo $row['position']; ?></td>
                            <td><?php echo $row['department']; ?></td>
                            <td><?php echo $row['create_at']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td><img src="./<?php echo $row['photo']; ?>" alt="staff img"></td>
                            <td>
                            
                                <a href="#" class="btn btn-info" title="view record"><i class="fa fa-eye"></i></a> 
                                <a href="#" class="btn btn-success" title="edit record"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                    <?php 
                        } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    

