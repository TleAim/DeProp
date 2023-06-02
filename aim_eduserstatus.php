<?php
include 'connect.php';
include 'lib/myvar.php';
session_start();
//echo "SS UID:".$_SESSION['uid'];
if (!isset($_SESSION['uid']) || $_SESSION['uid'] === null || $_SESSION['uid'] != $admin) {
    echo "Nope";
    exit();
}

//printPostValues();
$uid = $_POST['id'];
$sql = "UPDATE `userprofile` 
SET status = CASE WHEN status = 'active' THEN 'inactive' 
WHEN status = 'inactive' THEN 'active' ELSE status END 
WHERE uid = '$uid'";
//echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "User Status Updated Successfully";
} else {
    echo "Error: " . $conn->error;
}
?>