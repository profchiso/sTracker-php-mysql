<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome</title>
		<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
      body{ font: 14px sans-serif; text-align: center; }
    </style>
	
</head>
<body>
	

	<div class="page-header">
        <h2>Welcome <b><?php echo htmlspecialchars ($_SESSION["staff_no"]); ?></b> <br /><?php echo htmlspecialchars ($_SESSION["dept"]); ?>Department.</h2>
		<p> <a href="reset-password.php" class="btn btn-warning">Reset Password</a> 
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
		</p>
    </div>
	
	
	<div class="container-login100">
		<div class="wrap-login100">
			<form>

				<div class="container-login100-form-btn">
					<div class="wrap-login100-form-btn">
						<div class="login100-form-bgbtn"></div>
							<button onclick="location.href = 'unattended.php';"type="button" class="login100-form-btn"  >
								Unattended Document
							</button>
						</div>
					</div>
				<div class="container-login100-form-btn">
					<div class="wrap-login100-form-btn">
						<div class="login100-form-bgbtn"></div>
							<button onclick="location.href = 'paper.php';"type="button" class="login100-form-btn"  >
								Paper Document
							</button>
						</div>
					</div>				<div class="container-login100-form-btn">
					<div class="wrap-login100-form-btn">
						<div class="login100-form-bgbtn"></div>
							<button onclick="location.href = 'electronic.php';"type="button" class="login100-form-btn"  >
								Electronic Document
							</button>
						</div>
					</div>				<div class="container-login100-form-btn">
					<div class="wrap-login100-form-btn">
						<div class="login100-form-bgbtn"></div>
							<button onclick="location.href = 'track.php';"type="button" class="login100-form-btn"  >
								Track Document Status
							</button>
						</div>
					</div>				<div class="container-login100-form-btn">
					<div class="wrap-login100-form-btn">
						<div class="login100-form-bgbtn"></div>
							<button onclick="location.href = 'about.php';"type="button" class="login100-form-btn"  >
								About Smart Tracker
							</button>
						</div>
					</div>				<div class="container-login100-form-btn">
					<div class="wrap-login100-form-btn">
						<div class="login100-form-bgbtn"></div>
							<button onclick="location.href = 'logout.php';"type="button" class="login100-form-btn"  >
								Log-out
							</button>
						</div>
					</div>

					
				</form>
			</div>
		</div>
	    
	




 
</body>
</html>