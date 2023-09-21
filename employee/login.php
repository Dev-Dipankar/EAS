<?php
    require_once '../database/dbconnect.php';

    $login = false;
    $showErr = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['passwd'];

        $sql = "SELECT * FROM emp_info WHERE emp_email='$email' AND emp_phone='$password'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        if($num == 1){
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;

            // Assuming you fetch and store the employee ID upon successful login
            $row = $result->fetch_assoc();
            $_SESSION['emp_id'] = $row['emp_id'];

            header("Location:http://localhost/eas/employee/empDetails.php");
            exit();
        }
        else{
            $showErr = "Invalid Credentials";
        }
    }
?>
<html>
<head>
    
    <title>Employee Login</title>
    <link rel="stylesheet" type="text/css" href="../style/login.css">

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
    </form>

</body>
</html>