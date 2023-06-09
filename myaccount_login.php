<?php
include 'display.php';
include 'init.php';
include 'connect.php';
include 'lib/myvar.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <link rel="icon" href="icon.png" type="image/png" sizes="20x20">
    <meta name="robots" content="noindex">
</head>
<body class="bg-light">
    <?php if (is_mobile()) { ?>
        <div class="container-fluid bg-white p-0" >
    <?php }else{ ?>
        <div class="container-fluid bg-white p-0 f12" style="max-width: 1200px; min-height: 500px;">

    <?php } ?>

        <!-- Header -->
        <div class="container-fluid">
            <?php include 'usertop.php'; ?>
        </div>

        <!-- Main -->
        <div class="container-fluid bg-light" style="min-height: 400px;">
            <div class="p-3"></div>
            <div id="account_login">
              <?php include 'loginbox.php'; ?>
            </div>
        </div>

         <!-- Footer -->
         <div class="container-fluid p-0">
            <?php include 'footer.php'; ?>
        </div>
        
    </div><!-- End Container -->

</body>

</html>