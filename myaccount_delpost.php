
<?php
include 'init.php';
include 'connect.php';
include './lib/lib_file.php';
include './lib/myvar.php';
session_start();

$sql = "SELECT count(*) as chk FROM `proppost` WHERE `post_id` = '".$_POST['post_id']."' AND `uid` = '".$_SESSION["uid"]."'";
$sqldel = "DELETE FROM proppost WHERE `post_id` = '".$_POST['post_id']."' AND `uid` = '".$_SESSION["uid"]."'";

$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
echo "\nCHK:".$row['chk'];


if (isset($_SESSION["uid"])) {
    if($row['chk'] == 1){
        deleteFilesWithPrefix($imgPath,$_POST['post_id']);
        mysqli_query($conn, $sqldel);
    }
    
} 


?>
