<?php
    include '../database/dbconnect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Info</title>
    <link rel="stylesheet" type="text/css" href="base.css">
    <style>
        .search-container {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 20px;
            margin-left: 200px;
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
            width: 80%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
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
    <!-- <script>
        function updateTime() {
                var currentTime = new Date();
                var hours = currentTime.getHours();
                var minutes = currentTime.getMinutes();
                var seconds = currentTime.getSeconds();

                var ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12; // to convert time 0-12

                var timeString = hours + ':' + padZero(minutes) + ':' + padZero(seconds) + ' ' + ampm;
                var timeElement = document.getElementById('currentTime');
                timeElement.innerHTML = timeString;
            }

            function padZero(value) {
                return value < 10 ? '0' + value : value;
            }

            updateTime();
            setInterval(updateTime, 1000); // to Update time every second

            var currentDate = new Date();
            var convertedDate = currentDate.toLocaleDateString('ne-NP');
            var nepaliDateElement = document.getElementById("nepaliDate");
            nepaliDateElement.innerHTML = convertedDate;

            var viewPage = document.getElementById('viewPage');
            var viewPageImage = document.querySelector('.view-page img');
            var viewPageName = document.querySelector('.view-page h2');
            var viewPageEmail = document.querySelector('.view-page p.email');
            var viewPageBio = document.querySelector('.view-page p.bio');

           

            var closeButton = document.getElementById('closeButton');
            closeButton.addEventListener('click', closeViewPage);
    </script> -->
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
                <div class="search-container">
                    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search by name">
                    <div class="date-container">
                        Nepali: <span id="nepaliDate"></span>
                    </div>
                    <div class="time-container">
                        Current Time: <span id="currentTime"></span>
                    </div>
                </div>
                <?php 
                    $sql = ("SELECT * FROM emp_info JOIN department WHERE emp_info.dept_id = department.dept_id") or die("failed to query database".mysqli_error());

                
                    $result = mysqli_query($conn, $sql) or die("Query Unsuccessfull");
                
                    if(mysqli_num_rows($result) > 0){
                ?>
                <table border="1">
                    <tr>
                        <th>ID.</th>
                        <th>Employee Name</th>
                        <th>Employee Address</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                    <tbody> 
                        <?php 
                            while($row = $result->fetch_assoc()) {
                                ?>
                                <tr>                           
                                    <td><?= $row['emp_id']?></td>
                                    <td><?= $row['emp_name']?></td>
                                    <td><?= $row['emp_address']?></td>
                                    <td><?= $row['dept_name']?></td>
                                    
                                    <td>
                                        <button class=detailsBtn><a href="empDetails.php?id=<?php echo $row['emp_id'] ?>">Details</a></button>
                                        <button class=qrBtn><a href="qrhashed_new.php?id=<?php echo $row['emp_id'] ?>">QR</a></button>
                                        <button class=deleteBtn><a href="../database/delete_emp.php?id=<?php echo $row['emp_id'] ?>">Delete</a></button>
                                        <button class=updateBtn><a href="empupdate.php?id=<?php echo $row['emp_id'] ?>">Update</a></button>
                                    </td>
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