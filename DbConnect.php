<?php

date_default_timezone_set("Asia/Jakarta");
$servername = "localhost";
$username = "titq2258_riki";
$password = "riki121212";
$dbname = "titq2258_titipanku";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>
