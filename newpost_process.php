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
                <script src="./js/login.js" ></script>
            </div>
        </div>

        <!-- Form Area -->
        <div class="row">
            <div class="col mb-4 pb-4">
            <?php
            $qrval          = "(";
            $post_id        = uniqid();                     $qrval .= "'".$post_id."',";
            $post_date      = $today = date('Y-m-d');       $qrval .= "'".$post_date."',";
            $post_duration  = $_POST['post_duration'];      $qrval .= "'".$post_duration."',";
            $post_head      = $_POST['post_head'];          $qrval .= "'".$post_head."',";
            $post_desc      = $_POST['post_desc'];          $qrval .= "'".$post_desc."',";
            $uid            = $_SESSION['uid'];             $qrval .= "'".$uid."',";  
            $loc_province   = $_POST['province_id'];        $qrval .= "'".$loc_province."',"; 
            $loc_amphur     = $_POST['amphure_id'];         $qrval .= "'".$loc_amphur."',"; 
            $loc_district   = $_POST['district_id'];        $qrval .= "'".$loc_district."',"; 
            $contact_maps   = $_POST['contact_location'];   $qrval .= "'".$contact_maps."',"; 
            $asset_price    = $_POST['asset_price'] ?? 0 ;  $qrval .= "'".removeCommas($asset_price)."',"; 
            $asset_type     = $_POST['asset_type'];         $qrval .= "'".$asset_type."',"; 
            $asset_condition_sale = $_POST['asset_condition_sale'] ?? 0 ; $qrval .= "'".$asset_condition_sale."',"; 
            $asset_condition_rent = $_POST['asset_condition_rent'] ?? 0 ; $qrval .= "'".$asset_condition_rent."',"; 
            $count_sizerai  = $_POST['area_rai'] ?? 0 ;     $qrval .= "'".$count_sizerai."',"; 
            $count_sizengan = $_POST['area_ngan'] ?? 0 ;    $qrval .= "'".$count_sizengan."',"; 
            $count_sizeva   = $_POST['area_va'] ?? 0 ;      $qrval .= "'".$count_sizeva."')"; 
    
            $sql = "INSERT INTO `proppost` ( 
                `post_id`,`post_date`,`post_duration`,`post_head`,`post_desc`,
                `uid`,`loc_province`,`loc_amphur`,`loc_district`,`asset_maps`,
                `asset_price`,`asset_type`,`asset_condition_sale`,`asset_condition_rent`,
                `count_sizerai`,`count_sizengan`,`count_sizeva`)
                
                VALUES".$qrval;

            echo "<br>QR = ".$sql;
            printPostValues();

            if ($conn->query($sql) === TRUE) {
                echo "<p>New record created successfully</p>";
                for ($x = 0; $x < 10; $x++) {
                    $oldFilePath = $imgPathTemp.$uid."_".$x.".jpg";
                    $newFilePath = $imgPath.$pid."_".$x.".jpg";
                    moveAndRenameFile($oldFilePath, $newFilePath)
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            ?>   
                <div class="p-5 m-3"></div>
            </div>

        </div>
    </div>
    <?php include 'modal.php'; ?>
</body>

</html>

