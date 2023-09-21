<?php
    include 'dbconnect.php';
    //Backend of register.php (CRUD of register entry)    
    
    if($_POST)
    {
        $empname = $_POST['emp_name'];
        $empaddress = $_POST['emp_address'];
        $empphone = $_POST['emp_phone'];
        $empemail = $_POST['emp_email'];
        $department = $_POST['department'];
        
        $sql = "INSERT INTO emp_info(dept_id,emp_name,emp_address,emp_phone,emp_email,department) VALUES ('{$department}','{$empname}','{$empaddress}','{$empphone}','{$empemail}','{$department}')";
        $result = mysqli_query($conn, $sql) or die("Query Unsuccessfull");


        header("Location:http://localhost/eas/admin/empreg.php");
    }
?>