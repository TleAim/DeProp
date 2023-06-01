<?php
include 'display.php';
include 'lib/myvar.php';
include 'connect.php';
include 'init.php';

session_start();
consolelog("UID = ".$_SESSION['uid']);
consolelog("NAME = ".$_SESSION['name']);
consolelog("EMAIL = ".$_SESSION['email']);
consolelog("Phone = ".$_SESSION['phone']);
//echo ("SESSION :".$_SESSION['uid']);
if (!isset($_SESSION['uid']) || $_SESSION['uid'] === null || $_SESSION['uid'] != $admin) {
    header('Location: myaccount_login.php');
    exit();
}

if ($_SESSION['uid'] == $admin) {
    consolelog("Admin access!");
}else{
    header('Location: myaccount_login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการบัญชี</title>
    <link rel="icon" href="icon.png" type="image/png" sizes="20x20">
    <meta name="robots" content="noindex">

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
        <div class="container-fluid bgWhiteOP2" style="min-height: 700px;">

            <div class="container-fluid  p-3 m-3">
                <div class="d-flex flex-row">
                    <div style="width: 70%">
                        <input type="text" class="form-control" id="inputid" placeholder="Enter POST_ID" name="inputid">
                    </div>
                    <div class="mx-2 dynamic-font">
                        <button id="submitUID" type="submit" class="btn btn-primary"> <i class="fas fa-search"></i> SEARCH</button>
                    </div>
                </div>
                <div id="lookuserinfo"></div>
                <div id="lookuserpost"></div>
            </div>

        </div>

        <!-- Footer -->
        <div class="container-fluid p-0">
            <?php include 'footer.php'; ?>
        </div>

    </div>
</body>
</html>
<script src="./js/login.js" ></script>

<script>
  document.getElementById('submitUID').addEventListener('click', function(event) {
    event.preventDefault();
    getUserInfo(); 
  });

  function getUserInfo(){
    var inputid       = $('#inputid').val();
    console.log("uid: "+uid);
    
    $.ajax({
      type: 'POST',
      url: 'aim_getUserInfo.php',
      data: {
          id: inputid
      },

      success: function(data) {
        $('#lookuserinfo').html(data);
      },
    }); 

  }
</script>