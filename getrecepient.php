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

$sql="Select staff_no, dept from users where staff_no = '".$q."'";
$result = mysqli_query($link,$sql);

echo "<table>
<tr>
<th>Departmet</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
	$_SESSION['location'] = $row['dept'];
    echo "<tr>";
    echo "<td>" . $row['dept'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($link);
?>
</body>
</html>

