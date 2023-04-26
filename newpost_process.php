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
    <?php include 'modal.php'; ?>
    <?php if (is_mobile()) { ?>
        <div class="container bg-white" >
    <?php }else{ ?>
        <div class="container bg-white" style="width: 1200px;">
    <?php } ?>


        <!-- Header -->
        <div class="row">
            <div class="col m-0 p-0">
                <?php include 'usertop.php'; ?>
            </div>
        </div>

        <!-- Authentication -->
        <div class="row ">
            <div class="col m-0 p-0">
                <?php include 'login.php'; ?>
                <script src="login.js" ></script>
            </div>
        </div>

        <!-- Form Area -->
        <div class="row">
            <div class="col mb-4 pb-4">
            <?php
            $postid = uniqid();
            echo "POST ID = ".$postid;
            echo "<br>UID = ".$_SESSION['uid'];
            printPostValues();
            ?>   
                <div class="p-5 m-3"></div>
            </div>

        </div>
    </div>
    <?php include 'modal.php'; ?>
</body>

</html>

