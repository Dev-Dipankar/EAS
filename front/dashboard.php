<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
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
        
        .side_panel {
            width: 200px;
            background-color: rgb(34, 33, 33);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        
        .second {
            flex: 1;
            background-color:rgb(143, 142, 142);
            display: flex;
            flex-wrap: wrap; /* Allow content boxes to wrap */
            padding: 20px;
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
        
        .content-box {
            flex: 0 0 calc(20% - 20px); /* Four boxes in one row without margin */
            height: 80px;
            display: flex;
            flex-direction: column;
            margin: 5px; /* Add margin here */
            padding: 20px;
            background-color: white;
            border: 1px solid gray;
            border-radius: 5px;
            
            transition: background-color 0.3s; /* Added hover effect transition */
        }
        
        .content-box:hover {
            background-color: lightyellow; /* Change background color on hover */
        }
        
        .container{
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: row;
        }
        
    </style>
</head>
<body>
    <div class="nav">
        <div class="dashboard"><a href="department.php">Dashboard</a></div>
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
