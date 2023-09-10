<?php
    include "../database/dbconnect.php";
    // include "../database/empDetails_be.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Details</title>
    <link rel="stylesheet" type="text/css" href="../style/base.css">
    <style>
        .utitle{
            position: absolute;
            margin-left: 95px;
        }

        .view-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-left: 80px;
            width: 280px;
            height: auto;
            align-items: center;
            margin-top: 50px;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .employee-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }

        .employee-info {
            text-align: center;
        }
    </style>
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
            <h2 class="utitle"> Employee Details</h2>
                <div class="view-container">
                    <img src="employee-photo.jpg" alt="." class="employee-photo">
                    <div class="employee-info">
                        <?php
                            // Check if the 'id' parameter is present in the URL
                            if (isset($_GET['id'])) {
                                $employee_id = $_GET['id'];

                                $sql = "SELECT * FROM emp_info
                                        JOIN department ON emp_info.dept_id = department.dept_id
                                        WHERE emp_id = $employee_id";

                                $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    echo "Employee ID: " . $row['emp_id'] . "<br>";
                                    echo "Employee Name: " . $row['emp_name'] . "<br>";
                                    echo "Employee Email: " . $row['emp_email'] . "<br>";
                                    echo "Employee Address: " . $row['emp_address'] . "<br>";
                                    echo "Department: " . $row['dept_name'] . "<br>";
                                } else {
                                    echo "<h2>No Record Found</h2>";
                                }
                            } else {
                                echo "<h2>No Employee ID Provided</h2>";
                            }
                        ?>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</body>
</html>