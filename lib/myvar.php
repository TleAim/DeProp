<?php 
    $imgPathTemp    =   "./upload/tmp/";
    $imgPath        =   "./upload/";
    $noimgPath      =   "./img/noimage.png";

    $ggapiKey       =   "AIzaSyBBWOQ9LZBRJ1HKPv_YdGqWyBk6xyL2tpc";

    $assetTypeARR = array(
        1=>"บ้านพร้อมที่ดิน",
        2=>"ที่ดินเปล่า",
        3=>"คอนโดมิเนียม",
        4=>"ทาวน์เฮ้าส์",
        5=>"อาคารพาณิชย์",
        6=>"วิลล่า",
        7=>"รีสอร์ท"
      );
  
      $priceRange = array(
        1=>" and asset_price <= 1000000",
        2=>" and asset_price BETWEEN 1000000 and 2000000",
        3=>" and asset_price BETWEEN 2000000 and 3000000",
        5=>" and asset_price BETWEEN 3000000 and 5000000",
        10=>" and asset_price BETWEEN 5000000 and 10000000",
        11=>" and asset_price > 10000000"
      );

      $geo_thai = array(
        1=>"ภาคเหนือ",
        2=>"ภาคกลาง",
        3=>"ภาคตะวันออกเฉียงเหนือ",
        4=>"ภาคกลางฝั่งตะวันตก",
        5=>"ภาคตะวันออก",
        6=>"ภาคใต้"
      )

?>