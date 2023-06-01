
<?php
include './lib/lib_file.php';
session_start();

$uploadDir = './upload/tmp/';
$prefix = $_SESSION['uid'];
//echo "<br>PREFIX = ".$prefix;
//printUploadedFilesInfo($_FILES);
deleteFilesWithPrefix($uploadDir, $prefix); //Clear old one images file for this user uid
saveFile($uploadDir,$_FILES,$_SESSION['uid']);

header("Location: newpost2.php");
exit;
?>