
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="src/jquery/jquery-3.2.1.min.js"></script>
<script>
					$(document).ready(function(){
    				if(navigator.geolocation){
       				 navigator.geolocation.getCurrentPosition(showLocation);
    					}else{ 
        			$('#location').html('Geolocation is not supported by this browser.');
   							 }
					});

					function showLocation(position){
						var latitude = position.coords.latitude;
						var longitude = position.coords.longitude;
						$.ajax({
							type:'POST',
							url:"<?= base_url('src/location/getLocation.php') ?>",
							data:{latitude: latitude, longitude: longitude},
							success:function(msg){
								if(msg){
								$("#location").val(msg);
								}else{
									$("#location").val('Not Available');
								}
							}
						});
					}
                    function timeIn() {
					alert('ok');
                    //    if (navigator.geolocation) {
                     //       navigator.geolocation.getCurrentPosition(success, error);
                     //   } else {
                     //       document.getElementById('status').innerText = "Geolocation is not supported by this browser.";
                     //   }
                    }

                </script>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
                <span class="login100-form-title p-b-70">
                    <h2>Time In</h2>
                    <p id="status">Click the button to time-in.</p>
                </span>

                <form class="login100-form validate-form" id="timeInForm" method="POST" action="save_timein.php">
                    
					<div class="wrap-input100 validate-input m-b-50" data-validate="Branch Location">
						<input class="input100" id="location" type="text" name="branch_loc">
						
					</div>
                    <input type="hidden" name="location" id="location">
                    <input type="hidden" name="time_in" id="time_in">
                    <button type="button" class="login100-form-btn" onclick="timeIn()">Time In</button>
                </form>

                </div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

	

<!--===============================================================================================

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
<?= base_url() ?>