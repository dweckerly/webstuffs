<?php
global $conn;

$servername = "us-imm-web131.main-hosting.eu";
$username = "u505133682_user";
$password = "umzzJB8W1mXg";
$dbname = "u505133682_mcnee";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>