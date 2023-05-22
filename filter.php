<?php
include 'connect2.php';
$sql2 = "SELECT * FROM `provinces` ORDER BY `provinces`.`name_th`";
$query = mysqli_query($conn2, $sql2);
?>
<div class="collapse d-md-block bg-white" id="FilterItem">
    <div class="d-flex flex-column my-0 bgWhiteOP2 p-2">
    
        <div class="my-1">
            <select class="form-select form-select-sm text-center fw-bolder bgHilighttext" id="asset_type">
                <option value="0" <?php echo strlen($asset_type) > 0 ? '' : 'selected' ?> >อสังหาฯทุกประเภท</option>
                <option value="1" <?php echo $asset_type == 1 ? 'selected' : '' ?> >บ้านพร้อมที่ดิน</option>
                <option value="2" <?php echo $asset_type == 2 ? 'selected' : '' ?> >ที่ดินเปล่า</option>
                <option value="3" <?php echo $asset_type == 3 ? 'selected' : '' ?> >คอนโดมิเนียม</option>
                <option value="4" <?php echo $asset_type == 4 ? 'selected' : '' ?> >ทาวน์เฮ้าส์</option>
                <option value="5" <?php echo $asset_type == 5 ? 'selected' : '' ?> >อาคารพาณิชย์</option>
                <option value="6" <?php echo $asset_type == 6 ? 'selected' : '' ?> >วิลล่า</option>
                <option value="7" <?php echo $asset_type == 7 ? 'selected' : '' ?> >รีสอร์ท</option>
            </select>
        </div>

        <div class="my-1"> 
            <select class="form-select form-select-sm text-center fw-bolder bgHilighttext" id="asset_condition">
                <option value="0" selected>ประเภท ขายหรือเช่า</option>
                <option value="1">ประเภท ขาย</option>
                <option value="2">ประเภท ให้เช่า</option>
            </select>
        </div>

        <div class="my-1">
            <select class="form-select form-select-sm text-center fw-bolder bgHilighttext" id="asset_price">
                <option value="0" selected>ไม่ระบุราคา</option>
                <option value="1">ต่ำกว่า 1 ล้านบาท</option>
                <option value="2">ราคา 1 ถึง 2 ล้านบาท</option>
                <option value="3">ราคา 2 ถึง 3 ล้านบาท</option>
                <option value="5">ราคา 3 ถึง 5 ล้านบาท</option>
                <option value="10">ราคา 5 ถึง 10 ล้านบาท</option>
                <option value="11">ราคามากกว่า 10 ล้านบาท</option>
            </select>
        </div>

        <div class="my-1">
            <select name="province_id" id="province" class="form-select form-select-sm bgHilighttext2">
                <option value="0" class="text-center"> เลือกจังหวัด </option>
            <?php while($result = mysqli_fetch_assoc($query)): ?>
                <option class="text-center" value="<?=$result['id']?>" 
                    <?php echo $result['id'] == $province_select ? 'selected' : '';?>>
                    <?=$result['name_th']?>
                </option>
            <?php endwhile; ?>
            </select>
        </div>

        <div class="my-1">
            <select name="amphure_id" id="amphure" class="form-select form-select-sm bgHilighttext2" disabled>
                <option value="0" class="text-center"> เลือกอำเภอ </option>
            </select>
        </div>

        <div class="my-1">
            <select name="district_id" id="district" class="form-select form-select-sm bgHilighttext2" disabled>
                <option value="0" class="text-center"> เลือกตำบล </option>
            </select>
        </div>        
        
        <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#FilterItem" id="hidefilterBT">ซ่อนตัวกรอง</button>
                    
    </div>
</div>

<script src="./js/loc.js"></script>