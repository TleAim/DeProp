<?php

include 'connect.php';
include 'connect2.php';

$assetTypeARR = array(
    1=>"บ้านพร้อมที่ดิน",
    2=>"ที่ดินเปล่า",
    3=>"คอนโดมิเนียม",
    4=>"ทาวน์เฮ้าส์",
    5=>"อาคารพาณิชย์"     
  );
    session_start();
    $sql = "SELECT * FROM `proppost` WHERE uid = '".$_SESSION['uid']."' ORDER BY `proppost`.`post_date` DESC"; //echo $sql;
    $resultPostList = mysqli_query($conn, $sql);
?>
<!-- Result AREA -->
<div class="mt-2 p-0" id="resultArea">
<?php

  if ($resultPostList->num_rows > 0) {
      while($row = $resultPostList->fetch_assoc()) {
          //GET Location
          $sqlGetLOC = "
          SELECT provinces.name_th as provinces, amphures.name_th as amphures, districts.name_th as districts
          FROM provinces
          JOIN amphures ON provinces.id = amphures.province_id
          JOIN districts ON amphures.id = districts.amphure_id
          WHERE provinces.id = ".$row["loc_province"]." AND amphures.id = ".$row["loc_amphur"]." AND districts.id =".$row["loc_district"];
          //echo($sqlGetLOC);
          $resultLOC = mysqli_query($conn2, $sqlGetLOC);
          $row2 = $resultLOC->fetch_assoc();
?>


      
<div class="bgWhiteOP2 m-0 scale-button" onclick="window.open('a.html', '_blank');" > 

<div class="row m-0 pt-4" >
  <div class="col-sm-4">
    <div><img class="thumb-image1 " src="./img/baan.jpg"/></div>
    <div class="d-flex mb-3 bg-light">
      <div class="py-1 px-0 flex-item"><img class="thumb-image1 " src="./img/baan.jpg"/></div>
      <div class="p-1 flex-item"><img class="thumb-image1 " src="./img/condo.jpg"/></div>
      <div class="py-1 px-0 flex-item"><img class="thumb-image1 " src="./img/townhome.jpg"/></div>
    </div>
  </div>
  
  <div class="col-sm-8 ps-0 text-black ">
    <div class="ps-4 fw-bold f20">
      <?=number_format($row["asset_price"])?> บาท 
    </div>

    <div class="ps-4 p-1 pb-2 text-secondary f14 fw-bolder">
      <?=$row["post_head"]?><span class="f12 ps-2"><em>--Post เมื่อ <?=$row["post_date"]?></em></span>
    </div>

    <div class="ps-4  text-break fw-bolder ">
      <?= ($row["asset_condition_sale"] ?? null) == '1' ? "<span class=\"badge bg-primary\">ขาย</span>" : "" ?> 
      <?= ($row["asset_condition_rent"] ?? null) == '1' ? "<span class=\"badge bg-success\">ให้เช่า</span>" : ""; ?> 
      <span class="badge bg-dark"><?= $assetTypeARR[$row["asset_type"]] ?> </span>
    </div>

    <div class="ps-4 p-1 "><i class='fas fa-chart-area'></i>
      <?= $row["count_sizerai"] > 0 ? $row["count_sizerai"] . " ไร่" : "" ?>
      <?= $row["count_sizengan"] > 0 ? $row["count_ngan"] . " งาน" : "" ?>
      <?= $row["count_sizeva"] > 0 ? $row["count_sizeva"] . " ตร.วา" : "" ?>
    </div>

    <div class="ps-4 pb-3 f12 dynamic-font text-secondary">
      <i class="fa fa-map-marker"></i> <?=$row2["districts"]?> <?=$row2["amphures"]?> , จังหวัด<?=$row2["provinces"]?>
    </div>

    <div class="ps-4 pb-3 f14 text-break"><?=substr($row["post_desc"],0,250)."..."?></div>

    <div class="ms-4 mt-2 mb-4">
      <button class="button" onclick="window.open('map.html', '_blank');"><i class="fas fa-map"></i> แผนที่สินทรัพย์</button>
    </div>

  </div>
</div>

</div>
      <p class="m-3"></p>
      <?php 
        }
      } else {
      ?>
        <div class=" mb-3 bg-white rounded text-center">
        <h2 class="pt-20 px-5 text-danger"><br>ขออภัย ไม่พบสินทรัพย์จากตัวเลือกของคุณในขณะนี้<br><br><br></h2>
        <p class=""><a href="./index.php">ดูสินทรัพย์มาใหม่ล่าสุด กดที่นี่ </a></p>
        <br>
      </div>
      <?php } ?>

  </div>