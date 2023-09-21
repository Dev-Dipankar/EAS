<?php
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .content-box {
            justify-content: center;
        }
        .content-box span i {
            color: black;
            margin: 20px 20px;
        }
    </style>
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
            <div class="spanel_button"><a href="scan.php">Attendance</a></div>
            <div class="spanel_button"><a href="attenReport.php">Attendance Report</a></div>           
        </div>
        <div class="second">
            <div class="box">
                <div class="content-box">Department
                    <span><a href="department.php"><i class="fa-solid fa-graduation-cap fa-xl"></i></a></span>
                    <span><a href="department.php">More Info</a></span>
                </div>

                <div class="content-box">Register Employee
                    <span><a href="empReg.php"><i class="fa-solid fa-user-plus fa-xl"></i></a></span>
                    <span><a href="empReg.php"> More Info</a></span>
                </div>

                <div class="content-box">Employee List
                    <span><a href="empInfo.php"><i class="fa-solid fa-users fa-xl"></i></a></span>
                    <span><a href="empInfo.php"> More Info</a></span>
                </div>

                <div class="content-box">Attendance Report
                    <span><a href="attenReport.php"><i class="fa-solid fa-chart-bar fa-xl"></i></a></span>
                    <span><a href="attenReport.php"> More Info</a></span>
                </div>

                <div class="content-box">Take Attendance
                    <span><a href="scan.php"><i class="fa-solid fa-camera fa-xl"></i></a></span>
                    <span><a href="scan.php"> More Info</a></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>