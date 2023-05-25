<?php
include 'display.php';
include 'init.php';
include 'lib/myvar.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มประกาศขายบ้านและที่ดิน อสังหาริมทรัพย์</title>
    <link rel="icon" href="icon.png" type="image/png" sizes="20x20">
    <meta name="robots" content="noindex">
</head>
<body class="bg-light">
    <?php if (is_mobile()) { ?>
        <div class="container bg-white p-0" >
    <?php }else{ ?>
        <div class="container-fluid bg-white p-0 f12" style="max-width: 1200px;">

    <?php } ?>

        <!-- Header -->
        <div class="container-fluid">
            <div id="FilterTopSpace"></div>
            <?php include 'usertopbar.php'; ?>
            <?php include 'usertop.php'; ?>
        </div>

        <!-- Form Area -->
        <div class="row">
            <div class="col mb-4">
                    <?php include 'newpostform.php'; ?>    
            </div>
        </div>
    </div>
    <script src="./js/login.js" ></script>
<?php 
//echo "PHP OUT : UID stored successfully: " . $_SESSION['uid'];
?>
</body>

</html>

