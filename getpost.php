<?php
    include 'connect.php';
    include 'connect2.php';

    $page           = isset($_GET['page']) ? $_GET['page'] : 1;
    $assetType      = isset($_GET['assetType']) ? $_GET['assetType'] : 0;
    $assetCondition = isset($_GET['assetCondition']) ? $_GET['assetCondition'] : 0;
    $assetPrice     = isset($_GET['assetPrice']) ? $_GET['assetPrice'] : 0;
    $selectProvince = isset($_GET['selectProvince']) ? $_GET['selectProvince'] : 0;
    $selectAmphure  = isset($_GET['selectAmphure']) ? $_GET['selectAmphure'] : 0;
    $selectDistrict = isset($_GET['selectDistrict']) ? $_GET['selectDistrict'] : 0;

    $priceRange = array(
      1=>" and asset_price <= 1000000",
      2=>" and asset_price BETWEEN 1000000 and 2000000",
      3=>" and asset_price BETWEEN 2000000 and 3000000",
      5=>" and asset_price BETWEEN 3000000 and 5000000",
      10=>" and asset_price BETWEEN 5000000 and 10000000",
      11=>" and asset_price > 10000000"
    );

    $assetTypeARR = array(
      1=>"บ้านพร้อมที่ดิน",
      2=>"ที่ดินเปล่า",
      3=>"คอนโดมิเนียม",
      4=>"ทาวน์เฮ้าส์",
      5=>"อาคารพาณิชย์"     
    );

    $assetConARR = array(
      1=>"ขาย",
      2=>"ให้เช่า"
    );

    //(condition ? true : false);
    ($assetType>0 ? $_assetType = " and asset_type = ".$assetType : $_assetType = "");
    ($assetCondition>0 ? $_assetCondition  = " and asset_condition = ".$assetCondition : $_assetCondition = "");
    ($selectProvince>0 ? $_selectProvince  = " and loc_province = ".$selectProvince : $_selectProvince = "");
    ($selectAmphure>0  ? $_selectAmphure   = " and loc_amphur = ".$selectAmphure : $_selectAmphure = "");
    ($selectDistrict>0 ? $_selectDistrict  = " and loc_district = ".$selectDistrict : $_selectDistrict = "");
    ($assetPrice>0 ? $_assetPrice =  $priceRange[$assetPrice] : $_assetPrice = "");
  

    $sqlFilter = $_assetType.$_assetCondition.$_selectProvince.$_selectAmphure.$_selectDistrict.$_assetPrice;

    //Get Count Record
    $count_query = "SELECT COUNT(*) as count FROM proppost WHERE 1".$sqlFilter;
    $count_result = mysqli_query($conn, $count_query);
    $count_row = mysqli_fetch_assoc($count_result);
    $total_count = $count_row['count'];

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    if($total_count > 100){
      $total_count = 100;
    }

    $limit = 8;
    $prevpage = ($page - 1 < 1) ? 1 : $page - 1;
    $nextpage = ($page+1 <= $total_count/$limit ? $page+1 : $page);
    $offset = ($page - 1) * $limit;

  
    $sqlPostList = "SELECT * FROM proppost WHERE 1 ".$sqlFilter." ORDER BY post_id DESC LIMIT $offset, $limit;";
    $resultPostList = mysqli_query($conn, $sqlPostList);
?>

<script>
  console.log("Count SQL:"+"<?=$count_query?>");
  console.log("Total Count:"+"<?=$total_count?>");
  console.log("Total Result ="+"<?=$total_count?>"
   +"Check var Page="+<?=$page?>
   +" Type="+<?=$assetType?>+" Con="+<?=$assetCondition?>+" Price="+<?=$assetPrice?>
   +" Prov="+<?=$selectProvince?>+" Amp="+<?=$selectAmphure?>+" Dis="+<?=$selectDistrict?>);

  console.log("SQL Filter :"+"<?=$sqlFilter?>");
