<?php
    // include "../database/dbconnect.php";
    // <?php echo $_SESSION['admin_name']
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - <?php echo $_SESSION['admin_name']?></title>
    <link rel="stylesheet" type="text/css" href="../style/base.css">
</head>
<body>
    <div class="nav">
        <div class="admin-title">Admin Dashboard</div> 
        <div class="logout"><a href="logout.php">Logout</a></div>
    </div>
    <div class="container">
        <div class="side_panel">
            <div class="spanel_button"><a href="dashboard.php">Dashboard</a></div>
            <div class="spanel_button"><a href="department.php">Department</a></div>
            <div class="spanel_button"><a href="empReg.php">Register Employee</a></div>
            <div class="spanel_button"><a href="empInfo.php">Employee Info</a></div>
            <!-- <div class="spanel_button"><a href="scan.php">Attendance</a></div> -->
            <div class="spanel_button"><a href="../chatgpt/scan_c.php">Attendance</a></div>
            <div class="spanel_button"><a href="empAttendance.php">Attendance Report</a></div>           
        </div>
        <div class="second">
            <div class="box">
                <div class="content-box">Depatment
                    <span>Icon</span>
                    <span><a href="department.php"> more info</a></span>
                </div>
                <div class="content-box">Register Employee
                    <span>Icon</span>
                    <span><a href="empReg.php"> more info</a></span>
                </div>
                <div class="content-box">Employee List
                    <span>Icon</span>
                    <span><a href="empInfo.php"> more info</a></span>
                </div>
                <div class="content-box">Attendance Report
                    <span>Icon</span>
                    <span><a href="empAttendance.php"> more info</a></span>
                </div>
                <div class="content-box">Take Attendance
                    <span>Icon</span>
                    <span><a href="scan.php"> more info</a></span>
                </div> 
            </div>
        </div>
    </div>
</body>
</html>