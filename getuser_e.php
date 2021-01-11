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
$q =$_GET['q'];
 
// Include config file
require_once "config.php";

$sql="Select ref_no, docname, owner, attachment from edoc where ref_no = '".$q."'";
$result = mysqli_query($link,$sql);

echo "<table>
<tr>
<th>Doc Title</th>
<th>Attached FileName</th>

</tr>";
while($row = mysqli_fetch_array($result)) {
	$_SESSION['docname'] = $row['docname'];
	$_SESSION['file'] = $row['attachment'];
	$_SESSION['owner'] = $row['owner'];
    echo "<tr>";
    echo "<td>" . $row['docname'] . "</td>";
    echo "<td>" . $row['attachment'] . "</td>";
    echo "</tr>";
}
echo "</table>";


mysqli_close($link);
?>
</body>
</html>

