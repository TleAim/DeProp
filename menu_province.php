<?php 
include 'connect2.php';
include './lib/myvar.php';

$resultProvince = array();
for($i=1;$i<=6;$i++){
    $sql = "SELECT * FROM `provinces` WHERE geography_id = '".$i."' ORDER BY `provinces`.`name_th`";
    $result = mysqli_query($conn2, $sql);
    $resultProvince[$i] = $result;
}

?>
<!-- Province Link -->
<div class="container p-0 mt-4 text-start bgWhiteOP4" id="FilterPV">
    
    <?php for($i=1;$i<=6;$i++){ ?>
    <div class="bgGray text-black fw-bold p-2 f14 txtWrap ">
        <i class='fas fa-braille'></i> <?=$geo_thai[$i]?>
    </div>
    <?php
    while($rowPV = $resultProvince[$i]->fetch_assoc()) {
    ?>
    <div class="text-secondary p-2 f12 fw-bold border-bottom scale-button bgPVMENU">
        <div class="hoverblue ">
            <i class="fa fa-map-marker"></i> <a href="./index.php?pv=<?=$rowPV['id']?>"><?=$rowPV['name_th']?></a>
        </div>
    </div>
    <?php } } ?>
                    
</div>