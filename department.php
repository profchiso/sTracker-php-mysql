<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$department = "";
$department_err  = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate department
    if(empty(trim($_POST["department"]))){
        $department_err = "Please enter a valid dapartment";
    } else{
        // Prepare a select statement
        $sql = "SELECT dept FROM department WHERE dept = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_department);
            
            // Set parameters
            $param_department = trim($_POST["department"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $department_err = "This department is already existing in the database";
                } else{
                    $department = $param_department;
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    
	
    // Check input errors before inserting in database
    if(empty($department_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO department (dept) VALUES (?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s",  $param_dept);
            
            // Set parameters
            $param_dept = $department; 
			            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
				
				$message = $param_dept.", was Successful registered!";	
				echo"<font color='red'><script type='text/javascript'> alert('$message');</script> </font>";
                // Redirect to index page
				echo "<script type='text/javascript'>location.href = 'admindashboard.php'</script>";
                
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
    <title>Add Department</title>
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
        <h1>Add Department </h1>
        <p> <a href="admindashboard.php" class="btn btn-warning">Go Back</a>
            <a href="adminlogout.php" class="btn btn-danger">Sign Out of Your Account</a>
        </p> <br />
    </div>


    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <span class="login100-form-title p-b-26">
                    Add New Department</span>
                <span class="login100-form-title p-b-48">
                    <i class="zmdi zmdi-globe-lock"> </i>
                </span>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($department_err)) ? 'has-error' : ''; ?>">
                        <label>Department </label>
                        <input type="text" name="department" class="form-control" value="<?php echo $department; ?>">
                        <span class="help-block"><?php echo $department_err; ?></span>
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

                </form>

            </div>
        </div>
    </div>
</body>

</html>