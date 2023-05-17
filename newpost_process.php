<?php
include 'display.php';
include 'init.php';
include './lib/myvar.php';
include './lib/lib_file.php';
include 'connect.php';
session_start();
if (!isset($_SESSION['uid']) || $_SESSION['uid'] === null) {
    header('Location: myaccount_login.php');
    exit();
}

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

echo "File Transfer";
if ($conn->query($sql) === TRUE) {
    echo "<p>New record created successfully</p>";
    for ($x = 0; $x < 10; $x++) {
        $oldFilePath = $imgPathTemp.$uid."_".$x.".jpg";
        $newFilePath = $imgPath.$post_id."_".$x.".jpg";
        echo "<br>OF :".$oldFilePath;
        echo "<br>NF :".$newFilePath;
        moveAndRenameFile($oldFilePath, $newFilePath);
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}



?>  
<script>
  // Place this script block within a <script> tag in your HTML file

  // Wait for the document to finish loading
  document.addEventListener("DOMContentLoaded", function() {
    // Perform the database insertion and file transfer

    // Redirect to myaccount.php after the tasks are completed
    window.location.href = "myaccount.php";
  });
</script>