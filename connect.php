
<?php
$servername = "localhost";
$username = "benmjcxk_yoojin";
$password = "g[PPkwmpmv'";
$dbname = "benmjcxk_taradteedin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
echo $conn->connect_error;
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  echo "Conn : Connection failed";
}
mysqli_set_charset($conn, "utf8mb4");
?>
