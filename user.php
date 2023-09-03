<?php
session_start();
include "config.php";
if (!isset($_SESSION['user_login'])) {
    

    header('location: index.php');
    }



?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <?php 
   if (isset($_SESSION['user_login'])) {
        $user_id = $_SESSION['user_login'];
        $select = $conn->prepare("SELECT * FROM tbl_user WHERE u_id = :u_id");
        $select->execute(["u_id"=> $user_id]);
        $row=$select->fetch(PDO::FETCH_ASSOC);
        
    }
?>
        <h2>ຊື່ : <?= $row['u_firstname'] ?></h2>
        <h2>ນາມສະກຸນ : <?= $row['u_lastname'] ?></h2>
        <h2>ສະຖານະ :<?= $row['u_level'] ?></h2>

        <a href="logout.php">Logout</a>
    </body>

</html>