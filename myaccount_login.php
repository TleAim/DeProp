<?php
include 'display.php';
include 'init.php';
include 'connect.php';
session_start();
echo ("SESSION :".$_SESSION['uid']);
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
                
            </div>
        </div>

        <!-- Main -->

        <div class="container">
            <div class="row ">
              <div class="col">
                <main>

                    <div id="account_login">
                      <?php include 'loginbox.php'; ?>
                    </div>

                </main>
              </div>
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