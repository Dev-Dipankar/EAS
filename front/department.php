<?php
  include '../database/dbconnect.php';
  include '../database/dept_be.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Department Management</title>
    <!-- <link rel="stylesheet" type="text/css" href="./base.css"> -->
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

        form {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            
            align-items: center;
            min-height: 100vh;
            margin: 0; 
        }

        h1 {
            text-align: center;
        }
       
        .input-container {
            text-align: right;
            margin-bottom: 10px;
        }

        input[type="text"] {
            padding: 5px;
        }

        button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .updateBtn {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .deleteBtn {
            padding: 5px 10px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
        }
        
        table {
            width: 60%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th:first-child {
            width: 20px;
        }

        th {
            background-color: #f2f2f2;
        }

        
        td {
            text-align: right;
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
            <form class="box" action="../database/dept_be.php" method="post">
                <h1>Department Management</h1>
                <div class="input-container">
                    <input type="text" id="departmentInput" placeholder="Enter Department" name="dept_name">
                    <button onclick="addDepartment()">Add Department</button>
                </div>

                <table id="departmentTable" border="1">
                    <tr>
                        <th>S.N</th>
                        <th>Departement</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM department";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                            // output data of each row
                                while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>                           
                            <td><?= $row["dept_id"]?></td>
                            <td><?= $row["dept_name"]?></td>
                            <td>
                                <!-- <button class=updateBtn><a href="../database/update_dept.php?id=<?php echo $row['dept_id'] ?>">Update</a></button>                                        -->
                                <button class=deleteBtn><a href="../database/delete.php?id=<?php echo $row['dept_id'] ?>">Delete</a></button>
                            </td>
                        </tr>
                        <?php
                                }
                            } 
                        ?>
                    </tbody>
                </table>
            </form>
        </div>    
    </div>                      
    <!-- <script>
        
        var departmentCount = 1;

        function addDepartment() {
            
            var departmentName = document.getElementById("departmentInput").value;

            if (departmentName.trim() === "") {
                alert("Please enter a valid department name.");
                return;
            }
            var table = document.getElementById("departmentTable");
            var newRow = table.insertRow(table.rows.length);
            var countCell = newRow.insertCell(0);
            countCell.innerHTML = departmentCount++;
            var departmentCell = newRow.insertCell(1);
            departmentCell.innerHTML = departmentName;

            var actionCell = newRow.insertCell(2);
            actionCell.innerHTML = '<button onclick="updateDepartment(this)">Update</button>';

  
            document.getElementById("departmentInput").value = "";
        }

       
        function updateDepartment(button) {
            var departmentName = prompt("Enter the updated department name:");

            if (departmentName === null || departmentName.trim() === "") {
                alert("Please enter a valid department name.");
                return;
            }

            var row = button.parentNode.parentNode;
            var departmentCell = row.cells[1];
            departmentCell.innerHTML = departmentName;
        }
    </script> -->
</body>
</html>
