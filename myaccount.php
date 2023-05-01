<?php
include 'display.php';
include 'init.php';
include 'connect.php';
session_start();
consolelog("UID = ".$_SESSION['uid']);
if (!isset($_SESSION['uid']) || $_SESSION['uid'] === null) {
  header('Location: myaccount_login.php');
  exit();
}
$page = $_GET['p'] ?? "manage";

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
        <div class="row">
            <div class="col mb-4 pb-4">
                <div class="container  p-0 m-0">
                    <div class="row ">
                      <div class="col-sm-3">
                        <aside>
                          <div class="mb-3  " >
                            <div class ="mb-1 text-left" >
                              <div class="text-black fw-bold p-3 bgWhiteOP2 scale-button" id="link_account_managepost">
                                <a href="#" class=" no-underline ps-2"><i class="fas fa-bullhorn"></i> จัดการประกาศของคุณ</a>
                              </div>

                              <div class="text-black fw-bold p-3 bgWhiteOP2 scale-button" id="link_account_info">
                                <a href="#" class=" no-underline ps-2"><i class="fas fa-link"></i> การเชื่อมต่อบัญชี</a>
                              </div>
                              
                              <div class="text-black fw-bold p-3 bgWhiteOP2 scale-button" id="link_account_addpost">
                                <a href="#" class="no-underline ps-2"><i class="fas fa-plus"></i> เพิ่มประกาศ</a>
                              </div>

                            </div>
                              
                          </div>
                        </aside>  
                      </div>
                      <div class="col-sm-9 ">
                        <main>
                          <div id="account_area">
                            <div id="account_info">
                              <?php include 'myaccount_info.php'; ?>  
                            </div>

                            <div id="account_login">
                              <?php include 'loginbox.php'; ?>
                            </div>

                            <div id="account_managepost">
                              <?php include 'myaccount_post.php'; ?>    
                            </div>

                            <div id="account_addpost">
                              <?php include 'newimage.php'; ?>    
                              <?php //include 'newpostform.php'; ?>  
                            </div>

                          </div>
                        </main>
                      </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
 
</body>

</html>

<script src="./js/login.js" ></script>
<script>
  function showDiv(divId) {
    document.getElementById('account_info').style.display = 'none';
    document.getElementById('account_login').style.display = 'none';
    document.getElementById('account_addpost').style.display = 'none';
    document.getElementById('account_managepost').style.display = 'none';
      
    document.getElementById(divId).style.display = 'block';
  }

document.getElementById('link_account_info').addEventListener('click', function(event) {
  event.preventDefault();
  showDiv('account_info');
});


document.getElementById('link_account_addpost').addEventListener('click', function(event) {
  event.preventDefault();
  showDiv('account_addpost');
});

document.getElementById('link_account_managepost').addEventListener('click', function(event) {
  event.preventDefault();
  showDiv('account_managepost');
});

document.getElementById('account_info').style.display = 'none';
document.getElementById('account_login').style.display = 'none';
document.getElementById('account_addpost').style.display = 'none';
document.getElementById('account_managepost').style.display = 'none';

switch ("<?=$page?>") {
  case "add":
    showDiv('account_addpost');
    break;
  case "info":
    showDiv('account_info');
    break;
  case "manage":
    showDiv('account_managepost');
    break;
}
</script>