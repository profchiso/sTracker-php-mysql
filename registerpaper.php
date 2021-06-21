<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$ref_no = $owner = $docname = $department = $remark = "";
$ref_no_err = $owner_err = $docname_err = $department_err = $remark_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate File Reference Number
    if(empty(trim($_POST["ref_no"]))){
        $ref_no_err = "Please File Reference Number cannot be empty.";     
    } elseif(strlen(trim($_POST["ref_no"])) < 3){
        $ref_no_err = "Please enter a valid File Reference Number.";
    } else{
        $ref_no = trim($_POST["ref_no"]);
    }
    
       	    // Validate Document Name
    if(empty(trim($_POST["docname"]))){
        $docname_err = "Please enter Document's name.";     
    } else{
        $docname = trim($_POST["docname"]);
    }
		    // Validate department
    if(empty(trim($_POST["department"]))){
        $department_err = "Please enter department's names.";     
    } else{
        $department = trim($_POST["department"]);
    }
		    // Validate Remark
    if(empty(trim($_POST["remark"]))){
        $remark_err = "Please enter Remark.";     
    } else{
        $remark = trim($_POST["remark"]);
    }
				    // Validate Owner
    if(empty(trim($_POST["owner"]))){
        $owner_err = "Please Select owner of document.";     
    } else{
        $owner = trim($_POST["owner"]);
    }
        
    // Check input errors before updating the database
    if(empty($ref_no_err) && empty($docname_err) && empty($department_err) && empty($owner_err) && empty($remark_err)){
		
          // Prepare an insert statement
        $sql = "INSERT INTO paper (ref_no, docname, remark, department, 	current_handler, owner) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_ref_no, $param_docname, $param_remark, $param_department, $param_owner, $param_current);
            
            // Set parameters
            $param_ref_no = $ref_no;
            $param_docname = $docname;
			$param_remark =  $remark;
			$param_department = $department;
			$param_owner = $_SESSION["staff_no"];
			$param_current = $_SESSION["staff_no"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
				
				$message = " Your Document was Successfully Created!";	
				echo"<font color='red'><script type='text/javascript'> alert('$message');</script> </font>";
                // Redirect to paper page
				echo "<script type='text/javascript'>location.href = 'paper.php'</script>";
                //header("location: paper.php");
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
    <meta charset="UTF-8">
    <title>Register paper Document</title>
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

</head>
<body>
	<div class="page-header" align="center">
	<br />
        <h1>Welcome <b><?php echo htmlspecialchars ($_SESSION["staff_no"]); ?></b>. </h1>
		<p> <a href="paper.php" class="btn btn-warning">Go Back</a> 
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
		</p> <br />
    </div>
	
	<div class="limiter">
		<div class="container-login100">
		<div class="wrap-login100">
				<span class="login100-form-title p-b-26">
						Register Paper Document</span>


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
		
		    <div class="form-group <?php echo (!empty($ref_no_err)) ? 'has-error' : ''; ?>">
                <label>Document Reference Number</label>
                <input type="text" name="ref_no" class="form-control" value="<?php echo $ref_no; ?>">
                <span style="color:red" class="help-block"><?php echo $ref_no_err; ?></span>
            </div>
			<div class="form-group <?php echo (!empty($docname_err)) ? 'has-error' : ''; ?>">
                <label>Document Title</label>
                <input type="text" name="docname" class="form-control" value="<?php echo $docname; ?>">
                <span style="color:red" class="help-block"><?php echo $docname_err; ?></span>
            </div>
      <div class="form-group <?php echo (!empty($owner_err)) ? 'has-error' : ''; ?>">
                <label>Owner's Name</label>
				<select name="owner"  style="width:100%; height:40px;">
					<option value="" selected style="color: grey;">Select Document Owner</option>
					<?php
					require 'config.php';
					$query = "Select staff_no, surname, othernames from users";
					$result = mysqli_query($link, $query);
					while( $row = mysqli_fetch_array($result) ){
						$f = $row["staff_no"]." (".$row["surname"]. ", ".$row["othernames"].")";
						echo "<option>";
						echo htmlspecialchars($f);
						echo "</option>";
						}
					?>				
			</select>
				
                <span style="color:red" class="help-block"><?php echo $owner_err; ?></span>
            </div>
	         
				<div class="form-group <?php echo (!empty($department_err)) ? 'has-error' : ''; ?>">
                <label>Department</label>
				<select name="department"  style="width:100%; height:40px;">
					<option value="" selected style="color: grey;">Select your Department</option>
					<?php
					require 'config.php';
					$query = "Select dept from department";
					$result = mysqli_query($link, $query);
					while( $row2 = mysqli_fetch_array($result) ){
						$f = $row2["dept"];
						echo "<option>";
						echo htmlspecialchars($f);
						echo "</option>";
						}
					?>				
			</select>
				
                <span style="color:red" class="help-block"><?php echo $department_err; ?></span>
            </div>			
			
			<div class="form-group <?php echo (!empty($remark_err)) ? 'has-error' : ''; ?>">
                <label>Remarks</label> <br />
				<textarea style="border-style:double" name="remark" placeholder="Enter remarks. Cannot be empty." rows="5" cols="33%"></textarea>
                <span style="color:red" class="help-block"><?php echo $remark_err; ?></span>
            </div>
			
			<div class="container-login100-form-btn">
				<div class="wrap-login100-form-btn">
					<div class="login100-form-bgbtn"></div>
					<button class="login100-form-btn"> 
						Submit
					</button>
				</div>
			</div>
        </form>
		</div>  
		</div> 
	</div> 	
</body>
</html>