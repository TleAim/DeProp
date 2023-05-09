<?php
include 'display.php';
include 'init.php';
include 'lib/myvar.php';
include 'connect.php';
include 'connect2.php';
session_start();
consolelog("UID = ".$_SESSION['uid']);

$sql = "SELECT * FROM proppost WHERE post_id='".$_GET['pid']."'";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    //printArrayWithNewLine($row);

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
    //printArrayWithNewLine($row2);

    //echo $assetTypeARR[$row["asset_type"]];
}

//echo ("SESSION :".$_SESSION['uid']);
//echo $sql;

mysqli_close($conn);
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

        <!-- Top Bar -->
        <?php include 'usertopbar.php'; ?>

        <!-- Header -->
        <div class="row">
            <div class="col m-0 p-0">
                <?php include 'usertop.php'; ?>
            </div>
        </div>

        <!-- Main -->
        <div class="row px-2 pt-3">
            <div class="col-sm-8 ">
                <!-- Navi Location Link -->
                <div id="navloc" class="f12 text-secondary fw-bold pb-2">
                    <a href="#"><?=$assetTypeARR[$row["asset_type"]]?></a> >
                    <a href="#"><?=$row2["provinces"]?> </a> >
                    <a href="#"><?=$row2["amphures"]?>  </a> >
                    <a href="#"><?=$row2["districts"]?> </a> >
                    <span class="text-black">
                    <?= ($row["asset_condition_sale"] ?? null) == '1' ? "ขาย" : "" ?> 
                    <?= ($row["asset_condition_rent"] ?? null) == '1' ? " ให้เช่า" : ""; ?> 
                    <?= $assetTypeARR[$row["asset_type"]]?> <?=$row2["districts"]?>, <?=$row2["amphures"]?>
                    </span>
                </div>

                <!-- Headline & Price -->
                <div class="row pt-1">
                    <div class="col-sm-8 f22 fw-bold ">
                        <?=$row['post_head']?>
                    </div>
                    <div class="col-sm-4 f20 text-primary text-start">
                        ราคา  <?=number_format($row["asset_price"])?> บาท 
                    </div>
                </div>

                <!-- Location -->
                <div class="pb-3 f12 dynamic-font text-secondary">
                    <i class="fa fa-map-marker"></i> <?=$row2["districts"]?> <?=$row2["amphures"]?> , จังหวัด<?=$row2["provinces"]?>
                </div>

                <!-- Main Photo -->
                <div class="container p-2"><img class="thumb-image1 " src="./upload/<?=$row['post_id']?>_0.jpg"></div>

                <!-- Head & Post ID -->
                <div class="row pt-3 px-2">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="f12 align-baseline fw-bold">รายละเอียด</div>
                        <div class="f12 align-baseline text-secondary">รหัสสินทรัพย์: <?=$row["post_id"]?></div>
                    </div>
                </div>

                <!-- Description -->
                <div class="container f14 text-dark px-2 mb-3">
                    <hr>
                    <div class="py-2 text-black">
                        <?= ($row["asset_condition_sale"] ?? null) == '1' ? "ขาย" : "" ?> 
                        <?= ($row["asset_condition_rent"] ?? null) == '1' ? " ให้เช่า" : ""; ?>
                        <?=$assetTypeARR[$row["asset_type"]]?> <?=$row2["districts"]?>, <?=$row2["amphures"]?>
                    </div>
                    <div class="text-secondary">
                        <?= nl2br($row["post_desc"])?>
                    </div>
                </div>

                <!-- Photos --> 
                <div class="container p-2">
                <?php for ($x = 1; $x < 10; $x++) {
                        $fileName = $imgPath.$row["post_id"]."_".$x.".jpg";
                        //echo $fileName;
                        if (file_exists($fileName)) {
                ?>
                    <img class="thumb-image1 mb-4" src="<?=$fileName?>">
                <?php   }
                      }
                ?>
                </div>

            </div>
            <div class="col-sm-4 bg-warning">
                contact
                
            </div>
        </div>



    </div>
 <p class="m-5 p-5"></p>
</body>

</html>

<script src="./js/login.js" ></script>
