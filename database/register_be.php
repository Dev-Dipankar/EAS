<?php
    include 'dbconnect.php';
    
    if($_POST)
    {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['mobileNumber'];
        $password = $_POST['passwd'];
        
        $sql = "INSERT INTO super_admin(admin_name,admin_address,admin_email,admin_phone,admin_passwd) VALUES ('{$name}','{$address}','{$email}','{$phone}','{$password}')";
        $result = mysqli_query($conn, $sql) or die("Query Unsuccessfull");


        header("Location:http://localhost/eas/front/register.php");
    }
?>