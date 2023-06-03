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

$sqlProvince = "SELECT * FROM `provinces` ORDER BY `provinces`.`name_th`";
$resultProvince = mysqli_query($conn2, $sqlProvince);

$sqlGetName = "SELECT * FROM userprofile WHERE uid=(SELECT uid FROM proppost WHERE post_id='".$_GET['pid']."')";
$resultName = mysqli_query($conn, $sqlGetName);
$rowName = $resultName->fetch_assoc();

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

    $thumb = array();
    for ($i = 0; $i < 10; $i++) {
      $file_path = $imgPath.$row["post_id"]."_".$i.".jpg";
      $file_path = file_exists($file_path) ? $file_path : $noimgPath ;
      $thumb[$i] = $file_path;
    }

}

mysqli_close($conn);
mysqli_close($conn2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PNN5CWEV4J"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-PNN5CWEV4J');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$row['post_head']?></title>
    <link rel="icon" href="icon.png" type="image/png" sizes="20x20">
    <!-- META FOR SEO --> 
    <meta name="description" content="<?=substr($row["post_desc"],0,400)?>">
    <meta name="keywords" content="ประกาศฟรี,ซื้อขายที่ดิน,ซื้อขายบ้าน,บ้านมือสอง,ขาย<?=$assetTypeARR[$row["asset_type"]]?>,ให้เช่า<?=$assetTypeARR[$row["asset_type"]]?>,ขาย<?=$assetTypeARR[$row["asset_type"]]?><?=$row2["districts"]?>,ขาย<?=$assetTypeARR[$row["asset_type"]]?><?=$row2["amphures"]?>,ขาย<?=$assetTypeARR[$row["asset_type"]]?><?=$row2["provinces"]?>">
    <meta name="robots" content="index,follow">

    <!-- META FOR SOCIAL SHARE --> 
    <meta property="og:url" content="<?=$weburl?>post.php?pid=<?=$row["post_id"]?>">
    <meta property="og:title" content="<?=$row['post_head']?>">
    <meta property="og:description" content="<?=substr($row["post_desc"],0,400)?>">
    <meta property="og:image" content="<?=$thumb[0]?>">
</head>
<body class="bg-light">
    <?php if (is_mobile()) { ?>
        <div class="container-fluid bg-white p-0" >
    <?php }else{ ?>
        <div class="container-fluid bg-white p-0 f12" style="max-width: 1200px; min-height: 500px;">

    <?php } ?>

        <!-- Header -->
        <div class="container-fluid">
            <?php include 'usertopbar.php'; ?>
            <?php include 'usertop.php'; ?>
        </div>

    <!-- Main -->
    <div class="container-fluid">
        <div class="row ps-3 pe-1 pt-3">
            <div class="col-sm-9 ">

            <!-- Navi Location Link -->
            <div id="navloc" class="f12 text-secondary fw-bold px-1 pb-2">
                <a href="./index.php?at=<?=$row["asset_type"]?>"><?=$assetTypeARR[$row["asset_type"]]?></a> >
                <a href="./index.php?pv=<?=$row["loc_province"]?>"><?=$row2["provinces"]?> </a> >
                <a href="./index.php?ap=<?=$row["loc_amphur"]?>"><?=$row2["amphures"]?>  </a> >
                <a href="./index.php?ds=<?=$row["loc_district"]?>"><?=$row2["districts"]?> </a> >

                <span class="text-black">
                <?= ($row["asset_condition_sale"] ?? null) == '1' ? "ขาย" : "" ?> 
                <?= ($row["asset_condition_rent"] ?? null) == '1' ? " ให้เช่า" : ""; ?> 
                <?= $assetTypeARR[$row["asset_type"]]?> <?=$row2["districts"]?>, <?=$row2["amphures"]?>
                </span>
            </div>

            <!-- Headline & Price -->
            <div class="container m-0 pt-1 ps-2">
                <div class="f22 fw-bold ">
                    <?=$row['post_head']?>
                </div>
                <div class="f20 text-primary text-start">
                  ราคา  <?=number_format($row["asset_price"])?><span class="f12">บาท</span> 
                </div>
            </div>

            <div class="d-flex pt-1 ps-2">
                <!-- Create/Date -->
                <div class="f12 text-secondary">
                    <i class='fas fa-user-alt'></i> <span class="pe-2">โดย <?=$rowName['name']?></span>
                    <i class='far fa-clock'></i> <span class="pe-2">เผยแพร่ <?=convertDateFormat($row["post_date"])?></span>
                </div>
            </div>

            <!-- Social Share -->
            <div class="row pt-2 ps-0 pe-1 ">
                <div class="col-12 d-flex justify-content-between">
                    <div class="">

                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$weburl?>post.php?pid=<?=$row["post_id"]?>" target="_blank">
                            <span class="bgFB px-3 py-1 ms-1 text-white rounded f12"><i class='fab fa-facebook-f'></i><span class="ps-2">Share</span></span>
                        </a>

                        <a href="https://twitter.com/intent/tweet?url=<?=$weburl?>post.php?pid=<?=$row["post_id"]?>"  target="_blank">
                            <span class="bgTW px-3 py-1 ms-1 text-white rounded f12"><i class='fab fa-twitter'></i><span class="ps-1"> Tweet</span></span>
                        </a>

                        <a href="https://social-plugins.line.me/lineit/share?url=<?=$weburl?>post.php?pid=<?=$row["post_id"]?>"  target="_blank">
                            <span class="bgLINE px-3 py-1 ms-1 text-white rounded f12"> LINE</span>
                        </a>
                    </div>
                    
                    <div class="">
                        <?php if($row["asset_maps"]){ $link = $row["asset_maps"]; ?>
                            <button class="py-1 px-2 f12 btn btn-danger" onclick="window.open('<?=$link?>', '_blank');"><i class="fas fa-map"></i> ดูแผนที่</button>
                        <?php } ?>
                    </div>
                    
                </div>
            </div>

            <!-- Main Photo -->
            <?php if($thumb[0] != $noimgPath){ ?>
                <div class="container p-2">
                    <img class="thumb-image2 " src="<?=$thumb[0]?>">
                </div>
            <?php } ?>


            <!-- Head & Post ID -->    
            <div class="ps-2 pt-3">
                <div class="f12 text-secondary">รหัสทรัพย์: <?=$row["post_id"]?></div>
                <div class="d-flex pb-2">
                    <!-- Area/Location -->
                    <div class="f12 text-secondary">
                        <span class="pe-2">
                        <i class="fa fa-map-marker"></i> <?=$row2["districts"]?> <?=$row2["amphures"]?> , จังหวัด<?=$row2["provinces"]?>
                        </span>
                        <i class='fas fa-chart-area'></i>
                        <?= $row["count_sizerai"] = isset($row["count_sizerai"]) && $row["count_sizerai"] > 0 ? $row["count_sizerai"] . " ไร่" : ""; ?>
                        <?= $row["count_sizengan"] = isset($row["count_sizengan"]) && $row["count_sizengan"] > 0 ? $row["count_sizengan"] . " งาน" : "" ?>
                        <?= $row["count_sizeva"] = isset($row["count_sizeva"]) && $row["count_sizeva"] > 0 ? $row["count_sizeva"] . " ตร.วา" : "" ?>
                    </div>
                </div>
                
            </div>
                    
            <!-- Description -->
            <div class="container f14 text-dark px-2 mb-3">
                <hr class="m-0 p-0">
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
            <?php if($thumb[1] != $noimgPath){ ?>
            <div class="container p-2">
            <?php for ($x = 1; $x < 10; $x++) {
                $fileName = $imgPath.$row["post_id"]."_".$x.".jpg";
                if (file_exists($fileName)) {
            ?>
                <img class="thumb-image2 mb-4" src="<?=$fileName?>">
            <?php }} ?>
            </div>
            <?php }else{ echo "<div class=\"p-2\"></div>";} ?>
        </div>



        
        <!-- SECOND COLUMN -->
        <div class="col-sm-3">
        <?php if($row['uid'] != $admin){ ?>
            <div class="container text-center p-0 mb-4 ">
                <div class="bgWhiteOP4">
                    <div class="text-secondary f12 fw-bold pt-2">ลงประกาศโดย :</div>
                    <div class="text-black fw-bold f16 pb-4"><?=$rowName['name']?></div>
                    <div class="pb-3"><span class="text-secondary bg-light border border-secondary py-2 px-4 f12 rounded">ช่องทางติดต่อ</span></div>
                </div>
                

                <!-- USER Phone -->
                <?php if($rowName['phone']){?>
                <div class="row d-flex py-2 m-0 bgWhiteOP4">
                    <div class="col-3 text-end f14 text-secondary p-0 m-0 ">
                        <i class="fa fa-mobile-phone" style='font-size:24px'></i> <span class="text-danger fw-bold"></span>
                    </div>
                    <div class="col-9 text-start ">
                        <span class="txtWrap pe-1 text-black f12">: <?=$rowName['phone']?></span>
                    </div>
                </div>
                <?php }?>

                <!-- USER Email -->
                <?php if($rowName['email']){?>
                <div class="row d-flex py-2 m-0 bgWhiteOP4">
                    <div class="col-3 text-end f14 text-secondary p-0 m-0 ">
                        อีเมล
                    </div>
                    <div class="col-9 text-start " id="emaildisplay">
                        <div class="txtWrap text-black f12">: <?=$rowName['email']?></div>
                    </div>
                </div>
                <?php }?>

                <!-- USER LineID -->
                <?php if($rowName['lineid']){?>
                <div class="row d-flex py-2 m-0 bgWhiteOP4">
                    <div class="col-3 text-end f14 text-white p-0 m-0">
                       <span class="bg-success rounded px-2 py-1">LINE</span>
                    </div>
                    <div class="col-9 text-start ">
                        <span class="txtWrap pe-1 text-black f12">: <?=$rowName['lineid']?></span>
                    </div>
                </div>
                <?php }?>

                <!-- USER Facebook -->
                <?php if($rowName['fb']){?>
                <div class="row d-flex py-2 m-0 bgWhiteOP4">
                    <div class="col-3 text-end f14 text-white p-0 m-0 ">
                        <i class='fab fa-facebook-square' style='font-size:28px;color:#3975ea;'></i>
                    </div>    
                    <div class="col-9 text-start">
                        <a href="https://www.facebook.com/<?=$rowName['fb']?>">
                        <span class="txtWrap pe-1 textFB f12">: <?=$rowName['fb']?></span> <span class="f12 textFB"><i class='fas fa-external-link-alt'></i></span>
                        </a>
                    </div>
                </div>
                <?php }?>

                <!-- USER twitter -->
                <?php if($rowName['tw']){?>
                <div class="row d-flex py-2 m-0 bgWhiteOP4">
                    <div class="col-3 text-end f14 text-white p-0 m-0 ">
                        <i class="	fab fa-twitter-square" style='font-size:28px;color:#4d9feb;'></i> 
                    </div>
                    <div class="col-9 text-start ">
                        <a href="https://twitter.com/<?=$rowName['tw']?>">
                        <span class="txtWrap pe-1 textTW f12">: <?=$rowName['tw']?></span> <span class="f12 textTW"><i class='fas fa-external-link-alt'></i></span>
                        </a>
                    </div>
                </div>
                <?php }?>

        <?php } ?>

                <?php 
                include 'menu_province.php'; 
                ?>
            </div>

        </div>

        </div> <!-- END TAG MAIN -->
    </div>
    <!-- Footer -->
    <div class="container-fluid p-0">
        <?php include 'footer.php'; ?>
    </div>
</div><!-- END Container -->

</body>

</html>

<script src="./js/login.js" ></script>
