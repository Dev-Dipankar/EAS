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
            header("Location:http://localhost/eas/admin/dashboard.php");
            exit();
        }
        else{
            $showErr = "Invalid Credentials";
        }
    }
?>
<html>
<head>
    
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="../style/login.css">
    <!-- <link rel="stylesheet" type="text/css" href="../chatgpt/login_c.css"> -->

    <script>
        function validateForm() {    
            var email = document.getElementById("email").value;
            var password = document.getElementById("passwd").value;

            // Check if email field is empty
            if (email == "") {
                alert("Email must be filled out");
                return false;
            }

            // Check if email field is empty
            if (password == "") {
                alert("Password must be filled out");
                return false;
            }           
            return true;
        }
    </script>
</head>
<body>
    <?php
        if($login){
            echo "Logged in Successfully";
        }
    ?>
    <form class="form" onsubmit="return validateForm()" method="post">
        <p class="form-title">Login</p>
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