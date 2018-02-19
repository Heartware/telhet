<!DOCTYPE html>  

<?php
//include '';
if (!isset($_SESSION['username'])) {
    $_SESSION['originalpage'] = $_SERVER['PHP_SELF'];
//    print_r($_SESSION);
//    exit();
    header("location:login.php");
}
?>