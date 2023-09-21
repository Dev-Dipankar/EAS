<?php
    include 'dbconnect.php';    
    
    if($_POST)
    {
        $empID = $_POST['emp_id'];
        $empaddress = $_POST['emp_address'];
        $empphone = $_POST['emp_phone'];
        $empemail = $_POST['emp_email'];
        $department = $_POST['department'];
        
        $sql = "UPDATE emp_info SET dept_id = '{$department}', emp_address = '{$empaddress}', emp_phone = '{$empphone}', emp_email = '{$empemail}', department = '{$department}' WHERE emp_id = '{$empID}'";

        $result = mysqli_query($conn, $sql) or die("Query Unsuccessfull");


        header("Location: http://localhost/eas/admin/empinfo.php");
        exit;
    }
?>