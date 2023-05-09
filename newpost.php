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

        <!-- Authentication -->
        <div class="row bg-black" id="topbar">
            <div id="deschead" class="col text-white fw-bold pt-2 m-0 ps-4">
                ประกาศขายฟรี ที่ดินเปล่า บ้านเดี่ยว บ้านแฝด คอนโดมิเนียม ทาวน์เฮ้าส์ อาคารพาณิชย์ 
            </div>
            <div class="col text-warning f14 m-0 pt-2 px-2">
                <?php include 'login.php'; ?>
            </div>
        </div>

        <!-- Header -->
        <div class="row">
            <div class="col m-0 p-0">
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

