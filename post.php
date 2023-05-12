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

    $thumb = array();
    for ($i = 0; $i < 10; $i++) {
      $file_path = $imgPath.$row["post_id"]."_".$i.".jpg";
      $file_path = file_exists($file_path) ? $file_path : $noimgPath ;
      $thumb[$i] = $file_path;
    }

}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$row['post_head']?></title>
    <!-- META FOR SOCIAL SHARE --> 
    <meta property="og:url" content="<?=$weburl?>post.php?pid=<?=$row["post_id"]?>">
    <meta property="og:title" content="Page Title">
    <meta property="og:description" content="Description of the page.">
    <meta property="og:image" content="<?=$thumb[0]?>">
</head>
<body class="bg-light">
    <?php if (is_mobile()) { ?>
        <div class="container bg-white px-0" >
    <?php }else{ ?>
        <div class="container bg-white px-0" style="width: 1200px;">

    <?php } ?>

    <div class="container-fluid bgTop1 p-0">
        <!-- Top Bar -->
        <?php include 'usertopbar.php'; ?>
    

        <!-- Header -->
        <div class="row">
            <div class="col m-0 p-0">
                <?php include 'usertop.php'; ?>
            </div>
        </div>
    </div>

        <!-- Main -->
        <div class="row ps-3 pe-1 pt-3">
            <div class="col-sm-8 ">

                <!-- Navi Location Link -->
                <div id="navloc" class="f12 text-secondary fw-bold px-1 pb-2">
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
                <div class="container px-1 m-0 pt-1">
                    <div class="f22 fw-bold ">
                        <?=$row['post_head']?>
                    </div>
                    <div class="f20 text-primary text-start">
                      ราคา  <?=number_format($row["asset_price"])?><span class="f12">บาท</span> 
                    </div>
                </div>

                <div class="d-flex">
                    <!-- Create By/Date/Location -->
                    <div class="px-1 py-2 f12 text-secondary">
                        <i class='fas fa-user-alt'></i> <span class="pe-2">โดย abcdefg</span>
                        <i class='far fa-clock'></i> <span class="pe-2">เผยแพร่ <?=convertDateFormat($row["post_date"])?></span>
                        <i class="fa fa-map-marker"></i> <?=$row2["districts"]?> <?=$row2["amphures"]?> , จังหวัด<?=$row2["provinces"]?>
                    </div>
                </div>
                <!-- Social Share -->
                <div class="pt-1 f12 text-start">
                    
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$weburl?>post.php?pid=<?=$row["post_id"]?>" target="_blank">
                        <span class="bgFB px-2 py-1 ms-1 text-white rounded"><i class='fab fa-facebook-f'></i><span class="ps-2">Share</span></span>
                    </a>
                    
                    <a href="https://twitter.com/intent/tweet?url=<?=$weburl?>post.php?pid=<?=$row["post_id"]?>"  target="_blank">
                        <span class="bgTW px-2 py-1 ms-1 text-white rounded"><i class='fab fa-twitter'></i><span class="ps-1"> Tweet</span></span>
                    </a>

                    <a href="https://social-plugins.line.me/lineit/share?url=<?=$weburl?>post.php?pid=<?=$row["post_id"]?>"  target="_blank">
                        <span class="bgLINE px-2 py-1 ms-1 text-white rounded"> LINE</span>
                    </a>
                </div>

                

                <!-- Main Photo -->
                <?php if($thumb[0] != $noimgPath){ ?>
                    <div class="container p-2">
                        <img class="thumb-image1 " src="<?=$thumb[0]?>">
                    </div>
                <?php } ?>


                <!-- Head & Post ID -->
                <div class="row pt-2 px-2">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="f12 align-baseline fw-bold text-secondary">รายละเอียด</div>
                        <div class="f12 align-baseline text-secondary">รหัสสินทรัพย์: <?=$row["post_id"]?></div>
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
                            //echo $fileName;
                            if (file_exists($fileName)) {
                    ?>
                        <img class="thumb-image1 mb-4" src="<?=$fileName?>">
                    <?php   }
                          }
                    ?>
                    </div>
                <?php }else{ echo "<div class=\"p-2\"></div>";} ?>
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
