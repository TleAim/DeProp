<?php
$servername = "localhost";
$username = "benmjcxk_yoojin";
$password = "g[PPkwmpmv'";
$dbname = "benmjcxk_thailand";

// Create connection
$conn2 = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn2->connect_error) {
  die("Connection failed: " . $conn2->connect_error);
}

mysqli_set_charset($conn2, "utf8");
?>
