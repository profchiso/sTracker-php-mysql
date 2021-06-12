<?php
// Initialize the session
session_start();
error_reporting(0);
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Unattended Document</title>
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
<style>
table, tr {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 2px solid black;
    padding: 2px;
}

th {text-align: left;}
</style>
</head>
<body>
	<div class="page-header" align="center">
	<br />
        <h1>Welcome <b><?php echo htmlspecialchars ($_SESSION["staff_no"]); ?></b>. </h1>
		<p> <a href="welcome.php" class="btn btn-warning">Go Back</a> 
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
		</p> <br />
    </div>
	
	<div class="limiter">
		<div class="container-login100">
		<div class="wrap-login100">
				<span class="login100-form-title p-b-26">
						Unattended Document</span>

		<div>
        <b><label>Paper Documents</label></b>
		<?php

		$q = $_SESSION["staff_no"];
		$owner = $docname = "";
		$hash_value = "";

		$sql="Select ref_no, docname, owner from paper where current_handler = '".$q."'";
		$result = mysqli_query($link,$sql);

echo "<table>
<tr>
<th>Ref No.</th>
<th>Doc Name</th>
<th>Owner</th>

</tr>";
while($row = mysqli_fetch_array($result)) {
	$_SESSION['ref_no'] = $row['ref_no'];
	$_SESSION['docname'] = $row['docname'];
	$_SESSION['owner'] = $row['owner'];
    echo "<tr>";
	echo "<td>" . $row['ref_no'] . "</td>";
    echo "<td>" . $row['docname'] . "</td>";
    echo "<td>" . $row['owner'] . "</td>";
    echo "</tr>";
}
echo "</table>";

	echo "<br />";
	
    echo "<b><label>Electronics Documents</label></b>";


		$q = $_SESSION["staff_no"];
	
		$sql2="Select ref_no, docname, owner, attachment, hash_value from edoc where current_handler = '".$q."'";
		$result2 = mysqli_query($link,$sql2);
echo "<table class= scrollableTable>
<tr>
<th>Ref No.</th>
<th>Attached File</th>
<th>File Status</th>
<th>Doc Title</th>
<th>Owner</th>

</tr>";
while($row = mysqli_fetch_array($result2)) {
    echo "<tr>";
	echo "<td>" . $row['ref_no'] . "</td>";
	echo "<td> <a href=". $row['attachment'] . ">" . $row['attachment'] ."</a> </td>";
		$targetfileName = $row['attachment'];
				
		
		if(sha1_file($targetfileName) == $row['hash_value']){	
			  echo "<td>File: Verified okay.</td>";
			  }
			else
			  {
			  echo "<td>File: Corrupted.</td>";}
			  
	echo "<td>" . $row['docname'] . "</td>";
    echo "<td>" . $row['owner'] . "</td>";		  
    echo "</tr>";
}
echo "</table>";


mysqli_close($link);
?>		
				
		<br>	
		</div>  
		</div> 
	</div> 	
	

</body>
</html>