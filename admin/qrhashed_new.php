<?php
    include "../database/dbconnect.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee QR Code</title>
    <link rel="stylesheet" type="text/css" href="../style/base.css">
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

</head>
<body>
    <div class="nav">
        <div class="admin-title">Generated QR Code</div> 
        <div class="logout"><a href="logout.php">Logout</a></div>
    </div>
    
    <div class="container">
        <div class="side_panel">
            <div class="spanel_button"><a href="../admin/dashboard.php">Dashboard</a></div>
            <div class="spanel_button"><a href="../admin/department.php">Department</a></div>
            <div class="spanel_button"><a href="../admin/empReg.php">Register Employee</a></div>
            <div class="spanel_button"><a href="../admin/empInfo.php">Employee Info</a></div>
            <div class="spanel_button"><a href="../chatgpt/scan_c.php">Attendance</a></div>
            <!-- <div class="spanel_button"><a href="scan.php">Attendance</a></div> -->
            <div class="spanel_button"><a href="../admin/empAttendance.php">Attendance Report</a></div>           
        </div>
        <div class="second">
            <div class="box">
                <div id="qrcode-container">
                    <h1>Employee QR Code</h1>
                    <div id="qrcode"></div>
                    <p>ID: <span id="employee-id"><?php echo $id; ?></span></p>
                    <!-- <p>Company name and other information goes here</p> -->
                </div>
            </div>
            
        </div>        
    </div>
    <script>
        <?php
            $id = $_GET['id'];  // Get the ID from the URL parameter
            $query = "SELECT * FROM emp_info JOIN department WHERE emp_info.dept_id = department.dept_id AND emp_id = $id";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $empname = $row['emp_name'];
                $empaddress = $row['emp_address'];
                $empemail = $row['emp_email'];
                $department = $row['dept_name'];
        ?>

        // Construct the data to encode into the QR code
        const dataToEncode = `Name: <?php echo $empname; ?>\nAddress: <?php echo $empaddress; ?>\nEmail: <?php echo $empemail; ?>\nDepartment: <?php echo $department; ?>`;

        // SHA-256 hashing
        async function sha256(data) {
            const encoder = new TextEncoder();
            const dataUint8 = encoder.encode(data);
            const hashBuffer = await crypto.subtle.digest("SHA-256", dataUint8);
            const hashArray = Array.from(new Uint8Array(hashBuffer));
            const hashHex = hashArray.map(byte => byte.toString(16).padStart(2, '0')).join('');
            return hashHex;
        }

        // Function to generate QR code from data
        function generateQRCode(data) {
            const qrcode = new QRCode(document.getElementById("qrcode"), {
                text: data,
                width: 128,
                height: 128,
            });
        }

        // Apply SHA-256 hashing to the data
        sha256(dataToEncode).then(hashedData => {
            // Generate the QR code with the hashed data
            generateQRCode(hashedData);
        });
        <?php } ?>

        const employeeId = "<?php echo $id; ?>";
        document.getElementById('employee-id').textContent = employeeId;
    </script>
</body>
</html>