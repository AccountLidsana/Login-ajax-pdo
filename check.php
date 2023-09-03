<?php 

session_start();
include "config.php";

// check  register 

if(isset($_POST['register'])){

    $firstname = $_POST['u_firstname'];
    $lastname = $_POST['u_lastname'];
    $username = $_POST['u_username'];
    $password = $_POST['u_password'];

    if($firstname == ""){
        echo json_encode(array("status"=>"warning","msg"=>"ກະລຸນາປ້ອນຊື່"));
    }
    else if($lastname == ""){
        echo json_encode(array("status"=>"warning","msg"=>"ກະລຸນາປ້ອນນາມສະກຸນ"));
    }
    else if($username == ""){
        echo json_encode(array("status"=>"warning","msg"=>"ກະລຸນາປ້ອນຊື່ຜູ້ນຳໃຊ້"));

    }
    else if($password == ""){
        echo json_encode(array("status"=>"warning","msg"=>"ກະລຸນາປ້ອນລະຫັດ"));

    }else{
         
        try{

            $select_exist = "SELECT * FROM tbl_user WHERE u_username = :u_username";
            $select_exist = $conn->prepare($select_exist);
            $select_exist->bindParam(":u_username",$username);
            $select_exist->execute();
            $rowcolumn = $select_exist->rowCount();

            if($rowcolumn > 0){
                
            echo json_encode(array("status"=>"warning","msg"=>"ມີບັນຊີນີ້ແລ້ວ"));

            }else{
                
            $passwordHash =password_hash($password,PASSWORD_DEFAULT);
            
            $sql_insert = "INSERT INTO tbl_user (u_firstname,u_lastname,u_username,u_password,u_level) VALUES (:u_firstname,:u_lastname,:u_username,:u_password,:u_level)";
            $sql_insert=$conn->prepare($sql_insert);
            $sql_insert->bindParam(":u_firstname",$firstname);
            $sql_insert->bindParam(":u_lastname",$lastname);
            $sql_insert->bindParam(":u_username",$username);
            $sql_insert->bindParam(":u_password",$passwordHash);
            $sql_insert->bindValue(":u_level","user");
            $row = $sql_insert->execute();

            if($row){
                
            echo json_encode(array("status"=>"success","msg"=>"success"));

            }
        }
        }catch(PDOException $e){
            
              echo json_encode(array("status" => "error", "msg" => "Invalid credentials"));

        }
    }
}


// check Login 


if(isset($_POST['login_user'])){

    $username = $_POST['u_username'];
    $password = $_POST['u_password'];

    if($username == ""){
        
    echo json_encode(array("status" => "warning", "msg" => "ກະລຸນາປ້ອນຊື່ຜູ້ນຳໃຊ້"));

    }

    else if($password == ""){
        
    echo json_encode(array("status" => "warning", "msg" => "ກະລຸນາປ້ອນລະຫັດ"));

    }
    else{
        
        $select_form = "SELECT * FROM tbl_user WHERE u_username = :u_username ";
        $select_form = $conn->prepare($select_form);
        $select_form->bindParam(":u_username",$username,PDO::PARAM_STR);
        $select_form->execute();
        $row = $select_form->fetch(PDO::FETCH_ASSOC);
        $rowcolumn = $select_form->rowCount();

        if($rowcolumn == 0){
            
            echo json_encode(array("status" => "warning", "msg" => "ບໍ່ມີບັນຊີນີ້ໃນລະບົບ"));

        }else{
            // $row = $select_form->fetch();
            $hashedPassword = $row['u_password'];

            if(password_verify($password,$hashedPassword)){

                if($row['u_level'] == "admin"){
                $_SESSION['admin_login'] = $row['u_id'];
                      echo json_encode(array("status" => "admin", "msg" => "ລອກອິນສຳເລັດ"));
                // $_SESSION['user_login'] = $row['u_id'];

                }else if($row['u_level'] == "user"){
                    
                $_SESSION['user_login'] = $row['u_id'];

                echo json_encode(array("status"=>"user", "msg" => "ລອກອິນສຳເລັດ"));


                }

            }
        }
    }

    
}



?>