<?php
$servername = "localhost";
$usernamedb = "root";
$passworddb = "";
$dbname = "db_surat";

// Create connection
$conn = new mysqli($servername, $usernamedb, $passworddb, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 
?>
