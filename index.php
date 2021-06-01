<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$staff_no = $password = "";
$staff_no_err = $password_err = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if staff_no is empty
    if(empty(trim($_POST["staff_no"]))){
        $staff_no_err = "Please enter staff Number.";
    } else{
        $staff_no = trim($_POST["staff_no"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($staff_no_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT staff_no, password, dept FROM users WHERE staff_no = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_staff_no);
            
            // Set parameters
            $param_staff_no = $staff_no;
			            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if staff_no exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $staff_no, $hashed_password, $dept);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            //$_SESSION["id"] = $id;
                            $_SESSION["staff_no"] = $staff_no;
							$_SESSION["dept"] = $dept;
							
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if staff_no doesn't exist
                    $staff_no_err = "No account found with that staff Number.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Smart Tracker</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="static/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="static/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="static/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="static/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="static/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="static/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <span class="login100-form-title p-b-26">
                        Smart Tracker
                    </span>
                    <span class="login100-form-title p-b-48">
                        <i class="zmdi zmdi-globe-lock"> </i>
                    </span>

                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>Staff Number</label>
                        <input type="text" name="staff_no" class="form-control" value="<?php echo $staff_no; ?>">
                        <span class="help-block"><?php echo $staff_no_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>



                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>
                    <div> <br />
                        <div><b>
                                <center> <a href="guest.php"> Guest? Track Document Here </a> </center>
                            </b>

                        </div>
                        <br />

                    </div>
                    <div><b>
                            <center>If not registered or can't login, contact SmartTracker Administrator</center>
                        </b>

                    </div>
                    <br /> <br />
                    <p>
                        <center>If you are an admin <a href="admin.php">Login here</a>.</center>
                    </p>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="static/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="static/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="static/bootstrap/js/popper.js"></script>
    <script src="static/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="static/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="static/daterangepicker/moment.min.js"></script>
    <script src="static/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="static/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>

</html>