<?php
    include 'dbconnect.php';

    $empID = $_GET['id'];
    $sql = "DELETE FROM emp_info WHERE emp_id = {$empID}";
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessfull");

    header("Location:http://localhost/eas/front/empInfo.php");
?>