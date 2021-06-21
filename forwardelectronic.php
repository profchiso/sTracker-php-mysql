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
$ref_no = $owner = $docname = $location = $recipient = $remark = "";
$ref_no_err = $owner_err = $docname_err = $location_err = $recipient_err = $remark_err = "";
 
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
		    // Validate Remark
    if(empty(trim($_POST["remark"]))){
        $remark_err = "Please enter Remark.";     
    } else{
        $remark = trim($_POST["remark"]);
    }
		// Validate recipient
    if(empty(trim($_POST["recipient"]))){
        $recipient_err = "Please enter recipient.";     
    } else{
        $recipient = trim($_POST["recipient"]);
    }

	
    // Check input errors before updating the database
    if(empty($ref_no_err) && empty($docname_err) && empty($department_err) && empty($remark_err)){
		
          // Prepare an insert statement
        $sql = "INSERT INTO emovement (ref_no, owner,sender, recipient, location, doctype, file, status, remark) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
 
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_ref_no, $param_owner,$param_sender,$param_recipient, $param_location,$param_doctype, $param_file,  $param_status, $param_remark); 
		
            // Set parameters
            $param_ref_no = $ref_no;
			$param_owner = $_SESSION['owner'];
			$param_sender = $_SESSION["staff_no"];
			$param_recipient = $recipient;
			$param_location = $_SESSION["location"];
			$param_doctype = "electronic";
            $param_file = $_SESSION['file'];		
			$param_remark =  $remark;
			$param_status = "Not Recieved";
       
	   
            	// Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

			// Start of SMS script
				require_once('sms.php');
			//End of SMS script	

			
	/*		// send email to the recipient
			require_once('/connect.php');
			$query3 = "Select email from users where staff_no='{$_SESSION['sn']}' ";
			$result2=mysql_query($query3);
			while($row = mysql_fetch_array($result2) ){
			$to = $row['email'];}
			$subject = 'SmartTracker eAlert';
			$message = 'A File have been sent to you from SmartTracker. Login and attend to it. Please do not reply this email, it is an auto-generated email.';
			$headers = 'From: admin@smarttracker.com';
			mail($to, $subject, $message, $headers); 

			echo $_SESSION['sn'];
	    
			//End of Email script
			*/
		
		exit(); 
		
			$message = " Your Document was Successfully forwarded!";	
				echo"<font color='red'><script type='text/javascript'> alert('$message');</script> </font>";
                // Redirect to paper page
				echo "<script type='text/javascript'>location.href = 'paper.php'</script>";
				//exit("message sent"); 
            } else{
                echo "Something went wrong. Please try again later." . mysqli_error($link);
            }
				
				
			$sql2 = "UPDATE edoc SET current_handler = '$param_recipient' WHERE ref_no = '$param_ref_no'";
			if (mysqli_query($link, $sql2)) {
			echo "";
			} else {
				echo "Error updating record: " . mysqli_error($link);
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
    <title>Forward Electronic Document</title>
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
<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getuser_e.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>

<script>
function showR(str) {
    if (str == "") {
        document.getElementById("recipient").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("recipient").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getrecepient_e.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>


</head>
<body>
	<div class="page-header" align="center">
	<br />
        <h1>Welcome <b><?php echo htmlspecialchars ($_SESSION["staff_no"]); ?></b>. </h1>
		<p> <a href="electronic.php" class="btn btn-warning">Go Back</a> 
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
		</p> <br />
    </div>
	
	<div class="limiter">
		<div class="container-login100">
		<div class="wrap-login100">
				<span  class="login100-form-title p-b-26">
						Forward Electronic Document</span>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
		
				<div class="form-group <?php echo (!empty($ref_no_err)) ? 'has-error' : ''; ?>">
                <label>Document Reference Number</label>
				
				<select name="ref_no" style="width:100%; height:40px;" onchange="showUser(this.value)">
				<option value="" selected style="color: grey;">Select Document Ref No.</option>
					<?php
					require_once 'config.php';
					$param_where = $_SESSION["staff_no"];
					$query = "Select ref_no, docname, owner from edoc where current_handler= '".$param_where."'";
					$result=mysqli_query($link, $query);
					while( $row = mysqli_fetch_array($result) ){
						$f = $row["ref_no"];
						echo "<option value='".$row['ref_no']."'>";
						echo htmlspecialchars($f);
						echo "</option>";
						}
					?>				
			</select>
			<span style="color:red" class="help-block"><?php echo $ref_no_err; ?></span>
			<br>
			<div id="txtHint"><b>Document info will be listed here...</b></div>
            </div>

			<div class="form-group <?php echo (!empty($recipient_err)) ? 'has-error' : ''; ?>">
            <label>Recipient</label>
			<select name="recipient"  style="width:100%; height:40px;" onchange="showR(this.value)">
				<option value="" selected style="color: grey;">Select Recipient</option>
				<?php
				require_once 'config.php';
				$query = "Select staff_no, surname, othernames from users";
				$result=mysqli_query($link, $query);
				while( $row = mysqli_fetch_array($result) ){
					$f = $row["staff_no"]." (".$row["surname"]. ", ".$row["othernames"].")";
					echo "<option value='".$row['staff_no']."'>";
					echo htmlspecialchars($f);
					echo "</option>";
						}
					?>				
			</select>
			<span style="color:red" class="help-block"><?php echo $recipient_err; ?></span>
			<div id="recipient"><b>Recipient info will be listed here...</b></div>
            </div>
	
			<div class="form-group <?php echo (!empty($remark_err)) ? 'has-error' : ''; ?>">
                <label>Remarks</label>
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