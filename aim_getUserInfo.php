<?php 
include 'connect.php';

include 'display.php';
include 'lib/myvar.php';

session_start();
consolelog("CHECKING POST_ID : ".$_POST['id']);
consolelog("CHECKING USER ID :".$_POST['uid']);

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

if($_POST['uid'] != ''){
    consolelog("GET INFO FROM USER ID.");
    $user_sql = "SELECT * FROM `userprofile` WHERE uid = '".$_POST['uid']."'";
    
}elseif($_POST['id'] != ''){
    consolelog("GET INFO FROM POST ID.");
    $user_sql = "SELECT * FROM `userprofile` WHERE uid IN (
                    SELECT uid FROM proppost WHERE post_id = '".$_POST['id']."')"; 
    
}else{
    exit();
}
//echo($user_sql);

$user_result = mysqli_query($conn, $user_sql);
$row = mysqli_fetch_assoc($user_result);
?>

<div class="container-fluid bgWhiteOP1 mt-4 p-3 ">

<?php 

if(strlen($row['uid'])>0){ ?>
    <div class="p-2 d-flex flex-column justify-content-center">
        <h4>รายละเอียดบัญชี</h4>
        <div>UID: <?=$row['uid']?></div>
        <div>Name: <?=$row['name']?></div>
        <div>Phone: <?=$row['phone']?></div>
        <div>EMAIL: <?=$row['email']?></div>
        <div>LINE: <?=$row['lineid']?></div>
        <div>Facebook: <?=$row['fb']?></div>
        <div>Twitter: <?=$row['tw']?></div>
        <div>STATUS: <?=$row['status']?></div>
        <div class="mt-3" data-bs-toggle="modal" data-bs-target="#modalCFUserS" onclick="setUserStatus('<?=$row['uid']?>')">
            <span class="py-2 px-3 f14  rounded text-white scale-button bg-secondary">
            <i class='fab fa-mandalorian' style='font-size:20px'></i> เปลี่ยนสถานะ
            </span>
        </div>
    </div>
<?php }else{ ?>
    <div class="p-2 d-flex justify-content-center">
        <h4>ไม่พบ USER จาก POST ID นี้</h4>
    </div>
<?php } ?>