<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nick_work_flow";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed with database: " . $conn->connect_error);
}
?>