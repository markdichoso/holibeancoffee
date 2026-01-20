
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
							url:"location",
							data:{latitude: latitude, longitude: longitude},
							success:function(msg){
								if(msg){
								$("#location_in").val(msg);
								}else{
									$("#location_in").val('Not Available');
								}
							}
						});
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
				<?php if (session()->getFlashdata('success') !== null) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
				<?php $attributes = ['class' => 'login100-form validate-form', 'id' => 'timeInForm']; ?>
				<?= form_open('send_in') ?>
					<div class="wrap-input100 validate-input m-b-50" data-validate="Branch Location">
						<input class="input100" id="location_in" type="text" name="location_in" required>
					</div>
					<!-- <input type="hidden" id="time_in" name="time_in" value="time_in"> -->
					<input type="hidden" id="emp_info_id" name="emp_info_id" value="1">
                    <input type="submit" class=" login100-form-btn" value="Time In">
				<?= form_close() ?>
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