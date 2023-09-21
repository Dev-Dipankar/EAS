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
    <title>Attendance Report</title>
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
        <div class="admin-title">Attendance Report</div>
        <div class="logout"><a href="logout.php">Logout</a></div>
    </div>
    <div class="container">
        <div class="side_panel">
            <div class="spanel_button"><a href="dashboard.php">Dashboard</a></div>
            <div class="spanel_button"><a href="department.php">Department</a></div>
            <div class="spanel_button"><a href="empReg.php">Register Employee</a></div>
            <div class="spanel_button"><a href="empInfo.php">Employee Info</a></div>
            <div class="spanel_button"><a href="scan.php">Attendance</a></div>
            <div class="spanel_button"><a href="empAttendance.php">Attendance Report</a></div>
        </div>
        <div class="second">
            <div class="box">
            <div class="search-container">
                    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search by name">
                    <div class="date-container">
                    Date: <span id="date"><?php echo date('d/m/Y'); ?></span>
                    </div>
                    <div class="time-container">
                    Current Time: <span id="currentTime"><?php echo date('h:i A'); ?></span>
                    </div>

                    <script>
                        function searchTable() {
                            var input, filter, table, tr, td, i, txtValue;
                            input = document.getElementById("searchInput");
                            filter = input.value.toUpperCase();
                            table = document.querySelector("table");
                            tr = table.getElementsByTagName("tr");

                            for (i = 0; i < tr.length; i++) {
                                td = tr[i].getElementsByTagName("td")[1]; // Column with employee names
                                if (td) {
                                    txtValue = td.textContent || td.innerText;
                                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                        tr[i].style.display = "";
                                    } else {
                                        tr[i].style.display = "none";
                                    }
                                }
                            }
                        }
                        function updateDate() {
                            var nepaliDateElement = document.getElementById("date");
                            var now = new Date();
                            var year = now.getFullYear();
                            var month = now.getMonth() + 1; // JavaScript months are 0-based
                            var day = now.getDate();

                            var nepaliDate = day + '/' + month + '/' + year;
                            nepaliDateElement.innerHTML = nepaliDate;
                        }

                        function updateTime() {
                            var currentTimeElement = document.getElementById("currentTime");
                            var now = new Date();
                            var hours = now.getHours();
                            var minutes = now.getMinutes();
                            var ampm = hours >= 12 ? 'PM' : 'AM';
                            hours = hours % 12;
                            hours = hours ? hours : 12; // Handle midnight (0 AM)
                            var timeString = hours + ':' + (minutes < 10 ? '0' + minutes : minutes) + ' ' + ampm;
                            currentTimeElement.innerHTML = timeString;
                        }

                        // Update the date and time immediately and then every second
                        updateDate();
                        updateTime();
                        setInterval(updateDate, 1000);
                        setInterval(updateTime, 1000);
                    </script>
                </div>
                <?php 
                   $sql ="SELECT * FROM scan_records LEFT JOIN emp_info ON scan_records.emp_id=emp_info.emp_id" or die("failed to query database".mysqli_error());

                
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
                           while ($row = $result->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $row['emp_id'];?></td>
                            <td><?php echo $row['emp_name'];?></td>
                            <td><?php echo $row['time_in'];?></td>
                            <td><?php echo $row['time_out'];?></td>
                            <td><?php echo $row['logdate'];?></td>
                        </tr>
                        <?php } ?>
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