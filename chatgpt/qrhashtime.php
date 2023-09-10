<?php
    include "../database/dbconnect.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>QR Code Generator</title>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
</head>
<body>
    <div id="container">
        <h1>QR Code Generator</h1>
        <div id="qrcode"></div>
        <p>Company name and other information goes here</p>
    </div>

    <style>
        /* Your existing CSS styles here */
    </style>

    <script>
        // PHP code to fetch data from the database based on the ID parameter
        <?php
            $id = $_GET['id'];  // Get the ID from the URL parameter
            $query = "SELECT * FROM emp_info JOIN department WHERE emp_info.dept_id = department.dept_id";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $empname = $row['emp_name'];
                $empaddress = $row['emp_address'];
                $empemail = $row['emp_email'];
                $department = $row['dept_name'];
            }
        ?>

        // Construct the data to encode into the QR code
        const currentTime = new Date().getTime(); // Get current timestamp
        const uniqueData = `Timestamp: ${currentTime}\nName: <?php echo $empname; ?>\nAddress: <?php echo $empaddress; ?>\nEmail: <?php echo $empemail; ?>\nDepartment: <?php echo $department; ?>`;

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
        sha256(uniqueData).then(hashedData => {

        // Generate the QR code with the hashed data
        generateQRCode(hashedData);
        });
    </script>
</body>
</html>
