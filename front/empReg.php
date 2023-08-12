<?php
  include '../database/dbconnect.php';
  include '../database/empReg_be.php';
?>

<html>
<head>
    <title>Register Employee</title>
    <link rel="stylesheet" type="text/css" href="./details.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; /* Added to stack navigation on top */
        }

        .nav {
            background-color: rgb(224, 222, 222);
            padding: 10px;
            text-align: center;
        }

        .container{
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: row;
        }

        .dashboard{
            color: black;
            background-color: grey;
            height:88px;
            top: 0;
            left: 0;
            position: absolute;
            width: 240px;
        }

        .side_panel {
            width: 200px;
            background-color: rgb(34, 33, 33);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .spanel_button {
            margin: 5px;
            padding: 10px 20px;
            background-color: white;
            border: 1px solid gray;
            width: 100%;
            border: none;
            text-align: center;
            border-radius: 5px;
            cursor: pointer; /* Add cursor pointer on hover */
            transition: background-color 0.3s; /* Added hover effect transition */
        }
        
        .button:hover {
            background-color: lightyellow; /* Change background color on hover */
        }

        .second {
            flex: 1;
            background-color:rgb(143, 142, 142);
            display: flex;
            flex-wrap: wrap; /* Allow content boxes to wrap */
            padding: 20px;
        }

        .box {
            height: 279px;
            width: 1020px;
            position: relative;
            border: 1px solid rgb(243, 238, 238);
            display: flex; /* Added flex display */
            flex-wrap: wrap; /* Allow content boxes to wrap */
            padding: 10px; /* Adjust padding */
            box-sizing: border-box; /* Include padding in width */
        }

        form {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            
            align-items: center;
            min-height: 100vh;
            margin: 0; 
        }
    </style>    
    <script>
        function validateForm() {
          var empname = document.getElementById("emp_name").value;
          var empaddress = document.getElementById("emp_address").value;
          var empemail = document.getElementById("emp_email").value;
          var empphone = document.getElementById("emp_phone").value;
          var department = document.getElementById("department").value;
          var image = document.getElementById("image").value;
    
          // Check if first name field is empty
          if (empname == "") {
            alert("First name must be filled out");
            return false;
          }
    
          // Check if last name field is empty
          if (empaddress == "") {
            alert("Address must be filled out");
            return false;
          }
    
          // Check if email field is empty
          if (empemail == "") {
            alert("Email must be filled out");
            return false;
          }
    
          // Check if mobile number field is empty
          if (empphone == "") {
            alert("Mobile number must be filled out");
            return false;
          }
    
          // Check if mobile number is a valid 10-digit number
          var mobileRegex = /^[0-9]{10}$/;
          if (!mobileRegex.test(empphone)) {
            alert("Invalid mobile number. Please enter a 10-digit number");
            return false;
          }
    
          // Check if department is selected
          if (department == "") {
            alert("Please select a department");
            return false;
          }
    
          // Check if an image is uploaded
          if (image == "") {
            alert("Please upload an image");
            return false;
          }
        }
    </script>
</head>
<body>
    <div class="nav">
        <div class="dashboard"><a href="dashboard.php">Dashboard</a></div>
        <h2>Logout button</h2>
    </div>
    <div class="container">
        <div class="side_panel">
            <div class="spanel_button"><a href="department.php">Department</a></div>
            <div class="spanel_button"><a href="empReg.php">Register Employee</a></div>
            <div class="spanel_button"><a href="empInfo.php">Employee Info</a></div>
            <div class="spanel_button"><a href="empAttendance.php">Attendance Report</a></div>
        </div>
        <div class="second">
          <form class="form" onsubmit="return validateForm()" action="../database/empreg_be.php" method="post">
              <p class="title">Register Employee</p>
              <label>
                <input required="" placeholder="" type="text" class="input" name="emp_name">
                <span>Enter Name</span>
              </label>

              <label>
                <input required="" placeholder="" type="text" class="input" name="emp_address">
                <span>Enter Address</span>
              </label>
                
              <label>
                <input required="" placeholder="" type="email" class="input" name="emp_email">
                <span>Enter Email</span>
              </label> 
              
              <label for="empphone">
                  <input id="empphone" required="" placeholder="" type="tel" class="input" name="emp_phone">
                  <span>Mobile Number</span>
              </label>
              <label>
                  <select id="department" name="department" required>
                    <option value="" selected disabled>Select Department</option>
                    <?php
                      $sql = ("SELECT * FROM department") or die("failed to query database".mysqli_error());
                      $result = mysqli_query($conn, $sql) or die("Query Unsuccessfull");

                      while($row = mysqli_fetch_assoc($result)){

                    ?>
                    <option><?php echo $row['dept_name']; ?></option>

                    <?php } ?>


                  </select>
                </label>

                <!-- <label>
                    <input type="file" id="image" name="image" accept="image/*" required><br><br>
                </label> -->
                
                <input type="submit" value="Register" id="submit" class="submit" name="submit" >
                <!-- <p class="signup">Already have an acount ? <a href="login.php">Signup</a> </p> -->
              </form>
         </div>
    </div>
  </body>
</html>