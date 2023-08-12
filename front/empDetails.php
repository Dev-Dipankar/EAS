<?php
    include "../database/dbconnect.php";
    // include "../database/empDetails_be.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Details</title>
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