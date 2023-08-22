<?php
include "../database/dbconnect.php";

$page = 'signup';
// echo $conn;
if ($_POST) {
    $username = $_REQUEST['admin_name'];
    $email = $_REQUEST['email_id'];
    $password = $_REQUEST['passwd'];
    $h_password = password_hash($password, PASSWORD_DEFAULT);
    // echo $h_password;
    $q_select = "SELECT * FROM super_admin where email='$email'";
    $users = mysqli_query($conn, $q_select);
    if (mysqli_num_rows($users) == 0) {
        $q_select = "SELECT * FROM users where username='$username'";
        $users = mysqli_query($conn, $q_select);
        if (mysqli_num_rows($users) == 0) {
            $q_insert = "INSERT INTO super_admin (username, email, password) VALUES ('$username','$email', '$h_password')";
            if ($result = mysqli_query($conn, $q_insert)) {
                // redirectAlertMessage('User has been register','login.php');
                $title = $username . " is register in Wosa: Pasa:";
                $msg = "Welcome " . $username . " to Wosa: Pasa:. Hope you will find the product u are searching in Our Online store.";
                send_mail($email, $title, $msg);
                echo "
                <h3 class='server_success'>
                    User has been register. Mail has been sent About Ur Register. <a href='login.php'>Login</a>   
                </h3>
                ";
            } else {
                // redirectAlertMessage('Error while inserting:'.$conn->error,'signup.html');
                echo "
                <h3 class='server_error'>
                    Error while inserting: server Error   
                </h3>
                ";
            }
        } else {
            echo "
            <h3 class='server_error'>
                User Already exist ! <a href='login.php'>Login</a>
            </h3>
            ";
        }
    } else {
        // redirectAlertMessage('Email Already Exist !','signup.html');
        echo "
                <h3 class='server_error'>
                    E-mail Already exist ! <a href='login.php'>Login</a>
                </h3>
                ";
    }
}
?>

<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="register.css">
    <script>
        function validateForm() {
          var firstName = document.getElementById("firstName").value;
          var lastName = document.getElementById("lastName").value;
          var email = document.getElementById("email").value;
          var mobileNumber = document.getElementById("mobileNumber").value;
          var address = document.getElementById("address").value;
    
          // Check if first name field is empty
          if (firstName == "") {
            alert("First name must be filled out");
            return false;
          }
    
          // Check if last name field is empty
          if (lastName == "") {
            alert("Last name must be filled out");
            return false;
          }
    
          // Check if email field is empty
          if (email == "") {
            alert("Email must be filled out");
            return false;
          }
    
          // Check if mobile number field is empty
          if (mobileNumber == "") {
            alert("Mobile number must be filled out");
            return false;
          }
    
          // Check if mobile number is a valid 10-digit number
          var mobileRegex = /^[0-9]{10}$/;
          if (!mobileRegex.test(mobileNumber)) {
            alert("Invalid mobile number. Please enter a 10-digit number");
            return false;
          }
        }
    </script>
</head>
<body>
    <form class="form" onsubmit="return validateForm()">
        <p class="title">Register</p>
        <div class="flex">
            <label>
                <input required="" placeholder="" type="text" class="input" id="firstName">
                <span>Firstname</span>
            </label>

            <label>
                <input required="" placeholder="" type="text" class="input" id="lastName">
                <span>Lastname</span>
            </label>
        </div>  

        <label>
            <input required="" placeholder="" type="email" class="input" id="email">
            <span>Email</span>
        </label> 
        
        <label for="mobileNumber">
            <input id="mobileNumber" required="" placeholder="" type="tel" class="input">
            <span>Mobile Number</span>
        </label>
            <button class="submit">Submit</button>
            <p class="signin">Already have an acount ? <a href="#">Signin</a> </p>
        </form>
    </Body>
</html>