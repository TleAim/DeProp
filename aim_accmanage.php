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

        <!-- The Modal for Post Deleting-->
        <div class="modal" id="modalCFdel">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">

              <!-- Modal Header -->
              <div class="modal-header">
                <div><h4 class="modal-title text-center text-black">คุณต้องการลบประกาศนี้?</h4></div> 

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body" id="cfPostDel" >
                <button type="button" id="cfPostDelbt"  class="btn btn-primary px-5 mx-2" data-bs-dismiss="modal">ยืนยัน</button>
                <button type="button" class="btn btn-danger px-5 mx-2" data-bs-dismiss="modal">ไม่ต้องการ</button>
              </div>

            </div>
          </div>
        </div>

        <!-- The Modal for User Status Update-->
        <div class="modal" id="modalCFUserS">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">

              <!-- Modal Header -->
              <div class="modal-header">
                <div><h4 class="modal-title text-center text-black">คุณต้องการเปลี่ยนสถานะ User นี้?</h4></div> 

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body" id="cfUserStatus" >
                <button type="button" id="cfUserStatusbt"  class="btn btn-primary px-5 mx-2" data-bs-dismiss="modal" style="width: 45%;">ยืนยัน</button>
                <button type="button" class="btn btn-danger px-5 mx-2" data-bs-dismiss="modal" style="width: 45%;">ไม่ต้องการ</button>
              </div>

            </div>
          </div>
        </div>

    </div>
</body>
</html>
<script src="./js/login.js" ></script>

<script>
  var post4del = '';
  var useruid = '';

  document.getElementById('submitUID').addEventListener('click', function(event) {
    event.preventDefault();
    getUserInfo(); 
    getUserPost();
  });

  function getUserInfo(){
    var inputid = $('#inputid').val();
    //console.log("uid: "+uid);
    
    $.ajax({
      type: 'POST',
      url: 'aim_getUserInfo.php',
      data: {
          id: inputid,
          uid: useruid
      },

      success: function(data) {
        $('#lookuserinfo').html(data);
      },
    }); 

  }

  function getUserPost(){
    var inputid = $('#inputid').val();
    //console.log("uid: "+uid);
    
    $.ajax({
      type: 'POST',
      url: 'aim_getUserPost.php',
      data: {
          id: inputid,
          uid: useruid
      },

      success: function(data) {
        $('#lookuserpost').html(data);
      },
    }); 
  }
  

  function setPostDel(post_id){
    post4del = post_id
    console.log("Confirm to deleting post :"+post4del)
  }

  function setUserStatus(uid){
    useruid = uid
    console.log("Confirm to change user status :"+useruid)
  }  

  cfPostDelbt.addEventListener("click",(e)=>{
    console.log("Confirm Delete : Post ID "+post4del)

    // Send request to your server-side script to unset the user UID using AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "aim_delpost.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            // Redirect to login.php
            //console.log(this.responseText);
            //window.location.href = "aim_accmanage.php";
            getUserPost();
        }
    };
    xhr.send('post_id='+post4del);
  });

  cfUserStatusbt.addEventListener("click",(e)=>{
    console.log("Confirm Change User Status "+useruid)

    // Send request to your server-side script to unset the user UID using AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "aim_eduserstatus.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            // Redirect to login.php
            //console.log(this.responseText);
            getUserInfo(); 
        }
    };
    xhr.send('id='+useruid);
  });


  
</script>