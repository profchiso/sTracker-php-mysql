<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'us-cdbr-east-03.cleardb.com');
define('DB_USERNAME', 'ba02a532ed0ccc');
define('DB_PASSWORD', '24adffee');
define('DB_NAME', 'heroku_875d3f0a300d0e0');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>