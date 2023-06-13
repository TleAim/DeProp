
<?php 
include 'connect2.php';
include './lib/lib_db.php';
include './lib/myvar.php';
$sqlProvince = "SELECT * FROM `provinces` ORDER BY `provinces`.`name_th`";
$resultProvince = mysqli_query($conn2, $sqlProvince);

$pv = $_GET['pv'] ?? 0;
$ap = $_GET['ap'] ?? 0;
$ds = $_GET['ds'] ?? 0;
$at = $_GET['at'] ?? 0;

?>

  <div class="p-0 bg-white d-flex" >
      <aside>
        <div class="container-fluid " id="Filter" style="min-width: 300px;">
          <div class ="p-0 mt-1 bgFB text-center" style="cursor:pointer;" role="button" data-bs-toggle="collapse" data-bs-target="#FilterItem" >
            <div class="text-white fw-bold px-0 py-2 " ><i class="fas fa-filter"></i> คัดกรองสินทรัพย์ </div>
          </div>
          <div>
            <?php include 'filter.php'; ?>
          </div>

          <?php 
                include 'menu_province.php'; 
          ?>

        </div>
      </aside>  

    <div class="flex-grow-1">
      <main>
      <div class="container bgWhiteOP2 p-3 mb-3 f14">
        <div class="d-flex">
            <a href="index.php?at=1"><span class="<?php echo cssBoxselect($at,"1")?> rounded m-1 px-2 py-0">บ้าน</span></a>
            <a href="index.php?at=2"><span class="<?php echo cssBoxselect($at,"2")?> rounded m-1 px-2 py-0">ที่ดิน</span></a>
            <a href="index.php?at=3"><span class="<?php echo cssBoxselect($at,"3")?> rounded m-1 px-2 py-0">คอนโดมิเนียม</span></a>
            <a href="index.php?at=4"><span class="<?php echo cssBoxselect($at,"4")?> rounded m-1 px-2 py-0">ทาวเฮ้าส์</span></a>
            <a href="index.php?at=5"><span class="<?php echo cssBoxselect($at,"5")?> rounded m-1 px-2 py-0">อาคารพาณิชน์</span></a>
            <a href="index.php?at=6"><span class="<?php echo cssBoxselect($at,"6")?> rounded m-1 px-2 py-0">วิลล่า</span></a>
            <a href="index.php?at=7"><span class="<?php echo cssBoxselect($at,"7")?> rounded m-1 px-2 py-0">รีสอร์ท</span></a>
        </div>
      </div>
        <?php
      
        $search = "";
        if( $pv>0 )  { $search = getnamePV($conn2,$pv);}
        elseif($ap>0){ $search = getnameAP($conn2,$ap);
        ?>
        <script>
          var amphureObject = $('#amphure');
          amphureObject.html('<option value="<?=$ap?>" class="text-center ps-2"><?=$search?></option>');
        </script>
        <?php
        }elseif($ds>0){ $search = getnameDS($conn2,$ds);
        ?>
        <script>
          $(function(){
            var districtObject = $('#district');
            districtObject.html('<option value="<?=$ds?>" class="text-center ps-2"><?=$search?></option>');
          });
        </script>
        <?php } ?>
        <div id="postResult"></div>
      </main>
    </div>

  </div>

<script>
  $('#asset_type').val(<?=$at?>);
  $('#province').val(<?=$pv?>);
  $('#amphure').val(<?=$ap?>);
  $('#district').val(<?=$ds?>);

  $(document).ready(function(){
      // Get initial records
      getData(1);

      //////////////////////////////
      // initialize element event //
      /////////////////////////////
      $(document).on('click', '.pagination li a', function(){
          var page = $(this).data('page');
          getData(page);
      });

      // Dropdown change event
      $('#asset_type').change(function(){ getData(1);});
      $('#asset_condition').change(function(){ getData(1);});
      $('#asset_price').change(function(){ getData(1);});
      $('#province').change(function(){ getData(1);});
      $('#amphure').change(function(){ getData(1);});
      $('#district').change(function(){ getData(1);});
  });
  
  function scrollToTop() {
    var element = document.getElementById("postResult");
    element.scrollIntoView({behavior: "smooth", block: "start", inline: "nearest"});
  }



  // Function to get data using AJAX
  function getData(page){
    var assetType       = $('#asset_type').val();
    var assetCondition  = $('#asset_condition').val();
    var assetPrice      = $('#asset_price').val();
    var selectProvince  = $('#province').val();
    var selectAmphure   = $('#amphure').val();
    var selectDistrict  = $('#district').val();

    //console.log("PG:"+page
    //+" Type="+assetType+" Con="+assetCondition+" Price="+assetPrice
    //+" Prov="+selectProvince+" Amp="+selectAmphure+" Dis="+selectDistrict);
     
    $.ajax({
      type: 'GET',
      url: 'getpost.php',
      data: {
          page: page,
          assetType: assetType,
          assetCondition: assetCondition,
          assetPrice: assetPrice,
          selectProvince: selectProvince,
          selectAmphure: selectAmphure,
          selectDistrict: selectDistrict
      },

      success: function(data) {
        $('#postResult').html(data);
      },
    });
    scrollToTop();
  }

  
</script>

