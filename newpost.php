<?php
include 'display.php';
include 'init.php';
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

        <!-- Form Area -->
        <div class="row">
            <div class="col mb-4 pb-4">
                    <?php include 'newimage.php'; ?>    
                <div class="p-5 m-3"></div>
            </div>

        </div>
    </div>
    <script src="./js/login.js" ></script>
</body>

</html>

