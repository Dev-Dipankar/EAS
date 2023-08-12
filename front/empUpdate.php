<?php
  include '../database/dbconnect.php';
  include '../database/update_emp.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update Employee</title>
  <!-- <link rel="stylesheet" type="text/css" href="./details.css"> -->
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

        
  </style>
  <script>
    function validateForm() {
      var empaddress = document.getElementById("emp_address").value;
      var empemail = document.getElementById("emp_email").value;
      var empphone = document.getElementById("emp_phone").value;
      var department = document.getElementById("department").value;

      if (empaddress.trim() === "") {
        alert("Address must be filled out");
        return false;
      }

      if (empemail.trim() === "") {
        alert("Email must be filled out");
        return false;
      }

      if (empphone.trim() === "") {
        alert("Mobile number must be filled out");
        return false;
      }

      var mobileRegex = /^[0-9]{10}$/;
      if (!mobileRegex.test(empphone)) {
        alert("Invalid mobile number. Please enter a 10-digit number");
        return false;
      }

      if (department.trim() === "") {
        alert("Please select a department");
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
        <?php
          $empID = $_GET['id'];
          $sql = "SELECT * FROM emp_info WHERE emp_id = $empID";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <form class="update-form" onsubmit="return validateForm()" action="../database/update_emp.php" method="post">
            <h2 class="utitle">Update Employee</h2>
            <div class="flex">
              <label>
                  <?php $sqlDept = "SELECT * FROM department";
                    $resultDept = mysqli_query($conn, $sqlDept);
                    if (mysqli_num_rows($result) > 0) {
                      echo '<select id="department" name="department">';
                       
                      while ($rowDept = mysqli_fetch_assoc($resultDept)) {
                        if($row['department'] == $rowDept['dept_id']){
                          $select = "Selected";
                        }else{
                          $select = "";
                        }
                        echo "<option {$select} value='{$rowDept['dept_id']}'>{$rowDept['dept_name']}</option>";
                      }
                      echo '</select>';
                    }
                    echo '<br>';
                ?>
              </label>
              <label>
                <input id="emp_id" type="hidden" name="emp_id" value="<?php echo $row['emp_id']; ?>">
                <span>Mobile Number</span></br>
                <input id="emp_phone" type="tel" name="emp_phone" value="<?php echo $row['emp_phone']; ?>"></br>
              </label>
              <label>
                <span>Address</span></br>
                <input type="text" id="emp_address" name="emp_address" value="<?php echo $row['emp_address']; ?>"></br>
                
              </label>
              <label>
                <span>Email</span></br>
                <input type="email" id="emp_email" name="emp_email" value="<?php echo $row['emp_email']; ?>"></br>  
              </label>
              
              <input type="submit" value="Update" id="submit" class="submit" name="submit"></br>
            </div>
          </form>
          <?php
              }
            }
          ?>
      </div>
    </div>
  </div>
</body>
</html>