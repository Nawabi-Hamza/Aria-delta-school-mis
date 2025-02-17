<?php
// session_start();
// include('../includes/db_connection.php'); 

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $role = $_POST['role'];
//     $username = $_POST['username'];
//     $password = $_POST['password'];

    
//     $sql = "SELECT * FROM staff WHERE username = ?";
    
  
//     if ($stmt = $conn->prepare($sql)) {
//         $stmt->bind_param('s', $username); 
//         $stmt->execute();
//         $result = $stmt->get_result();

//         if ($result->num_rows > 0) {
         
//             $user = $result->fetch_assoc();

           
//             if (password_verify($password, $user['password'])) {
                
//                 $_SESSION['loggedin'] = true;
//                 $_SESSION['username'] = $user['username'];
//                 $_SESSION['role'] = $user['role'];
//                 $_SESSION['user_id'] = $user['id'];
                

          
//                 $role = $user['role']; 

    
//                 $page_sql = "SELECT page_url FROM pages WHERE role = ?";
                
//                 if ($page_stmt = $conn->prepare($page_sql)) {
//                     $page_stmt->bind_param('s', $role); // Bind role
//                     $page_stmt->execute();
//                     $page_result = $page_stmt->get_result();

//                     if ($page_result->num_rows > 0) {
                      
//                         $page = $page_result->fetch_assoc();
//                         $page_url = $page['page_url'];

                 
//                         header("Location: $page_url");
//                         exit();
//                     } else {
                
//                         $error = "Role not found in pages table.";
//                     }
//                 }
//             } else {
//                 $error = "Invalid credentials. Please try again.";
//             }
//         } else {
//             $error = "Invalid credentials. Please try again.";
//         }
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./admin/extra/admin.css">
    <style>
        .login{
            height: 100vh;
        }
    </style>
</head>
<body>

<div class="container mx-auto login align-items-center justify-content-center row">
    <!-- <div class="text-center col-md-5 mb-0">
        <img src="./assets/images/school-logo.png" class=" w-100 w-md-75 w-lg-50 w-xl-25" alt="">
    </div> -->
    <form method="POST" class="col-md-8 col-xl-6  border rounded border-info p-4 mx-auto" action="login.php">
        <h1 class="fw-bold h2">Login</h1>
        
        <div class="mb-4">
            <label for="username">Username:</label>
            <input type="text" id="username" class="form-control" placeholder="Username or Email" name="username" required>
        </div>
        <div class="mb-4">
            <label for="password">Password:</label>
            <input type="password" id="password" class="form-control" placeholder="Your Password" name="password" required>
        </div>
        <div class="mb-4">
            <label for="role">Select Role:</label>
            <select name="role" id="role" class="form-control form-select" required>
                <option value="staff" default>Your Role</option>
                <option value="superadmin">Superadmin</option>
                <option value="staff">Staff</option>
            </select>
        </div>
        <button type="submit" class="btn btn-info">Login</button>
    </form>

    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


</body>
</html>
