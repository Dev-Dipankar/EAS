<?php
    include '../database/dbconnect.php';

    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: login.php");
        exit;
    }
?>  

<!DOCTYPE html>
<html>
<head>
    <title>Employee Info</title>
    <link rel="stylesheet" type="text/css" href="../style/base.css">
    <style>
        .search-container {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            height: 50px;
            margin: 80px 0px 10px 200px;
        }

        .search-container input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            margin-right: 10px;
        }

        .date-container {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            font-weight: bold;
        }

        .time-container {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            font-weight: bold;
            margin-left: 10px;
        }

        table {
            border-collapse: collapse;
            width: 90%;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            height: 2px;
        }

        /* tr:hover {
            background-color: #f5f5f5;
        } */

        .employee-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .employee-name {
            font-weight: bold;
        }

        .profile {
            border-radius: 50%;
        }

        .stat {
            color: green;
        }

        .istat {
            color: red;
        }

        .action-buttons button {
            margin-right: 5px;
        }

        .view-page {
            display: none;
            max-width: 600px;
            margin-top: 20px;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
        }

        .view-page img {
            max-width: 100%;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .view-page h2 {
            margin-top: 0;
        }

        .view-page p {
            margin-bottom: 10px;
        }

        .view-page .close-button {
            display: flex;
            justify-content: flex-end;
        }

        .view-page .close-button button {
            padding: 5px 10px;
            background-color: #ddd;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="nav">
        <div class="admin-title">Employee List</div>
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
                <?php 
                    $sql = ("SELECT * FROM emp_info JOIN department WHERE emp_info.dept_id = department.dept_id") or die("failed to query database".mysqli_error());

                
                    $result = mysqli_query($conn, $sql) or die("Query Unsuccessfull");
                
                    if(mysqli_num_rows($result) > 0){
                ?>
                <table border="1">
					<thread>
						<tr>
							<th>ID.</th>
							<th>Employee Name</th>
							<th>Time IN</th>
							<th>Time Out</th>
							<th>Log Date</th>
						</tr>
					</thread>
					<tbody>
                        <?php
                        $server = "localhost";
                        $username="root";
                        $password="";
                        $dbname="qrcodedb";
                    
                        $conn = new mysqli($server,$username,$password,$dbname);
						$date = date('Y-m-d');
                        if($conn->connect_error){
                            die("Connection failed" .$conn->connect_error);
                        }
                           $sql ="SELECT * FROM attendance LEFT JOIN student ON attendance.STUDENTID=student.STUDENTID";
                           $query = $conn->query($sql);
                           while ($row = $query->fetch_assoc()){
                        ?>
                            <tr>
                                <td><?php echo $row['LASTNAME'].', '.$row['FIRSTNAME'].' '.$row['MNAME'];?></td>
                                <td><?php echo $row['STUDENTID'];?></td>
                                <td><?php echo $row['TIMEIN'];?></td>
                                <td><?php echo $row['TIMEOUT'];?></td>
                                <td><?php echo $row['LOGDATE'];?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>

                <?php }else{
                    echo "<h2>No Record Found</h2>";
                } ?>
            </div>
        </div>
    </div>
</body>
</html>