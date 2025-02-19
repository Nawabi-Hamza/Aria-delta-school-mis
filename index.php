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
    <link rel="shortcut icon" href="./assets/images/school-logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="./assets/bootstrap/bs.min.css">
    <link rel="stylesheet" href="./assets/css/animate.css">
    <title>School MIS | Login</title>
    <style>
        body{
            position: relative;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            background-image: url(./assets/images/login-background.jpg);
            /* background-image: url(https://images.unsplash.com/photo-1509062522246-3755977927d7?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fHNjaG9vbHxlbnwwfHwwfHx8MA%3D%3D); */
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); 
        }
        .login {
            height: 100vh;
            position: relative;
            z-index: 2;
        }
        .login form{
            transition: .5s;
        }
        .login form:hover{

            box-shadow: 0 0 0 .1em #0dcaf0;
            background-color: #333;
        }
    </style>
</head>
<body>
    <div class="container mx-auto login align-items-center justify-content-center row">
        <form method="POST" class="animate__animated animate__fadeInRight animate__delay-0.5s col-md-8 text-white col-xl-4  border rounded border-info p-4 ms-auto" action="./super-admin/index.php">
            <h1 class="fw-bold h2">Login</h1>
            
            <div class="mb-4">
                <label for="username">Username:</label>
                <input type="text" id="username" class="form-control" placeholder="Username" name="username" required>
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
    </div>
<script src="./assets/bootstrap/bs.min.js"></script>
</body>
</html>

