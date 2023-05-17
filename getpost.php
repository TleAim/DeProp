<?php
    include 'connect.php';
    include 'connect2.php';
    include 'display.php';
    include 'lib/myvar.php';
    
    foreach ($_GET as $key => $value) {
      consolelog("Key: " . htmlspecialchars($key) . ", Value: " . htmlspecialchars($value));
  }

    $page           = isset($_GET['page']) ? $_GET['page'] : 1;
    $assetType      = isset($_GET['assetType']) ? $_GET['assetType'] : 0;
    $assetPrice     = isset($_GET['assetPrice']) ? $_GET['assetPrice'] : 0;
    $selectProvince = isset($_GET['selectProvince']) ? $_GET['selectProvince'] : 0;
    $selectAmphure  = isset($_GET['selectAmphure']) ? $_GET['selectAmphure'] : 0;
    $selectDistrict = isset($_GET['selectDistrict']) ? $_GET['selectDistrict'] : 0;

    $assetCondition = isset($_GET['assetCondition']) ? $_GET['assetCondition'] : 0;
    $assetCondition_sale = ($assetCondition == 1) ? 1 : 0;
    $assetCondition_rent = ($assetCondition == 2) ? 1 : 0;

    //(condition ? true : false);
    ($assetType>0 ? $_assetType                       = " and asset_type = ".$assetType : $_assetType = "");
    ($assetCondition_sale>0 ? $_assetCondition_sale   = " and asset_condition_sale = ".$assetCondition_sale : $_assetCondition_sale = "");
    ($assetCondition_rent>0 ? $_assetCondition_rent   = " and asset_condition_rent = ".$assetCondition_rent : $_assetCondition_rent = "");
    ($selectProvince>0 ? $_selectProvince             = " and loc_province = ".$selectProvince : $_selectProvince = "");
    ($selectAmphure>0  ? $_selectAmphure              = " and loc_amphur = ".$selectAmphure : $_selectAmphure = "");
    ($selectDistrict>0 ? $_selectDistrict             = " and loc_district = ".$selectDistrict : $_selectDistrict = "");
    ($assetPrice>0 ? $_assetPrice                     =  $priceRange[$assetPrice] : $_assetPrice = "");
  

    $sqlFilter = $_assetType.$_assetCondition_sale.$_assetCondition_rent.$_selectProvince.$_selectAmphure.$_selectDistrict.$_assetPrice;

    //Get Count Record
    $count_query = "SELECT COUNT(*) as count FROM proppost WHERE 1".$sqlFilter;
    $count_result = mysqli_query($conn, $count_query);
    $count_row = mysqli_fetch_assoc($count_result);
    $total_count = $count_row['count'];

  
    consolelog($count_query);
    consolelog($sqlFilter);

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    if($total_count > 100){
      $total_count = 100;
    }

    $limit = 8;
    $prevpage = ($page - 1 < 1) ? 1 : $page - 1;
    $nextpage = ($page+1 <= $total_count/$limit ? $page+1 : $page);
    $offset = ($page - 1) * $limit;

  
    $sqlPostList = "SELECT * FROM proppost WHERE 1 ".$sqlFilter." ORDER BY post_date DESC LIMIT $offset, $limit;";
    $resultPostList = mysqli_query($conn, $sqlPostList);
?>



<!-- Loading Display -->
<div id="loading" class="bg-white" style="position: relative;">  
  <div class="loader-container">
    <div class="loader"></div>
  </div>
</div>

<!-- Result AREA -->
<div id="resultArea">
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
            //echo "CHK:".$file_path."<br>";
            $file_path = file_exists($file_path) ? $file_path : $noimgPath ;
            $thumb[$i] = $file_path;
            //echo "IMG".$i.":".$file_path."<br>";
            
          }
?>

      <div class="container bgWhiteOP2 scale-button" onclick="window.open('post.php?pid=<?=$url?>', '_self');" > 
        <div class="row pt-3" >
          <div class="col-sm-4">
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
              <?= $row["count_sizerai"] = isset($row["count_sizerai"]) && $row["count_sizerai"] > 0 ? $row["count_sizerai"] . " ไร่" : ""; ?>
              <?= $row["count_sizengan"] = isset($row["count_sizengan"]) && $row["count_sizengan"] > 0 ? $row["count_sizengan"] . " งาน" : "" ?>
              <?= $row["count_sizeva"] = isset($row["count_sizeva"]) && $row["count_sizeva"] > 0 ? $row["count_sizeva"] . " ตร.วา" : "" ?>
            </div>

            <div class="ps-4 pb-3 f12 dynamic-font text-secondary">
              <i class="fa fa-map-marker"></i> <?=$row2["districts"]?> <?=$row2["amphures"]?> , จังหวัด<?=$row2["provinces"]?>
            </div>

            <div class="ps-4 pb-3 f14 text-break"><?=mb_substr($row["post_desc"],0,250)."..."?></div>

            <?php if($row["asset_maps"]){ $link = $row["asset_maps"]; ?>
            <div class="ms-4 mt-2 mb-4">
              <button class="button" onclick="window.open('<?=$link?>', '_blank');"><i class="fas fa-map"></i> แผนที่สินทรัพย์</button>
            </div>
            <?php } ?>

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


<!-- Bottom Page Selection -->
<?php if($total_count>0){?>
<div class="d-flex justify-content-end">
  <ul class="pagination flex-wrap">
    <li class="page-item"><a class="page-link" href="#" data-page="<?=$prevpage?>"><< ย้อน</a></li>
    <?php
      $total_pages = ceil($total_count / $limit);
        for ($i = 1; $i <= $total_pages; $i++) {
          $bgcolor = "bg-white";
          if($page==$i){
            $bgcolor= "bg-warning text-black";
          }
          echo '<li class="page-item scale-li"><a class="page-link '.$bgcolor.'" href="#" data-page="' . $i . '">' . $i . '</a></li>';
        }
    ?>
    <li class="page-item"><a class="page-link" href="#" data-page="<?=$nextpage?>">หน้าถัดไป >></a></li>
  </ul>
</div>
<?php } ?>

<?php
// Close connection
mysqli_close($conn);
?>

<script>
  //CSS LOADER CONTROL
  // Function to show the loader
  showLoader();

  function showLoader() {
    $('#loading').show();
    $('#resultArea').hide();
    setTimeout(hideLoader, 1000);
  }

  // Function to hide the loader
  function hideLoader() {
    $('#loading').hide();
    $('#resultArea').show();
  }
</script>