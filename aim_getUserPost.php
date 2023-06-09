<?php
include 'connect.php';
include 'connect2.php';
include 'lib/myvar.php';
include 'display.php';

    session_start();
    consolelog("START GETTING USER POST");

    if (!isset($_SESSION['uid']) || $_SESSION['uid'] === null || $_SESSION['uid'] != $admin) {
        consolelog("NOPE");
        exit();
    }

    if($_POST['uid'] != ''){
        consolelog("GET ALL POST FROM USER ID.");
        $sql = "SELECT * FROM `proppost` WHERE uid = '".$_POST['uid']."'";
    }elseif($_POST['id'] != ''){
        consolelog("GET ALL POST FROM ONE POST ID.");
        $sql = "SELECT * FROM `proppost` WHERE uid IN ( 
                    SELECT uid FROM `userprofile` WHERE uid IN (
                        SELECT uid FROM proppost WHERE post_id ='".$_POST['id']."'))"; 
    }else{
        exit();
    }

     //echo $sql;
    
    $resultPostList = mysqli_query($conn, $sql);
?>


<script>
  var post4del ="";
  
</script>

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

          $url = $row["post_id"];
          $thumb = array();
          for ($i = 0; $i < 4; $i++) {
            $file_path = $imgPath.$row["post_id"]."_".$i.".jpg";
            $file_path = file_exists($file_path) ? $file_path : $noimgPath ;
            $thumb[$i] = $file_path;
          }
?>
      
<div class="bgWhiteOP2 m-0 scale-button" > 

<div class="row m-0 pt-4" >
  <div class="col-sm-4" onclick="window.open('post.php?pid=<?=$url?>', '_self');" >
    <div><img class="thumb-image1 " src="<?=$thumb[0]?>"/></div>
    <?php if($thumb[0] != $noimgPath){ ?>
      <div class="d-flex mb-3 bg-light">
        <div class="py-1 px-0 flex-item">
          <?php if($thumb[1] != $noimgPath){ ?><img class="thumb-image1 " src="<?=$thumb[1]?>"/><?php } ?>
        </div>
        <div class="p-1 flex-item">
          <?php if($thumb[2] != $noimgPath){ ?><img class="thumb-image1 " src="<?=$thumb[2]?>"/><?php } ?>
        </div>
        <div class="py-1 px-0 flex-item">
          <?php if($thumb[3] != $noimgPath){ ?><img class="thumb-image1 " src="<?=$thumb[3]?>"/><?php } ?>
        </div>
      </div>
    <?php }else{ echo "<div class=\"p-2\"></div>";} ?>
  </div>
  
  <div class="col-sm-8 ps-0 text-black ">
    <div onclick="window.open('post.php?pid=<?=$url?>', '_self');" >
      <div class="ps-4 fw-bold f20">
        <?=number_format($row["asset_price"])?> <span class="f12"> บาท</span>
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

      <div class="ps-4 pb-3 f14 text-break"><?=mb_substr($row["post_desc"],0,250)."..."?></div>
    </div>
    
    <div class="ms-4 mt-2 mb-4 d-flex justify-content-between">
      <div>
        <?php if($row["asset_maps"]){ $link = $row["asset_maps"]; ?>
          <button class="btn1" onclick="window.open('<?=$link?>', '_blank');"><i class="fas fa-map"></i> แผนที่สินทรัพย์</button>
        <?php } ?>
      </div>

      <div id="del" class="py-2 px-3 f14 bgRed2 rounded text-white scale-button " data-bs-toggle="modal" data-bs-target="#modalCFdel" onclick="setPostDel('<?=$url?>')">
        <div class="pt-1">
        <i class='fas fa-trash-alt' style='font-size:20px'></i> ลบประกาศ
        </div>
      </div>

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




