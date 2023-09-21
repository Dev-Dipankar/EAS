<!DOCTYPE html>
<html>
<head>
    <?php
    require_once '../database/dbconnect.php';
    session_start();

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("location: login.php");
        exit;
    }

    $employee_id = $_SESSION['emp_id']; // Assuming you store the employee ID in the session upon login

    $sql = "SELECT * FROM emp_info
            JOIN department ON emp_info.dept_id = department.dept_id
            WHERE emp_id = $employee_id";

    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $employee_name = $row['emp_name']; // Employee name for the title and admin-title
    } else {
        $employee_name = "Employee"; // Default if no record is found
    }
    ?>
    <title>Welcome <?php echo $employee_name; ?></title>
    <link rel="stylesheet" type="text/css" href="../style/base.css">
    <style>
        .box{
            height: 90%;
        }
        
        .utitle{
            position: relative;
            margin-left: 95px;
        }

        .view-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 280px;
            height: auto;
            margin: 15px;
            align-items: center;
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
            margin-bottom: 8px;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .qrBtn {
            background-color: #5e50a1;
            border: none;
            padding: 10px 80px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            align-items: center;
        }

        .qrBtn:hover {
            background-color: #4ebcfc;
        }

        .qrBtn a {
            color: black;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="nav">
    <div class="admin-title">Welcome <?php echo $employee_name; ?></div>
    <div class="logout"><a href="logout.php">Logout</a></div>
</div>
<div class="container">
        <div class="side_panel">
            <div class="spanel_button"><a href="empdetails.php">Home</a></div>
        </div>
        <div class="second">
            <div class="box">
                <div class="view-container">
                    <img src="employee-photo.jpg" alt="." class="employee-photo">
                    <div>
                        <?php
                            $employee_id = $_SESSION['emp_id']; // Assuming you store the employee ID in the session upon login

                            $sql = "SELECT * FROM emp_info
                                    JOIN department ON emp_info.dept_id = department.dept_id
                                    WHERE emp_id = $employee_id";

                            $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                // Display employee information here
                                echo "<div class= employee-info>Employee ID: " . $row['emp_id'] . "</div>";
                                echo "<div class=employee-info>Employee Name: " . $row['emp_name'] . "</div>";
                                echo "<div class=employee-info>Employee Email: " . $row['emp_email'] . "</div>";
                                echo "<div class=employee-info>Employee Address: " . $row['emp_address'] . "</div>";
                                echo "<div class=employee-info>Department: " . $row['dept_name'] . "</div>";
                                echo "<div class='button-container'><button class='qrBtn'><a href='generate_qr_daily.php?id=" . $row['emp_id'] . "'>QR</a></button></div>";
                            } else {
                                echo "<h2>No Record Found</h2>";
                            }
                        ?>
                    </div>
                </div>
                </div>
            </div> 
        </div>
    </div>
</body>
</html>