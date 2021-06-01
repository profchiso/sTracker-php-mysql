<?php
//Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$ref_no = "";
$ref_no_err = "";
 
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
	
    // Check input errors before updating the database
    if(empty($ref_no_err)){
	$recipient= $sender = $date_sent= $recipient = "";
	$q =$_POST['ref_no'];
$sql="Select *  from movement where ref_no = '".$q."'";
$result = mysqli_query($link,$sql);
if (mysqli_num_rows($result) != 0)
{
 echo "<br />";
 echo "<br />";
echo "<table>
<tr>
<th>Date Sent</th>
<th>Sender</th>
<th>Recipient</th>
<th>location</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
	   $_SESSION['date_sent'] = $row['date_sent'];
    $_SESSION['sender'] = $row['sender'];
    $_SESSION['recipient'] = $row['recipient'];
    $_SESSION['location'] = $row['location'];
    
    echo "<tr>";
    echo "<td>" . $row['date_sent'] . "</td>";
    echo "<td>" . $row['sender'] . "</td>";
    echo "<td>" . $row['recipient'] . "</td>";
    echo "<td>" . $row['location'] . "</td>";
    echo "</tr>";

}
echo "</table>";
} else {
 echo "Document NOT found in the movemenet register, Please contact the owner";
}     
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Guest Track Document</title>
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
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    td,
    th {
        border: 2px solid black;
        padding: 5px;
    }

    th {
        text-align: left;
    }
    </style>



</head>

<body>
    <div class="page-header" align="center">
        <br />
        <h1>Welcome Guest </h1>
        <p> <a href="index.php" class="btn btn-warning">Go Back</a>

        </p> <br />
    </div>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <span class="login100-form-title p-b-26">
                    Track Paper Document</span>


                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($ref_no_err)) ? 'has-error' : ''; ?>">
                        <label>Document Reference Number</label>
                        <input type="text" name="ref_no" class="form-control" value="<?php echo $ref_no; ?>">
                        <span class="help-block"><?php echo $ref_no_err; ?></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Search
                            </button>
                        </div>
                    </div>

                    <br>
                    <div id="txtHint"><b>Document will be listed above...</b></div>

                </form>
            </div>
        </div>
    </div>


</body>

</html>