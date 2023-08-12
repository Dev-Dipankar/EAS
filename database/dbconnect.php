<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'eas_db';

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn)
    {
        die("Database connection Failed!!!".mysqli_connect_errno());
    }
    $select_db=mysqli_select_db($conn,"eas_db");
    if(!$select_db)
    {
        die("Database selection failed!!");
        mysqli_connect_errno();   
    }
?>