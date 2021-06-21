<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$staff_no = $password = $confirm_password = $surname = $othernames = $email = $dept = $phone = "";
$staff_no_err = $password_err = $confirm_password_err = $surname_err = $othernames_err = $email_err =$dept_err = $phone_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate staff_no
    if(empty(trim($_POST["staff_no"]))){
        $staff_no_err = "Please enter your Staff Number.";
    } else{
        // Prepare a select statement
        $sql = "SELECT staff_no FROM users WHERE staff_no = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_staff_no);
            
            // Set parameters
            $param_staff_no = trim($_POST["staff_no"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $staff_no_err = "This staff_no is already taken.";
                } else{
                    $staff_no = trim($_POST["staff_no"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
	    // Validate Surname
    if(empty(trim($_POST["surname"]))){
        $surname_err = "Please enter your Surname.";     
    } else{
        $surname = trim($_POST["surname"]);
    }
		    // Validate Othernames
    if(empty(trim($_POST["othernames"]))){
        $othernames_err = "Please enter your Othernames.";     
    } else{
        $othernames = trim($_POST["othernames"]);
    }
	    // Validate Email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your Email.";     
    } else{
        $email = trim($_POST["email"]);
    }	
		    // Validate Department
    if(empty(trim($_POST["dept"]))){
        $dept_err = "Please select your Department.";     
    } else{
        $dept = trim($_POST["dept"]);
    }
		    // Validate Phone Number
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter your Phone Number.";     
    } else{
        $phone = trim($_POST["phone"]);
    }
	
	
    // Check input errors before inserting in database
    if(empty($staff_no_err) && empty($password_err) && empty($confirm_password_err) && empty($surname_err) && empty($othernames_err) && empty($dept_err) && empty($email_err) && empty($phone_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (staff_no, password, surname, othernames, email, dept, phone) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_staff_no, $param_password, $param_surname, $param_othernames, $param_email, $param_dept, $param_phone);
            
            // Set parameters
            $param_staff_no = $staff_no;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
			$param_surname =  $surname;
			$param_othernames = $othernames;
			$param_email = $email;
			$param_dept = $dept; 
			$param_phone = $phone;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
				
				$message = $param_staff_no.", Your Registration was Successful! You can now Login";	
				echo"<font color='red'><script type='text/javascript'> alert('$message');</script> </font>";
                // Redirect to index page
				echo "<script type='text/javascript'>location.href = 'admindashboard.php'</script>";
                //header("location: index.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
    <title>Sign Up</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->


</head>

<body>
    <div class="page-header" align="center">
        <br />
        <h1>Add New Staff </h1>
        <p> <a href="admindashboard.php" class="btn btn-warning">Go Back</a>
            <a href="adminlogout.php" class="btn btn-danger">Sign Out of Your Account</a>
        </p> <br />
    </div>


    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <span class="login100-form-title p-b-26">
                    Sign Up</span>
                <span class="login100-form-title p-b-48">
                    <i class="zmdi zmdi-globe-lock"> </i>
                </span>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($staff_no_err)) ? 'has-error' : ''; ?>">
                        <label>Staff Number (e.g. SS123)</label>
                        <input type="text" name="staff_no" class="form-control" value="<?php echo $staff_no; ?>">
                        <span style="color:red" class="help-block"><?php echo $staff_no_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password (More than 6 charcters)</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                        <span style="color:red" class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control"
                            value="<?php echo $confirm_password; ?>">
                        <span style="color:red" class="help-block"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($surname_err)) ? 'has-error' : ''; ?>">
                        <label>Surname</label>
                        <input type="text" name="surname" class="form-control" value="<?php echo $surname; ?>">
                        <span style="color:red" class="help-block"><?php echo $surname_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($othernames_err)) ? 'has-error' : ''; ?>">
                        <label>Other Names</label>
                        <input type="text" name="othernames" class="form-control" value="<?php echo $othernames; ?>">
                        <span style="color:red" class="help-block"><?php echo $othernames_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                        <span style="color:red" class="help-block"><?php echo $email_err; ?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($dept_err)) ? 'has-error' : ''; ?>">
                        <label>Department</label>
                        <select name="dept" style="width:100%; height:40px;">
                            <option value="" selected style="color: grey;">Select department</option>
                            <?php
					require_once 'config.php';
					$query = "Select dept from department";
					$result=mysqli_query($link, $query);
					while( $row = mysqli_fetch_array($result) ){
						$f = $row["dept"];
						echo "<option>";
						echo htmlspecialchars($f);
						echo "</option>";
						}
					?>
                        </select>
                        <span style="color:red" class="help-block"><?php echo $dept_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                        <label>Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
                        <span style="color:red" class="help-block"><?php echo $phone_err; ?></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Submit
                            </button>
                        </div>
                    </div>

                    <br /> <br />
                    <p>Already have an account? <a href="index.php">Login here</a>.</p>
                </form>

            </div>
        </div>
    </div>
</body>

</html>