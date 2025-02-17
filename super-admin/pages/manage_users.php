<?php

// include('../includes/db_connection.php');
// include('check_access.php');  



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $role = $_POST['role'];
    $last_name = $_POST['last_name'];
    $father_name = $_POST['father_name'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];
    $salary_type = $_POST['salary_type'];
    $status = $_POST['status'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $superadmin_id = $user_id;




    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    
    $photo = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = 'uploads/' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
    }

  
    $sql = "INSERT INTO staff (username, `password`, `role`, last_name, father_name, province, district, position, department, salary, salary_type, `status`, email, mobile, create_at, photo, superadmin_id)
            VALUES ('$username', '$hashed_password', '$role', '$last_name', '$father_name', '$province', '$district', '$position', '$department', '$salary', '$salary_type', '$status', '$email', '$mobile', '$create_at', '$photo', '$superadmin_id')";

    if ($conn->query($sql) === TRUE) {
        echo "New staff member added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>



<form action="" method="POST" enctype="multipart/form-data">
    <div class="p-4">
            <h2>Staff Information Form</h2>
            <div class="row mb-4">
                <div class="col-6">
                    <label class="form-label" for="id">ID:</label><br>
                    <input type="text" class="form-control" placeholder="Staff id" id="id" name="id" required>
                </div>
                <div class="col-6">
                    <label class="form-label" for="username">Username:</label><br>
                    <input type="text" class="form-control" placeholder="Staff Name" id="username" name="username" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <label class="form-label" for="password">Password:</label><br>
                    <input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
                </div>
                <div class="col-6">
                    <label class="form-label" for="role">Role:</label><br>
                    <input type="text" id="role" class="form-control" placeholder="Role" name="role" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <label class="form-label" for="last_name">Last Name:</label><br>
                    <input type="text" id="last_name" class="form-control" placeholder="Staff Last name" name="last_name" required>
                </div>
                <div class="col-6">
                    <label class="form-label" for="father_name">Father's Name:</label><br>
                    <input type="text" id="father_name" class="form-control" placeholder="staff father name" name="father_name" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <label class="form-label" for="province">Province:</label><br>
                    <input type="text" id="province" class="form-control" placeholder="Staff Province" name="province" required>
                </div>
                <div class="col-6">
                    <label class="form-label" for="district">District:</label><br>
                    <input type="text" id="district" class="form-control" placeholder="Staff District" name="district" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <label class="form-label" for="position">Position:</label><br>
                    <input type="text" id="position" class="form-control" placeholder="Staff Position" name="position" required>
                </div>
                <div class="col-6">
                    <label class="form-label" for="department">Department:</label><br>
                    <input type="text" id="department" class="form-control" placeholder="Staff Department" name="department" required>
                </div>    
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <label class="form-label" for="salary">Salary:</label><br>
                    <input type="number" id="salary" class="form-control" placeholder="Staff Salary" name="salary" required>
                </div>
                <div class="col-6">
                    <label class="form-label" for="salary_type">Salary Type:</label><br>
                    <select id="salary_type" class="form-control" placeholder="Salary Type $,AF" name="salary_type" required>
                        <option value="Monthly">Monthly</option>
                        <option value="Hourly">Hourly</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <label class="form-label" for="status">Status:</label><br>
                    <select id="status" class="form-control" name="status" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>   
                </div>
                <div class="col-6">
                    <label class="form-label" for="email">Email:</label><br>
                    <input type="email" id="email" class="form-control" placeholder="Staff Email Address" name="email" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <label class="form-label" for="mobile">Mobile:</label><br>
                    <input type="text" id="mobile" class="form-control" placeholder="Staff phone number" name="mobile" required>
                </div>
                <div class="col-6">
                    <label class="form-label" for="photo">Photo:</label><br>
                    <input type="file" id="photo" class="form-control" placeholder="Staff Photo" name="photo" accept="image/*">
                </div>
            </div>
        </div>


        <input type="hidden" id="superadmin_id" class="form-control" name="superadmin_id" value="<?php echo $_SESSION['superadmin_id']; ?>">

        <div class="modal-footer d-flex justify-content-end">
            <input class="btn btn-outline-primary" type="submit" value="Submit">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div> 
    </form>
