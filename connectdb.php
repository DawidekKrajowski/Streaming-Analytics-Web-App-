<?php
$dbhost = "localhost";
$dbuser = "root";   
$dbpass = "cs3319";     
$dbname = "A3Kraj";  
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
