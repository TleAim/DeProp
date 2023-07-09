
<?php
include 'init.php';
include 'connect.php';
include './lib/lib_file.php';
include './lib/myvar.php';
session_start();

$sql = "SELECT count(*) as chk FROM `proppost` WHERE `post_id` = '".$_POST['post_id']."' AND `uid` = '".$_SESSION["uid"]."'";
$sqlrepost = "UPDATE `proppost` SET `post_date` = NOW() WHERE `proppost`.`post_id` = '".$_POST['post_id']."' AND `proppost`.`uid` = '".$_SESSION["uid"]."'";

$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
echo "\nCHK:".$row['chk'];


if (isset($_SESSION["uid"])) {
    if($row['chk'] == 1){
        mysqli_query($conn, $sqlrepost);
    }
    
} 


?>
