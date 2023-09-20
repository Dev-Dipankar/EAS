<?php
function recordTime(qrCodeData) {
    console.log(qrCodeData)
      // Send an AJAX request to the server with the QR code data and timestamp
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'http://localhost/EAS-main/chatgpt/record_time.php'); // Create a new PHP file for this
      //xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    	window.location.href = 'http://localhost/EAS-main/chatgpt/record_time.php?hash='+qrCodeData;
    
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {  console.log(xhr.status)
          if (xhr.status === 200) {
            // Successfully recorded time-in
            console.log('Time-in recorded successfully.');
          } else {
            // Display an error message if recording fails
            const qrResultElement = document.getElementById('qr-result');
            qrResultElement.textContent = 'Error recording time-in.';
            console.error('Failed to record time-in.');
          }
        }
      };
      
      // Get the current timestamp in 'YYYY-MM-DD HH:MM:SS' format
      const timestamp = new Date().toISOString().slice(0, 19).replace('T', ' ');

      // Send the QR code data and timestamp as POST parameters
      xhr.send('qrCodeData=' + encodeURIComponent(qrCodeData) + '&timestamp=' + encodeURIComponent(timestamp));
    }