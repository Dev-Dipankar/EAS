<?php
    include 'dbconnect.php';
    //Backend of register.php (CRUD of register entry)    
    
    if($_POST)
    {
        $deptid = $_POST['dept_id'];
        $deptname = $_POST['dept_name'];
        
        $sql = "INSERT INTO department(dept_id, dept_name) VALUES ('{$deptid}','{$deptname}')";
        $result = mysqli_query($conn, $sql) or die("Query Unsuccessfull");

        

        header("Location:http://localhost/eas/admin/department.php");
    }
?>