<?php
include "../database/dbconnect.php"; // Make sure this includes your database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['mobileNumber'];
    $password = $_POST['passwd'];

    // Use prepared statements for database insertion
    $sql = "INSERT INTO super_admin(admin_name, admin_address, admin_phone, admin_email, admin_passwd) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $name, $address, $phone, $email, $password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect after successful insertion
    header("Location:http://localhost/eas/front/register.php");
    exit();
}
?>