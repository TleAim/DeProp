<div class="container  p-0 m-0">
<div class="row ">
  <div class="col-sm-3">
    <aside>
      <div class="p-2 mb-3 bgWhiteOP2">
        <div class ="bg-primary rounded mb-1 text-center" style="cursor:pointer;" role="button" data-bs-toggle="collapse" data-bs-target="#FilterItem" aria-expanded="false" aria-controls="FilterItem">
          <div class="text-white   fw-bold px-0 py-2   d-inline-block " >
          <i class="fas fa-filter"></i> คัดกรองสินทรัพย์ 
          </div>
        </div>
          <?php include 'filter.php'; ?>
      </div>
    </aside>  
  </div>
  <div class="col-sm-9 ">
    <main>
      <div id="postResult"></div>
    </main>
  </div>
</div>
</div>
<script>
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

