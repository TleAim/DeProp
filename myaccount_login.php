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
        <div class="container bg-white px-0" >
    <?php }else{ ?>
        <div class="container bg-white px-0" style="width: 1200px;">

    <?php } ?>

      <div class="container-fluid bgTop1 p-0">
        <!-- Top Bar -->
        <?php include 'usertopbar.php'; ?>

        <!-- Header -->
        <div class="row">
            <div class="col m-0 p-0">
                <?php include 'usertop.php'; ?>
            </div>
        </div>
      </div>

        <!-- Main -->
        <div class="container-fluid">
            <div id="account_login">
              <?php include 'loginbox.php'; ?>
            </div>
        </div>

        <!-- Footer -->
        <div class="row mt-5 ">
            <div class="col m-0 p-0">
                <?php include 'footer.php'; ?>
            </div>
        </div>
    </div>

</body>

</html>