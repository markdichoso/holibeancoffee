
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V6</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="src/css/bootstrap/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="src/css/fonts/font-awesome/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="src/css/fonts/iconic/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="src/css/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="src/css/hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="src/css/animsition/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="src/css/select/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="src/css/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="src/css/util.css">
	<link rel="stylesheet" type="text/css" href="src/css/main.css">
<!--===============================================================================================-->
<meta name="robots" content="noindex, follow">
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
                <span class="login100-form-title p-b-70">
                    <h2>Time Out</h2>
                    <p id="status">Click the button to time-out.</p>
                </span>

                <form class="login100-form validate-form" id="timeOutForm" method="POST" action="#">
                    
					<div class="wrap-input100 validate-input m-b-50" data-validate="Branch Location">
						<input class="input100" type="text" name="branch_loc">
						<span class="focus-input100" data-placeholder="Branch Location"></span>
					</div>
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                    <input type="hidden" name="time_out" id="time_out">
                    <button type="button" class="login100-form-btn" onclick="timeOut()">Time Out</button>
                </form>

                <script>
                    function timeOut() {
                        if (navigator.geolocation) {
                            var a = "With GPS Location";
                            navigator.geolocation.getCurrentPosition(success, error);
                        } else {
                            var a = "Without GPS Location";
                            document.getElementById('status').innerText = "Geolocation is not supported by this browser.";
                        }
                        alert(a);
                    }

                    function success(position) {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;
                        const now = new Date();

                        document.getElementById('latitude').value = latitude;
                        document.getElementById('longitude').value = longitude;
                        document.getElementById('time_out').value = now.toISOString();

                        document.getElementById('timeOutForm').submit();
                    }

                    function error() {
                        document.getElementById('status').innerText = "Unable to retrieve your location.";
                    }
                </script>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="src/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="src/css/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="src/css/bootstrap/js/popper.js"></script>
	<script src="src/css/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="src/css/select/js/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="src/css/daterangepicker/js/moment.min.js"></script>
	<script src="src/css/daterangepicker/js/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="src/jquery/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="src/jquery/main.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');
	</script>
</body>
</html>
