<?php
include 'display.php';
include 'init.php';
include 'connect.php';

session_start();
consolelog("UID = ".$_SESSION['uid']);
consolelog("NAME = ".$_SESSION['name']);
consolelog("EMAIL = ".$_SESSION['email']);
consolelog("Phone = ".$_SESSION['phone']);
//echo ("SESSION :".$_SESSION['uid']);
if (!isset($_SESSION['uid']) || $_SESSION['uid'] === null) {
  header('Location: myaccount_login.php');
  exit();
}
$page = $_GET['p'] ?? "manage";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการบัญชี</title>
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

        <!-- Main -->
      <div class="container-fluid bg-white">
        <div class="row">
            <div class="col mb-4 pb-4">
                <div class="container-fluid  p-0 m-0">
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

                              <div class="text-black fw-bold p-3 bgWhiteOP2 scale-button" id="link_account_sigout" data-bs-toggle="modal" data-bs-target="#modalcflogout" >
                                <a href="#" class="no-underline ps-2"> ออกจากระบบ <i class="fas fa-sign-out-alt"></i></a>
                              </div>

                            </div>
                              
                          </div>
                        </aside>  
                      </div>
                      <div class="col-sm-9 mx-0">
                        <main>

                          <div id="account_area">
                            <div id="account_info" style="display: none;">
                              <?php include 'myaccount_info.php'; ?>  
                            </div>

                            <div id="account_managepost" style="display: none;">
                              <?php include 'myaccount_post.php'; ?>    
                            </div>

                            <div id="account_addpost" style="display: none;">
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

  </div>
 
</body>

</html>

<script src="./js/login.js" ></script>
<script>
  function showDiv(divId) {
    document.getElementById('account_info').style.display = 'none';
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
  console.log("NAME : "+name.value);
  console.log("PHONE : "+phone.value);
  if(name.value.length == 0 || phone.value.length < 10){ 
      showDiv('account_info'); 
  }else{
      showDiv('account_addpost');
  }
});

document.getElementById('link_account_managepost').addEventListener('click', function(event) {
  event.preventDefault();
  if(name.value.length == 0 || phone.value.length < 10){ 
      showDiv('account_info'); 
    }else{
      showDiv('account_managepost');
    }
});

document.getElementById('account_info').style.display = 'none';
document.getElementById('account_addpost').style.display = 'none';
document.getElementById('account_managepost').style.display = 'none';

switch ("<?=$page?>") {
  case "add":
    if(name.value.length == 0 || phone.value.length < 10){ 
      showDiv('account_info'); 
    }else{
      showDiv('account_addpost');
    }
    break;
  case "info":
    showDiv('account_info');
    break;
  case "manage":
    if(name.value.length == 0 || phone.value.length < 10){ 
      showDiv('account_info'); 
    }else{
      showDiv('account_managepost');
    }
    break;
}


</script>