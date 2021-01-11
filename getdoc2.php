<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
// Initialize the session
session_start();
$q =$_GET['ref_no'];
 
// Include config file
require_once "config.php";
$recipient= $sender = $date_sent= $recipient = "";

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

mysqli_close($link);
?>
</body>
</html>

