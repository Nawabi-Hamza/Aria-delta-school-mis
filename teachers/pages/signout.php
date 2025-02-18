<?php 
if(isset($_POST['brn-signout'])){
    session_destroy();

    header("Location: ../login.php");
}
?>
