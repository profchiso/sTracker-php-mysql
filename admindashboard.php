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
    <title>Admin</title>
		<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="asset/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="asset/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="asset/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="asset/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="asset/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="asset/daterangepicker/daterangepicker.css">
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
        <a href="adminlogout.php" class="btn btn-danger">Sign Out of Your Account</a>
		</p>
    </div>
	
	
	<div class="container-login100">
		<div class="wrap-login100">
			<form>

				<div class="container-login100-form-btn">
					<div class="wrap-login100-form-btn">
						<div class="login100-form-bgbtn"></div>
							<button onclick="location.href = 'register.php';"type="button" class="login100-form-btn"  >
								Register New Staff
							</button>
						</div>
					</div>
				<div class="container-login100-form-btn">
					<div class="wrap-login100-form-btn">
						<div class="login100-form-bgbtn"></div>
							<button onclick="location.href = 'department.php';"type="button" class="login100-form-btn"  >
								Add New Department
							</button>
						</div>
					</div>				
					<div class="container-login100-form-btn">
					<div class="wrap-login100-form-btn">
						<div class="login100-form-bgbtn"></div>
							<button onclick="location.href = 'admintrack.php';"type="button" class="login100-form-btn"  >
								Track Document Status
							</button>
						</div>
					</div>				
					<div class="container-login100-form-btn">
					<div class="wrap-login100-form-btn">
						<div class="login100-form-bgbtn"></div>
							<button onclick="location.href = 'adminlogout.php';"type="button" class="login100-form-btn"  >
								Log-out
							</button>
						</div>
					</div>

					
				</form>
			</div>
		</div>
	    
	




 
</body>
</html>