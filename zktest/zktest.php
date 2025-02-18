<html>
    <head>
        <title>ZK Test</title>
    </head>
    
    <body>
<?php
    include("zklib/zklib.php");


    $zk = new ZKLib("192.168.1.200", 4370);
    $ret = $zk->connect();
    
    // Add a user - UID, ID, Name, Password, and Role (LEVEL_USER or LEVEL_ADMIN)
    $uid = 12;               // Unique User ID
    $id = '125';          // User ID (e.g., Badge number)
    $name = 'John Doe';     // User Name
    $password = '123456';   // User Password
    $role = LEVEL_USER;     // Role: LEVEL_ADMIN for admin, LEVEL_USER for regular user

    // Database connection
    $host = 'localhost';
    $username = 'root';
    $password = 'mysqlroot';
    $dbname = 'school';
    $port = 3307;
    $conn = new mysqli($host, $username, $password, $dbname, $port);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "INSERT INTO users (id, name, password, role) VALUES (?, ?, ?, ?)";
    try {
        // Set User - Add the user to the device with provided data
        $zk->setUser($uid, $id, $name, $password, $role);
        // Add User to Database 
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("SQL Error: " . $conn->error);
        }
        $stmt->bind_param("isss", $id, $name, $password, $role);
        if ($stmt->execute()) {
            echo "<p>User Added Successfully!</p>";
        } else {
            echo "Error: " . $stmt->error;
        }
    } catch (Exception $e) {
        echo "<p>Error Adding User: " . $e->getMessage() . "</p>";
    }
    
    // Fetch and display users
    try {
        $user = $zk->getUser();
        sleep(1);
        ?>
        <table border="1" cellpadding="5" cellspacing="2">
            <tr>
                <th>UID</th>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Password</th>
            </tr>
            <?php
            while (list($uid, $userdata) = each($user)):
                $role = ($userdata[2] == LEVEL_ADMIN) ? 'ADMIN' : 'USER';
            ?>
            <tr>
                <td><?php echo $uid; ?></td>
                <td><?php echo $userdata[0]; ?></td>
                <td><?php echo $userdata[1]; ?></td>
                <td><?php echo $role; ?></td>
                <td><?php echo $userdata[3]; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php
    } catch (Exception $e) {
        echo "<p>Error Fetching Users: " . $e->getMessage() . "</p>";
    }
?>
    </body>
</html>
