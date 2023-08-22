<?php
  include '../database/dbconnect.php';
  include '../database/empReg_be.php';
?>

<html>
<head>
    <title>Register Employee</title>
    <link rel="stylesheet" type="text/css" href="base.css">
    <link rel="stylesheet" type="text/css" href="details.css">
    <style>
        form {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
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
          <div class="box">
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
                          $sql = "SELECT * FROM department";
                          $result = mysqli_query($conn, $sql);

                          while($row = mysqli_fetch_assoc($result)){
                              echo "<option value='" . $row['dept_id'] . "'>" . $row['dept_name'] . "</option>";
                          }
                      ?>
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
    </div>
  </body>
</html>