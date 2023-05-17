<?php
include 'display.php';
include 'init.php';
session_start();
consolelog("UID = ".$_SESSION['uid']);
consolelog("NAME = ".$_SESSION['name']);
consolelog("EMAIL = ".$_SESSION['email']);
consolelog("Phone = ".$_SESSION['phone']);
consolelog("SESSION :".$_SESSION['uid']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประกาศขายบ้านและที่ดิน อสังหาริมทรัพย์</title>
</head>
<body class="bg-light">
    <?php if (is_mobile()) { ?>
        <div class="container bg-warning px-0" >
    <?php }else{ ?>
        <div class="container bg-warning px-0" style="width: 1200px;">

    <?php } ?>

    <div class="container-fluid bgTop1 p-0">
        <!-- Top Bar -->
        <?php include 'usertopbar.php'; ?>
    

        <!-- Header -->
        <div class="container">
            <?php include 'usertop.php'; ?>
        </div>
    </div>

        <!-- Main -->
        <div class="container p-0 pb-5 bg-white">
            <?php include 'postlist.php'; ?>    
        </div>


         <!-- Footer -->
         <div class="container">
            <?php include 'footer.php'; ?>
        </div>

        
        
    </div><!-- End Container -->
    <div class="p-4 m-3"></div>
    <script src="./js/login.js" ></script>

</body>

</html>


