<!-- app/Views/capture_image.php -->
<h2>Webcam Image Capture</h2>
<video id="video" width="640" height="480" autoplay></video>
<button id="capture-btn">Capture Photo</button>
<canvas id="canvas" width="640" height="480" style="display: none;"></canvas>
<div id="output"></div>

<script src="https://code.jquery.com"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="src/jquery/jquery-3.2.1.min.js"></script>

<script>
$(document).ready(function() {
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureBtn = document.getElementById('capture-btn');
    const output = document.getElementById('output');
    const context = canvas.getContext('2d');

    // Access the camera
    navigator.mediaDevices.getUserMedia({ video: true })
        .then((stream) => {
            video.srcObject = stream;
        })
        .catch((err) => {
            console.error("Error accessing camera: ", err);
            output.innerHTML = "<p>Camera access denied or not supported.</p>";
        });

    // Capture the photo and send to server
    captureBtn.addEventListener('click', () => {
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageDataUrl = canvas.toDataURL('image/jpeg');
        
        // Use Ajax to send the Base64 image data to the CodeIgniter controller
        $.ajax({
            type: "POST",
            url: "<?= site_url('image/upload') ?>", // Adjust the URL to your controller method
            data: { 
                imageData: imageDataUrl,
                "<?= csrf_token() ?>": "<?= csrf_hash() ?>" // CSRF token for CI4 security
            },
            success: function(response) {
                output.innerHTML = "<p>Image saved successfully!</p><img src='" + response + "'/>";
            },
            error: function(xhr, status, error) {
                output.innerHTML = "<p>Error saving image: " + error + "</p>";
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
