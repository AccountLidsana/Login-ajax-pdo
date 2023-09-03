<?php 
session_start();
session_destroy();
unset($_SESSION['user_login']);
unset($_SESSION['admin_login']);
header("location:index.php");

?>