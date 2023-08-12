<?php
    include 'dbconnect.php';    
    
    if($_POST)
    {
        $deptID = $_POST['dept_id'];
        $deptname = $_POST['dept_name'];
        
        $sql = "UPDATE departmen SET dept_name = '{$deptname}' WHERE dept_id = '{$deptID}'";
        $result = mysqli_query($conn, $sql) or die("Query Unsuccessfull");


        header("Location: http://localhost/eas/front/department.php");
        exit;
    }
?>