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
    <title>ติดต่อเรา</title>
</head>
<body class="bg-light">
    <?php if (is_mobile()) { ?>
        <div class="container bg-white p-0" >
    <?php }else{ ?>
        <div class="container bg-white p-0 f12" style="max-width: 1200px; min-height: 500px;">

    <?php } ?>

    <!-- Header -->
    <div class="container">
        <?php include 'usertopbar.php'; ?>
        <?php include 'usertop.php'; ?>
    </div>

    <div class="pt-5"></div>

<!-- Main -->
<div class="container">
        <div id="" class="d-flex flex-column " style="min-height: 80%;">
            <div class="text-center fw-bold f22">ขอบคุณสำหรับข้อความ ทางเราจะติดต่อกลับให้เร็วที่สุดค่ะ</div>
            <div class="container text-center">
                <img src="img/thank_girl.png" class="img-fluid">
            </div>
            <div class="p-3 mx-auto" style="max-width: 800px;">
                <div class="bg-light rounded p-3 pt-4" >
                    <div class="f18  text-center p-3">ช่องทางติดต่อเพิ่มเติม</div> 
                    <div class="container">

                    <!-- USER Phone -->
                    <?php if(1){?>
                        <div class="row d-flex py-2 m-0">
                        <div class="col-3 text-end f14 text-secondary p-0 m-0 ">
                            <i class="fa fa-mobile-phone" style='font-size:24px'></i> <span class="text-danger fw-bold"></span>
                        </div>
                        <div class="col-9 text-start ">
                            <span class="pe-1 text-black f14">: 063-343-5158</span>
                        </div>
                    </div>
                    <?php }?>

                    <!-- USER Email -->
                    <?php if(1){?>
                    <div class="row d-flex py-2 m-0">
                        <div class="col-3 text-end f14 text-secondary p-0 m-0 ">
                            อีเมล
                        </div>
                        <div class="col-9 text-start " id="emaildisplay">
                            <div class="text-wrap text-black f14">: deprop@gmail.com</div>
                        </div>
                    </div>
                    <?php }?>

                    <!-- USER LineID -->
                    <?php if(1){?>
                    <div class="row d-flex py-2 m-0 ">
                        <div class="col-3 text-end f14 text-white p-0 m-0">
                           <span class="bg-success rounded px-2 py-1">LINE</span>
                        </div>
                        <div class="col-9 text-start ">
                            <span class="pe-1 text-black f14">: @DEPROP</span>
                        </div>
                    </div>
                    <?php }?>

                    <!-- USER Facebook -->
                    <?php if(1){?>
                    <div class="row d-flex py-2 m-0">
                        <div class="col-3 text-end f14 text-white p-0 m-0 ">
                            <i class='fab fa-facebook-square' style='font-size:28px;color:#3975ea;'></i>
                        </div>    
                        <div class="col-9 text-start">
                            <a href="https://www.facebook.com/">
                            <span class="pe-1 textFB f14">: DEPROP</span> 
                            <span class="f12 textFB"><i class='fas fa-external-link-alt'></i></span>
                            </a>
                        </div>
                    </div>
                    <?php }?>

                    <!-- USER twitter -->
                    <?php if(1){?>
                    <div class="row d-flex py-2 m-0">
                        <div class="col-3 text-end f14 text-white p-0 m-0 ">
                            <i class="	fab fa-twitter-square" style='font-size:28px;color:#4d9feb;'></i> 
                        </div>
                        <div class="col-9 text-start ">
                            <a href="https://twitter.com/">
                            <span class="pe-1 textTW f14">: DEPROP</span> 
                            <span class="f12 textTW"><i class='fas fa-external-link-alt'></i></span>
                            </a>
                        </div>
                    </div>
                    <?php }?>
                    
                    
                    <div class="container">
                        <img src="img/cusservice.png" style="width:100%;">
                    </div>
                    

                    </div>
                </div>
            </div>
                    
        </div>
    </div>

    <!-- Footer -->
    <div class="container p-0">
        <?php include 'footer.php'; ?>
    </div>
        
</div><!-- End Container -->

</body>

</html>