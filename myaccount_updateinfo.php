<?php
include 'connect.php';
include 'display.php';
session_start();

printPostValues();

$sql = "INSERT INTO `userprofile` (`user`, `name`, `phone`, `email`, `lineid`, `fb`, `tw`)
VALUES (
    '".$_POST['uid']."',
    '".$_POST['name']."',
    '".$_POST['phone']."',
    '".$_POST['email']."',
    '".$_POST['lineid']."',
    '".$_POST['fb']."',
    '".$_POST['tw']."'
)ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `phone` = VALUES(`phone`), `email` = VALUES(`email`), `lineid` = VALUES(`lineid`), `fb` = VALUES(`fb`), `tw` = VALUES(`tw`)";
echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "<p>New record or updated successfully</p>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