</script>


<!-- TOP Page Selection -->
<?php if(0){?>
<div class=" mt-0 mb-0 d-flex justify-content-end">
  <ul class="pagination flex-wrap m-0">
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

<!-- Loading Display -->
<div id="loading" class="bg-white m-0" style="position: relative;">  
  <div class="loader-container">
    <div class="loader"></div>
  </div>
</div>

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


      
      <div class="bg-primary m-0 scale-button" onclick="window.open('a.html', '_blank');" style="padding-top: 0px; padding-bottom: 0px; border-radius: 24px 24px 24px 24px; position: relative;"> 
        <div class="row ">
          <div class="col m-2"></div>
        </div>

        <div class="row svgbg03">
          <div class="col p-3 m-1  text-white" >
            <h5 class="text-break"><?=$row["post_head"]?></h5>
            <span class="fs-9"><em><small>--Post เมื่อ <?=$row["post_date"]?></small></em></span>
          </div>
        </div>
        <div class="row svgbg02 m-0 pt-2" >
          <div class="col-sm-4">
          
            <div class="thumb album-thumb">
              <div class="thumb-container">
                <div class="images-container">
                  <img class="thumb-image" src="./img/baan.jpg"/>
                  <img class="thumb-image" src="./img/baan.jpg"/>
                  <img class="thumb-image" src="./img/baan.jpg"/>
                </div>
                <div class="photo-count">
                  <div class="content">
                    <div class="number">90</div>
                    <div class="label">PHOTOS</div>
                  </div>
                </div>
              </div>
            </div>
            </div>
          
          <div class="col-sm-8 ps-0 text-black ">
              <p class="ps-3 text-primary ps-0 mt-2"><span class="fw-bolder bgHilighttext2 p-2 rounded">รหัสสินทรัพย์: DEP<?=$row["post_id"]?></p>
              <p class="ps-4 text-break ">[<?=$assetConARR[$row["asset_condition"]]?>]<?=$assetTypeARR[$row["asset_type"]]?> </p>
              <p class="ps-4 ">ขนาดเนื้อที่: <?=$row["count_sizerai"]?> ไร่ <?=$row["count_sizengan"]?> งาน <?=$row["count_sizeva"]?> ตร.วา</p>
              <p class="ps-4 fs-9 fst-italic text-secondary"><small>เขตพื้นที่ <?=$row2["districts"]?> <?=$row2["amphures"]?> , จังหวัด<?=$row2["provinces"]?></small></p>
              <p class="ps-4 text-break"><?=substr($row["post_desc"],0,150)."..."?></p>
              <p class="ps-3 "><span class="bgHilighttext2 text-success p-2 rounded"><span class="fw-bolder">ราคา: </span><span class="fs-5 fw-bold"><?=number_format($row["asset_price"])?> บาท </span></span></p>
              <div class="ms-4 mt-2 mb-4">
                <button class="button" onclick="window.open('map.html', '_blank');"><i class="fas fa-map"></i> แผนที่สินทรัพย์</button>
              </div>
              

            </div>
        </div>

        <div class="row ">
          <div class="col m-2 "></div>
        </div>
      
      </div>
      <p class="m-3"></p>
      <?php 
        }
      } else {
      ?>
        <div class=" mb-3 bg-white rounded text-center">
        <h2 class="pt-20 text-danger"><br>ขออภัย ไม่พบสินทรัพย์จากตัวเลือกของคุณในขณะนี้<br><br><br></h2>
        <p class=""><a href="./index.php">ดูสินทรัพย์มาใหม่ล่าสุด กดที่นี่ </a></p>
        <br>
      </div>
      <?php } ?>

  </div>


<!-- Bottom Page Selection -->
<?php if($total_count>0){?>
<div class=" mt-0 mb-0 d-flex justify-content-end">
  <ul class="pagination flex-wrap m-0">
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