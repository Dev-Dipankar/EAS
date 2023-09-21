<?php
    include "../database/dbconnect.php";

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $id = $_GET['id'];  // Get the ID from the URL parameter

        $query = "SELECT * FROM emp_info JOIN department WHERE emp_info.dept_id = department.dept_id AND emp_id = $id";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $empname = $row['emp_name'];
            $empaddress = $row['emp_address'];
            $empemail = $row['emp_email'];
            $department = $row['dept_name'];

            // Include the current date in the data to encode
            $currentDate = date('Y-m-d');
            $dataToEncode = "Date:$currentDate,Name:$empname,Address:$empaddress,Email:$empemail,Department:$department";

            // Updated hashing function using FNV-1 with the current date
            function fnv1_hash($data, $seed = 0x811C9DC5) {
                $hash_value = $seed;
                $data_bytes = str_split($data);

                foreach ($data_bytes as $byte) {
                    $hash_value ^= ord($byte);
                    $hash_value *= 0x01000193;
                    $hash_value = $hash_value & 0xFFFFFFFF; // Limit to 32 bits (optional for 32-bit hashes)
                }

                return $hash_value;
            }

            // Apply FNV-1 hashing to the updated data
            $hashedData = fnv1_hash($dataToEncode);

            // Insert the hashed QR code data into the database
            $updateQuery = "UPDATE emp_info SET qr_code = '$hashedData' WHERE emp_id = $id";
            mysqli_query($conn, $updateQuery);
        }
    }
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
    <div class="admin-title">Employee QR</div>
    <div class="logout"><a href="logout.php">Logout</a></div>
</div>

<div class="container">
    <div class="side_panel">
        <div class="spanel_button"><a href="empDetails.php">Home</a></div>
    </div>
    <div class="second">
        <div class="box">
            <div id="qrcode-container">
                <h1>Scan for Attendance</h1>
                <div id="qrcode"></div>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to generate QR code from data using FNV-1 hashing
    function generateQRCode(data) {
        const qrcode = new QRCode(document.getElementById("qrcode"), {
            text: data,
            width: 128,
            height: 128,
        });
    }

    // Apply FNV-1 hashing to the data
    const dataToEncode = '<?php echo $hashedData; ?>'; // Ensure proper formatting
    generateQRCode(dataToEncode);
</script>
</body>
</html>