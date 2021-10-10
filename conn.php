<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "workspace";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed with database: " . $conn->connect_error);
}
?>