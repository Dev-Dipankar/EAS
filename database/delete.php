<?php
    include 'dbconnect.php';

    $deptID = $_GET['id'];
    $sql = "DELETE FROM department WHERE dept_id = {$deptID}";
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessfull");

    header("Location:http://localhost/eas/front/department.php");
?>