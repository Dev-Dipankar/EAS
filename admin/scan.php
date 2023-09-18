

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

      if (code) {
        const qrResultElement = document.getElementById('qr-result');
        qrResultElement.textContent = code.data;
      }

      requestAnimationFrame(scanQRCode);
    }
  </script>
</body>
</html>