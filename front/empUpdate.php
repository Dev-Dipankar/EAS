<?php
  include '../database/dbconnect.php';
  include '../database/update_emp.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update Employee</title>
  <link rel="stylesheet" type="text/css" href="base.css">
  <!-- <link rel="stylesheet" type="text/css" href="details.css"> -->

  <style>
    /* .utitle{
      position: absolute;
      margin-left: 95px;
    } */

    .update-form{
      display: flex;
      margin-top: 65px;
      flex-direction: column;
      margin-left: 100px; 
    }

    .update-select{
      width: 160px;
      height: 35px;
      border-radius: 15px;
    }

    .update-input{
      width: 160px;
      height: 35px;
      border-radius: 15px;
    }

    .updatebtn{
      margin: 25px;
      width: 150px;
      height: 50px;
      align-items: center;
      justify-content: center;
      margin: 50px;
      margin-left: 95px;
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
              <label>Department</br>
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
              <label>
                <input id="emp_id" type="hidden" name="emp_id" value="<?php echo $row['emp_id']; ?>">
                <span>Mobile Number</span></br>
                <input id="emp_phone" class="update-input" type="tel" name="emp_phone" value="<?php echo $row['emp_phone']; ?>"></br>
              </label>
              <label>
                <span>Address</span></br>
                <input type="text" class="update-input" id="emp_address" name="emp_address" value="<?php echo $row['emp_address']; ?>"></br>
                
              </label>
              <label>
                <span>Email</span></br>
                <input type="email" class="update-input" id="emp_email" name="emp_email" value="<?php echo $row['emp_email']; ?>"></br>  
              </label>
              
              <input type="submit" class="updateBtn" value="Update" id="submit" class="submit" name="submit"></br>
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