<?php
include 'display.php';
include 'init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>ประกาศขายบ้านและที่ดิน อสังหาริมทรัพย์</title>
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

        <!-- Main -->
        <div class="row ">
            <div class="col m-0 p-0">
                    
            </div>
        </div>


         <!-- Footer -->
        <div class="row ">
            <div class="col m-0 p-0">
                <?php include 'footer.php'; ?>
            </div>
        </div>
        
    </div><!-- End Container -->
</body>
</html>