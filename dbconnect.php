<?php
$servername = "localhost";
$username = "root";
$password = "root9080";
$db= "dbtest";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?> 


