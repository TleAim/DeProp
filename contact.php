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
        <div class="container-fluid bg-white p-0 f12" style="max-width: 1200px; min-height: 500px;">

    <?php } ?>

    <!-- Header -->
    <div class="container-fluid">
        <?php include 'usertopbar.php'; ?>
        <?php include 'usertop.php'; ?>
    </div>

    <div class="pt-5"></div>

    <!-- Main -->
    <div class="container-fluid">
        <div id="contactbox" class="d-flex flex-row " style="min-height: 800px;">
            <div class="px-4" id="contact_us" style="max-width:500px;min-width:50%;">
                <h3 class="text-center">ส่งข้อความหาเรา</h3>    
                <form id="contactForm" method="post">
                    <div class="mb-3">
                      <label for="name" class="form-label">ชื่อ:</label>
                      <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                      <label for="phone" class="form-label">เบอร์โทร:</label>
                      <input type="tel" id="phone" name="phone" class="form-control" required>
                    </div>

                    <div class="mb-3">
                      <label for="email" class="form-label">อีเมล(ถ้ามี):</label>
                      <input type="email" id="email" name="email" class="form-control" >
                    </div>


                    <div class="mb-3">
                      <label for="subject" class="form-label">หัวข้อ:</label>
                      <input type="text" id="subject" name="subject" class="form-control" required>
                    </div>
                    <div class="mb-3">
                      <label for="message" class="form-label">ข้อความ:</label>
                      <textarea id="message" name="message" rows="5" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                      <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> ส่งข้อความ</button>
                    </div>
                </form>
            </div>
            <div class="p-3">
                <div class="bg-light rounded p-3 pt-4" >
                    <div class="f18  text-center p-3">ช่องทางติดต่อ (สำนักงานใหญ่)</div> 
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
    <div class="container-fluid p-0">
        <?php include 'footer.php'; ?>
    </div>
        
</div><!-- End Container -->
</body>
</html>

<script>
$(document).ready(function() {
  $('#contactForm').submit(function(e) {
    e.preventDefault(); // Prevent the form from submitting in the default way

    // Send the form data using AJAX
    $.ajax({
      url: 'contact_submit.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function(response) {
        // Redirect to the "contact_thankyou.php" page upon successful submission
        window.location.href = 'contact_success.php';
      },
      error: function(xhr, status, error) {
        // Handle any errors if needed
        console.log(error);
      }
    });
  });
});
</script>

<script src="./js/login.js" ></script>