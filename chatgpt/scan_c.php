<!DOCTYPE html>
<html>

<head>
  <title>QR Code Scanner</title>
  <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.min.js"></script>
</head>

<body>
  <h1>QR Code Scanner</h1>
  <video id="qr-video" width="640" height="480" autoplay></video>
  <canvas id="qr-canvas" width="640" height="480" style="display: none;"></canvas>
  <p id="qr-result">Scanning...</p>

  <script>
    // Flag to track if the first scan is done
    let firstScan = true;

    // Get video stream from the camera
    navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
      .then(handleVideoStream)
      .catch(handleError);

    function handleVideoStream(stream) {
      const video = document.getElementById('qr-video');
      video.srcObject = stream;

      video.onloadedmetadata = () => {
        video.play();
        requestAnimationFrame(scanQRCode);
      };
    }

    function handleError(error) {
      console.error('Error accessing camera:', error);
    }

    function scanQRCode() {
      const video = document.getElementById('qr-video');
      const canvas = document.getElementById('qr-canvas');
      const context = canvas.getContext('2d');

      // Draw the video frame on the canvas
      context.drawImage(video, 0, 0, canvas.width, canvas.height);

      // Get the QR code information from the canvas
      const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
      const code = jsQR(imageData.data, imageData.width, imageData.height);

      if (code && firstScan) {
        const qrResultElement = document.getElementById('qr-result');
        qrResultElement.textContent = code.data;

        // Send the QR code data to the server to record time-in
        recordTime(code.data);

        firstScan = false; // Mark the first scan as done
      }

      requestAnimationFrame(scanQRCode);
    }

    // Function to send QR code data to the server for recording time-in
    function recordTime(qrCodeData) {
      // Send an AJAX request to the server with the QR code data and timestamp
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'record_time.php'); // Create a new PHP file for this
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
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
  </script>
</body>

</html>
