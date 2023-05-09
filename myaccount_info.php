<?php
include 'connect.php';
session_start();
if (!isset($_SESSION['uid']) || $_SESSION['uid'] === null) {
    header('Location: myaccount_login.php');
    exit();
}

$user_sql = "SELECT * FROM `userprofile` WHERE user = '".$_SESSION['uid']."'"; //echo $user_sql;
$user_result = mysqli_query($conn, $user_sql);
$user_row = mysqli_fetch_assoc($user_result);

$_SESSION["name"] = $user_row['name'] ?? '';
$_SESSION["phone"] = $user_row['phone'] ?? '';
$_SESSION["email"] = $user_row['email'] ?? '';
$_SESSION["lineid"] = $user_row['lineid'] ?? '';
$_SESSION["fb"] = $user_row['fb'] ?? '';
$_SESSION["tw"] = $user_row['tw'] ?? '';

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="container bgWhiteOP1 ">
    <div class="py-3">
        <div class="p-2 d-flex justify-content-center">
            <h2>รายละเอียดบัญชี</h2>
        </div>  
        
        <!-- Save Personal Info Confirm -->
        <div id="saved" class="container mb-3" style="max-width: 300px; display: none;">
            <div class="text-white text-center bg-success rounded">
                <p class="p-2 f18">บันทึกข้อมูลสำเร็จ</p>
            </div>
        </div>

        <!-- Not yet setting alert -->
        <div id="useralert" class="container mb-3" style="max-width: 400px; display: none;">
            <div class="text-white p-2 text-center bgRed scaleloop">
                <p class="pt-3 f16 ">กรุณาตั้งชื่อ และกรอกเบอร์โทรศัพท์ <br>ก่อนโพสต์ประกาศด้วยค่ะ</p>
            </div>
        </div>

        <!-- USER ID -->
        <div class="row d-flex p-2" >
            <div class="col-3 text-end text-secondary f14 dynamic-font">
                USER ID :
            </div>
            <div class="col-9 ps-4 text-secondary">
                <?=substr($_SESSION["uid"],3,8)?>
            </div>
        </div>
        
        <!-- USER NAME -->
        <div class="row d-flex p-2">
            <div class="col-3 text-end text-secondary f14 dynamic-font pt-2">
                ชื่อ <span class="text-danger fw-bold"> *</span> :
            </div>
            <div class="col-9">
                <input type="text" class="form-control bg-light" id="user_name" name="user_name" value="<?=$_SESSION["name"]?>" placeholder="ชื่อสำหรับใช้ติดต่อ" style="max-width: 400px;">
            </div>
        </div>

        <!-- USER Phone -->
        <div class="row d-flex p-2">
            <div class="col-3 text-end text-secondary f14 dynamic-font pt-2">
            <i class="fa fa-mobile-phone" style='font-size:24px'></i> <span class="text-danger fw-bold"> *</span> :
            </div>
            <div class="col-9">
                <input type="text" class="form-control bg-light" id="user_phone" name="user_phone" value="<?=$_SESSION["phone"]?>" placeholder="โปรดระบุเบอร์โทรศัพท์" style="max-width: 400px;">
            </div>
        </div>

        <!-- USER Email -->
        <div class="row d-flex p-2">
            <div class="col-3 text-end text-secondary f14 dynamic-font pt-2">
            <i class='fas fa-at' style='font-size:20px'></i> อีเมล :
            </div>
            <div class="col-9">
                <input type="text" class="form-control" id="user_email" name="user_email" value="<?=$_SESSION["email"]?>" placeholder="examplel@gmail.com" style="max-width: 400px;">
            </div>
        </div>

        <!-- USER LineID -->
        <div class="row d-flex p-2">
            <div class="col-3 text-end text-secondary f14 dynamic-font pt-2 text-white">
               <span class="bg-success rounded px-2 py-1"> LINE: </span>
            </div>
            <div class="col-9">
                <input type="text" class="form-control" id="user_lineid" name="user_lineid" value="<?=$_SESSION["lineid"]?>" placeholder="LINE ID" style="max-width: 400px;">
            </div>
        </div>

        <!-- USER Facebook -->
        <div class="row d-flex p-2">
            <div class="col-3 text-end text-secondary f20 dynamic-font pt-2 text-white">
            <span class="bgFB rounded px-2 py-1">
            <i class='fab fa-facebook-square' style='font-size:24px'></i>
            </span>
            </div>
            <div class="col-9 d-flex">
                <span class="pt-2 pe-1 text-secondary">facebook.com/ </span>
                <input type="text" class="form-control" id="user_fb" name="user_fb" value="<?=$_SESSION["fb"]?>" placeholder="username" style="max-width: 200px;">
            </div>
        </div>

        <!-- USER twitter -->
        <div class="row d-flex p-2 mb-3">
            <div class="col-3 text-end text-secondary f20 dynamic-font pt-2 text-white">
            <span class="bgTW rounded px-2 py-1">
                <i class="fa fa-twitter" style='font-size:20px'></i> 
            </span>
            </div>
            <div class="col-9 d-flex">
                <span class="pt-2 pe-1 text-secondary">twitter.com/</span>
                    <input type="text" class="form-control" id="user_tw" name="user_tw" value="<?=$_SESSION["tw"]?>" placeholder="username" style="max-width: 200px;">
            </div>
        </div>

        <div class="text-center mb-3">
                <button id="userinfosubmit" type="submit" class="btn btn-primary mt-2 p-2" style="width: 200px;">บันทึก</button>
        </div>

    </div>

</div>

<script> 
    function showSaved(){ $('#saved').show(); }
    function hideSaved(){ $('#saved').hide(); }
    function showUserAlert(){ $('#useralert').show(); }
    function hideUserAlert(){ $('#useralert').hide(); }

    const name  = document.getElementById("user_name")
    const phone = document.getElementById("user_phone")
    const email = document.getElementById("user_email")
    const lineid= document.getElementById("user_lineid")
    const fb    = document.getElementById("user_fb")
    const tw    = document.getElementById("user_tw")

    if(name.value.length == 0 || phone.value.length < 10){ showUserAlert()
    }else {hideUserAlert()}

    userinfosubmit.addEventListener("click",(e)=>{
        e.preventDefault()
        // Send the user UID to your server-side script using AJAX
        console.log("name :"+name.value.length)
        console.log("phone:"+phone.value.length)
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "myaccount_updateinfo.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                //showSaved();
                console.log(this.responseText);
                $('#saved').fadeIn(2000); //Show saved success
                setTimeout(function() { $('#saved').fadeOut('slow');}, 5000); //After 5sec hide it
                
                //Check Name and Phone number 
                (name.value.length == 0 || phone.value.length < 10) ? showUserAlert() : hideUserAlert()
            }
        };
        xhr.send(
            "uid=" + "<?=$_SESSION['uid']?>" + 
            "&name=" + name.value +
            "&phone=" + phone.value +
            "&email=" + email.value +
            "&lineid=" + lineid.value +
            "&fb=" + fb.value +
            "&tw=" + tw.value
        );
      })

</script>
