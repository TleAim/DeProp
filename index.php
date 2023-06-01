<?php
include 'display.php';
include 'init.php';
include 'lib/myvar.php';
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
    <link rel="icon" href="icon.png" type="image/png" sizes="20x20">
    <!-- META FOR SEO --> 
    <meta name="description" content="ตลาดซื้อ-ขาย อสังหาริมทรัพย์ บ้านเดี่ยว ที่ดิน อาคารพาณิชน์ ทาวเฮ้าส์ รีสอร์ท วิลล่า ประกาศฟรีไม่มีค่าใช้จ่าย">
    <meta name="keywords" content="ประกาศฟรี,ซื้อขายที่ดิน,ซื้อขายบ้าน,บ้านมือสอง,บ้านเช่า,อาคารพาณิชน์,ขายฝากที่ดิน,จำนองที่ดิน,ขายฝากบ้าน,จำนองบ้าน">
    <meta name="robots" content="index,follow">
</head>
<body class="bg-light">
    <?php if (is_mobile()) { ?>
        <div class="container-fluid bg-white p-0" >
    <?php }else{ ?>
        <div class="container-fluid bg-white p-0 f12" style="max-width: 1200px;">

    <?php } ?>

        <!-- Header -->
        <div class="container-fluid">
            <div id="FilterTopSpace"></div>
            <?php include 'usertopbar.php'; ?>
            <?php include 'usertop.php'; ?>
        </div>

        <!-- Main -->
        <div class="container-fluid p-0 pb-5 bg-white">
            <?php include 'postlist.php'; ?>    
        </div>


         <!-- Footer -->
         <div class="container-fluid p-0">
            <?php include 'footer.php'; ?>
        </div>

        
        
    </div><!-- End Container -->
    
    <script src="./js/login.js" ></script>

</body>

</html>


