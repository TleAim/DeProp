<?php 
include 'connect.php';

include 'display.php';
include 'lib/myvar.php';

session_start();


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

$user_sql = "SELECT * FROM `userprofile` WHERE uid = '".$_POST['uid']."'"; 
echo $user_sql;
$user_result = mysqli_query($conn, $user_sql);
$row = mysqli_fetch_assoc($user_result);
?>

<div class="container-fluid bgWhiteOP1 mt-4 p-3 ">

<?php if(strlen($row['uid'])>0){ ?>
    <div class="p-2 d-flex flex-column justify-content-center">
        <h4>รายละเอียดบัญชี</h4>
        <div>UID: <?=$row['uid']?></div>
        <div>Name: <?=$row['name']?></div>
        <div>Phone: <?=$row['phone']?></div>
        <div>EMAIL: <?=$row['email']?></div>
        <div>LINE: <?=$row['lineid']?></div>
        <div>Facebook: <?=$row['fb']?></div>
        <div>Twitter: <?=$row['tw']?></div>
    </div>
<?php }else{ ?>
    <div class="p-2 d-flex justify-content-center">
        <h4>ไม่พบ USER ID นี้</h4>
    </div>
<?php } ?>