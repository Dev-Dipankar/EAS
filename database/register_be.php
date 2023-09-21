<?php
    include '../database/dbconnect.php';
    
    if($_POST){
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['mobileNumber'];
        $password = $_POST['passwd'];
        $exists = false;

        //Check existing email
        $existsSql = "SELECT * FROM `super_admin` WHERE admin_email = '$email'";
        $result = mysqli_query($conn, $existsSql);
        $numRowsExist = mysqli_num_rows($result);
        if($numRowsExist > 0){
            // $exists = true;
            // $showErr = "Email already on exists!";
            echo "Email already on exists!";
        }
        else{
            // $exists = false;
            $sql = "INSERT INTO super_admin(admin_name,admin_address,admin_email,admin_phone,admin_passwd) VALUES ('{$name}','{$address}','{$email}','{$phone}','{$password}')";
            $result = mysqli_query($conn, $sql) or die("Query Unsuccessfull");          
        
            header("Location:http://localhost/eas/admin/register.php");
        }
    }
?>