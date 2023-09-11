<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('dbconnect.php');

// Get the QR code data from the POST request
if (isset($_POST['qrCodeData'])) {
    $qrCodeData = $_POST['qrCodeData'];

    // Debugging: Log the received QR code data
    error_log('Received QR code data: ' . $qrCodeData);

    // Get the current timestamp
    $timestamp = date('Y-m-d H:i:s');

    // Debugging: Log the timestamp
    error_log('Timestamp: ' . $timestamp);

    // Check if the QR code data already exists in the database
    $checkQuery = "SELECT * FROM scan_records WHERE qr_code_data = '$qrCodeData'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) == 0) {
        // Insert a new record for time-in
        $insertQuery = "INSERT INTO scan_records (qr_code_data, time_in) VALUES ('$qrCodeData', '$timestamp')";
        if (mysqli_query($conn, $insertQuery)) {
            echo 'Time-in recorded successfully.';
        } else {
            echo 'Error recording time-in: ' . mysqli_error($conn);
        }
    } else {
        // Update the existing record with time-out
        $updateQuery = "UPDATE scan_records SET time_out = '$timestamp' WHERE qr_code_data = '$qrCodeData'";
        if (mysqli_query($conn, $updateQuery)) {
            echo 'Time-out recorded successfully.';
        } else {
            echo 'Error recording time-out: ' . mysqli_error($conn);
        }
    }
} else {
    echo 'QR code data not found in the request.';
}

// Close the database connection
mysqli_close($conn);
?>
