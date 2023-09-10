<?php
require_once '../database/dbconnect.php';

$login = false;
$showErr = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['passwd'];

    // Use prepared statements
    $sql = "SELECT * FROM super_admin WHERE admin_email=? AND admin_passwd=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $login = true;
        // Redirect after successful login
        header("Location: http://localhost/eas/front/dashboard.php");
        exit();
    } else {
        $showErr = "Invalid Credentials";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="./login.css">
</head>
<body>
    <form class="form" method="post">
        <p class="form-title">Login in to your account</p>
        <div class="input-container">
           <input type="email" placeholder="Enter email" id="email" name="email">
       </div>
       <div class="input-container">
           <input type="password" placeholder="Enter password" id="passwd" name="passwd">
        </div>
        <button type="submit" class="submit">Login</button>
 
       <p class="signup-link">
         No account?
         <a href="register.php">Sign up</a>
       </p>
    </form>
</body>
</html>
