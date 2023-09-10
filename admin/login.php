<?php
    require_once '../database/dbconnect.php';

    $login = false;
    $showErr = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['passwd'];

        $sql = "SELECT * FROM super_admin WHERE admin_email='$email' AND admin_passwd='$password'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        if($num == 1){
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['admin_name'] = $email;
            header("Location:http://localhost/eas/front/dashboard.php");
            exit();
        }
        else{
            $showErr = "Invalid Credentials";
        }
    }
?>

<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="../style/login.css">
</head>
<body>
    <?php
        if($login){
            echo "Logged in Successfully";
        }
    ?>
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
        <a href="register.php">Signin</a>
    </p>
    </form>

</body>
</html>