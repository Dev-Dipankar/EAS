<?php
    include "../database/dbconnect.php";
    include "../database/register_be.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Registration</title>
    <link rel="stylesheet" type="text/css" href="../style/register.css">
    <script>
        function validateForm() {
            var name = document.getElementById("name").value;
            var address = document.getElementById("address").value;
            var email = document.getElementById("email").value;
            var mobileNumber = document.getElementById("mobileNumber").value;
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm-passwd").value;

            // Check if first name field is empty
            if (name == "") {
                alert("First name must be filled out");
                return false;
            }

            // Check if last name field is empty
            if (address == "") {
                alert("Address must be filled out");
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
            
            // Password validation
            if (password == "") {
                alert("Please insert password.");
                return false;
            } else if (password.length < 6 || password.length > 100) {
                alert("Password must be between 6 and 100 characters.");
                return false;
            }

            // Confirm password validation
            if (confirmPassword != password) {
                alert("Confirm Password didn't match with password.");
                return false;
            }
            return true; // Allow the form submission if all validations pass
        }
    </script>
</head>
<body>
    <form class="form" onsubmit="return validateForm()" method="post">
        <p class="title">Register</p>
        <label>
            <input required="" placeholder="" type="text" class="input" id="name" name="name">
            <span>Name</span>
        </label>
        <label>
            <input required="" placeholder="" type="text" class="input" id="address" name="address">
            <span>Address</span>
        </label>  

        <label>
            <input required="" placeholder="" type="email" class="input" id="email" name="email">
            <span>Email</span>
        </label> 
        
        <label for="mobileNumber">
            <input required="" placeholder="" type="tel" class="input" id="mobileNumber" name="mobileNumber">
            <span>Mobile Number</span>
        </label>

        <label for="password">
            <input required="" id="password" placeholder="" type="password" class="input" name="passwd" name="passwd">
            <span>Password</span>
        </label>

        <label for="password">
            <input required="" id="confirm-passwd" placeholder="" type="password" class="input" name="confirm-passwd" name="confirm-passwd">
            <span>Confirm Password</span>
        </label>
        <button class="submit" type="submit">Submit</button>
        <p class="signin">Already have an account? <a href="login.php">Login</a></p>
    </form>
</body>
</html>