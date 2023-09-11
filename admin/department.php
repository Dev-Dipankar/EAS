<?php
  include '../database/dbconnect.php';
  include '../database/dept_be.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Department Management</title>
    <link rel="stylesheet" type="text/css" href="../style/base.css">
    <style>
        form {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 80vh;
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
            <div class="spanel_button"><a href="../chatgpt/scan_c.php">Attendance</a></div>
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
