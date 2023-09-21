<?php
  include '../database/dbconnect.php';
  include '../database/update_emp.php';

  session_start();
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
      header("location: login.php");
      exit;
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update Employee</title>
  <link rel="stylesheet" type="text/css" href="../style/base.css">
  <link rel="stylesheet" type="text/css" href="../style/details.css">
  
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
    <div class="admin-title">Employee List</div>
    <div class="logout"><a href="logout.php">Logout</a></div>
  </div>
  <div class="container">
    <div class="side_panel">
        <div class="spanel_button"><a href="department.php">Department</a></div>
        <div class="spanel_button"><a href="empReg.php">Register Employee</a></div>
        <div class="spanel_button"><a href="empInfo.php">Employee Info</a></div>
        <div class="spanel_button"><a href="scan.php">Attendance</a></div>
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
          <form class="form" onsubmit="return validateForm()" action="../database/update_emp.php" method="post">
            <h2 class="title">Update Employee</h2>
            <span>Department</span>
              <label>
                  <?php $sqlDept = "SELECT * FROM department";
                    $resultDept = mysqli_query($conn, $sqlDept);
                    if (mysqli_num_rows($result) > 0) {
                      echo '<select id="department" class="update-select" name="department">';
                       
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
              <span>Mobile Number</span>
              <label>
                <input id="emp_id" type="hidden" name="emp_id" value="<?php echo $row['emp_id']; ?>">     
                <input id="emp_phone" class="update-input" type="tel" name="emp_phone" value="<?php echo $row['emp_phone']; ?>">
              </label>
              <span>Address</span>
              <label>
                <input type="text" class="update-input" id="emp_address" name="emp_address" value="<?php echo $row['emp_address']; ?>">     
              </label>
              <span>Email</span>
              <label>  
                <input type="email" class="update-input" id="emp_email" name="emp_email" value="<?php echo $row['emp_email']; ?>"> 
              </label>
              
              <input type="submit" class="update" value="Update" id="submit" class="submit" name="submit"></br>
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