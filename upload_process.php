
<?php
include './lib/lib_file.php';
session_start();

$uploadDir = './upload/tmp/';
$prefix = $_SESSION['uid'];
deleteFilesWithPrefix($uploadDir, $prefix); //Clear old one images file for this user uid
saveFile($uploadDir,$_FILES,$_SESSION['uid']);
?>