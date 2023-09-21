<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once('../database/dbconnect.php');

    // Get the QR code data from the GET request
    if (isset($_GET['hash'])) {
        $qrCodeData = $_GET['hash'];

        // Check if the QR code data exists in the emp_info table
        $checkQuery = "SELECT * FROM emp_info WHERE qr_code = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param('s', $qrCodeData);
        $stmt->execute();
        $checkResult = $stmt->get_result();

        if ($checkResult->num_rows == 1) {
            // Get the current timestamp and date
            $timestamp = date('H:i:s');
            $logDate = date('Y-m-d');

            // Debugging: Log the received QR code data, timestamp, and date
            error_log('Received QR code data: ' . $qrCodeData);
            error_log('Timestamp: ' . $timestamp);
            error_log('Log Date: ' . $logDate);

            // Check if a time-in record exists for this QR code
            $checkScanQuery = "SELECT * FROM scan_records WHERE qr_code = ? AND time_in IS NOT NULL AND time_out IS NULL";
            $stmt = $conn->prepare($checkScanQuery);
            $stmt->bind_param('s', $qrCodeData);
            $stmt->execute();
            $checkScanResult = $stmt->get_result();

            if ($checkScanResult->num_rows == 0) {
                // Insert a new record for time-in
                $insertQuery = "INSERT INTO scan_records (qr_code, time_in, time_out, logdate) VALUES (?, ?, NULL, ?)";
                $stmt = $conn->prepare($insertQuery);
                $stmt->bind_param('sss', $qrCodeData, $timestamp, $logDate);

                if ($stmt->execute()) {
                    echo 'Time-in recorded successfully.';
                } else {
                    echo 'Error recording time-in: ' . $conn->error;
                }
            } else {
                // Check if it has been 4 hours since time-in
                $timeInRecord = $checkScanResult->fetch_assoc();
                $timeInTimestamp = strtotime($timeInRecord['time_in']);
                $currentTimestamp = strtotime($timestamp);

                // Check if at least 4 hours have passed
                if ($currentTimestamp - $timeInTimestamp >= 600) {
                    // Update the existing record with time-out
                    $updateQuery = "UPDATE scan_records SET time_out = ? WHERE qr_code = ? AND time_in IS NOT NULL AND time_out IS NULL";
                    $stmt = $conn->prepare($updateQuery);
                    $stmt->bind_param('ss', $timestamp, $qrCodeData);

                    if ($stmt->execute()) {
                        echo 'Time-out recorded successfully.';
                    } else {
                        echo 'Error recording time-out: ' . $conn->error;
                    }
                } else {
                    echo 'Time-out can only be recorded after 30 mins of time-in.';
                }
            }
        } else {
            echo 'QR code not found in the employee records.';
        }
    } else {
        echo 'QR code data not found in the request.';
    }

    // Close the database connection
    $conn->close();
?>
