<?php
include 'display.php';
include 'init.php';
include 'connect.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มประกาศขายบ้านและที่ดิน อสังหาริมทรัพย์</title>
</head>
<body class="bg-light">
    <?php if (is_mobile()) { ?>
        <div class="container bg-white p-0" >
    <?php }else{ ?>
        <div class="container-fluid bg-white p-0 f12" style="max-width: 1200px; min-height: 500px;">

    <?php } ?>

        <!-- Header -->
        <div class="container-fluid">
            
            <?php include 'usertop.php'; ?>
        </div>

        <!-- Main -->
        <div class="container-fluid" style="min-height: 900px;">
            <div id="account_login">
              <?php include 'loginbox.php'; ?>
            </div>
        </div>

         <!-- Footer -->
         <div class="container-fluid">
            <?php include 'footer.php'; ?>
        </div>
        
    </div><!-- End Container -->

</body>

</html>