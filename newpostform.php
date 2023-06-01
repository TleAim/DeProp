<?php
include 'connect2.php';

$sql2 = "SELECT * FROM `provinces` ORDER BY `provinces`.`name_th`";
$query = mysqli_query($conn2, $sql2);
?>

<div class="bgWhiteOP2 p-3">

    <p class="text-center fs-5">ลงประกาศ สำหรับอสังหาริมทรัพย์เท่านั้น</p>
    <form id="newpostform" action="newpost_process.php" method="post" >
    
    <!-- รายละเอียดประกาศ -->
    <div class="row my-2">
        <div class="col-12 ">
            <select name="province_id" id="province" class="form-select form-select-sm" oninvalid="setCustomMessage(this, 'กรุณาระบุพื้นที่สินทรัพย์ด้วยค่ะ')" required>
                <option class="text-center ps-2" value=""> เลือกจังหวัด </option>
            <?php while($result = mysqli_fetch_assoc($query)): ?>
                <option class="text-center ps-2" value="<?=$result['id']?>"><?=$result['name_th']?></option>
            <?php endwhile; ?>
            </select>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12">
            <select name="amphure_id" id="amphure" class="form-select form-select-sm" oninvalid="setCustomMessage(this, 'กรุณาระบุพื้นที่สินทรัพย์ด้วยค่ะ')" disabled required>
                <option class="text-center ps-2" value="" > เลือกอำเภอ </option>
            </select>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12">
            <select name="district_id" id="district" class="form-select form-select-sm" oninvalid="setCustomMessage(this, 'กรุณาระบุพื้นที่สินทรัพย์ด้วยค่ะ')" disabled required>
                <option class="text-center ps-2" value=""> เลือกตำบล </option>
            </select>
        </div>
    </div>                
    
    <div class="mb-3 pb-4 pt-3 form-control bgForm">
        <div class="">
            <input type="text" class="form-control" id="post_head" name="post_head" placeholder="หัวข้อประกาศ: เช่น บ้าน ติดถนนใหญ่ ใกล้ตัวเมือง" oninvalid="setCustomMessage(this, 'กรุณาใส่หัวข้อประกาศ')" required>
        </div>

        <div class="mt-1">
            <textarea class="form-control" id="post_desc" name="post_desc" rows="5" cols="30" placeholder="รายละเอียดสินทรัพย์"></textarea>
        </div>
   
        <p class="mt-4 form-label">สินทรัพย์นี้สำหรับ:</p>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="type-sale" name="asset_condition_sale" value="1" checked>
                <label class="form-check-label" for="type-sale">ขาย</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="type-rent" name="asset_condition_rent" value="1">
                <label class="form-check-label" for="type-rent">ให้เช่า</label>
            </div>

        <p class="mt-4 form-label">ราคาสินทรัพย์</p>
        <div class="">
            <input type="text" class="form-control" id="asset_price" name="asset_price" placeholder="ใส่ราคาเช่น 1500000 (หากไม่ต้องการระบุใส่ 0)" oninput="clearNonNumericInput(this); formatNumberWithCommas(this);  " required>
        </div>
    
        <p class="mt-4 form-label">ประเภทสินทรัพย์</p>
            <select class="form-select form-select-sm text-left fw-bolder" id="asset_type" name="asset_type">
                <option value="1" selected>บ้านพร้อมที่ดิน</option>
                <option value="2">ที่ดินเปล่า</option>
                <option value="3">คอนโดมิเนียม</option>
                <option value="4">ทาวน์เฮ้าส์</option>
                <option value="5">อาคารพาณิชย์</option>
                <option value="6">วิลล่า</option>
                <option value="7">รีสอร์ท</option>
            </select>
    
        <p class="mt-4 form-label">ขนาดพื้นที่:</p>
        <div class="d-flex">
            <select class="form-select form-select-sm me-1" id="area_rai" name="area_rai" style="width: 30%;"></select>
            <select class="form-select form-select-sm me-1" id="area_ngan" name="area_ngan" style="width: 30%;">
                <option value="0" class="text-center"> 0 งาน </option>
                <option value="1" class="text-center"> 1 งาน </option>
                <option value="2" class="text-center"> 2 งาน </option>
                <option value="3" class="text-center"> 3 งาน </option>
            </select>
            <select class="form-select form-select-sm" id="area_va" name="area_va" style="width: 30%;"></select>
        </div> 

        <p class="mt-4 form-label">ระยะเวลาที่แสดงประกาศ</p>
            <input type="radio" id="d30" name="post_duration" value="30">
            <label for="d30" class="pe-2">30 วัน</label>
            <input type="radio" id="d60" name="post_duration" value="60" checked>
            <label for="d60" class="pe-2">60 วัน</label>
            <input type="radio" id="d90" name="post_duration" value="90">
            <label for="d90" class="pe-2">90 วัน</label>
            <input type="radio" id="d120" name="post_duration" value="120">
            <label for="d120" class="pe-2">120 วัน</label>
        
        
    </div>

    <div class="mb-3">
        <input type="url" class="form-control" id="contact_location" name="contact_location" placeholder="ลิงค์แผนที่(ถ้ามี) เช่น https://goo.gl/maps/TYJXRquKGHrKcG47A">
    </div>

    <button id="newpostsubmit" type="submit" class="btn btn-primary mt-2">ยืนยัน ลงประกาศ</button>
    </form>
    <p class="mb-3"></p>
</div>

  <script src="./js/loc.js"></script>
  <script>
    //=======================//
    // INPUT CONTROL 
    //=======================//
    function clearNonNumericInput(inputElement) {
      const numericValue = inputElement.value.replace(/[^0-9]/g, '');
      inputElement.value = numericValue;
    }

    function formatNumberWithCommas(inputElement) {
      // Remove any existing commas
      let value = inputElement.value.replace(/,/g, '');

      // Check if the input contains only digits
      if (/^\d*$/.test(value)) {
        // Add commas to the value
        const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

        // Update the input value
        inputElement.value = formattedValue;
      } else {
        // Remove non-numeric characters
        inputElement.value = value.replace(/[^\d]/g, '');
      }
    }

    $('#contact_phone').keyup(function(){
        $(this).val($(this).val().replace(/(\d{3})\-?(\d{3})\-?(\d{4})/,'$1-$2-$3'))
    });

    function generateOptions() {
      const raiElement = document.getElementById('area_rai');
      const vaElement = document.getElementById('area_va');
      //raiElement.style.width = '30%';
      for (let i = 0; i <= 100; i++) {
        const optionElement = document.createElement('option');
        optionElement.value = i;
        optionElement.text = i + " ไร่";
        optionElement.style.textAlign = 'center';
        raiElement.add(optionElement);
      }

      for (let i = 0; i < 400; i++) {
        const optionElement = document.createElement('option');
        optionElement.value = i;
        optionElement.text = i + " ตรว.";
        optionElement.style.textAlign = 'center';
        vaElement.add(optionElement);
      }
    }
    document.addEventListener('DOMContentLoaded', generateOptions);

    function setCustomMessage(inputElement, message) {
      inputElement.setCustomValidity(message);

      // Clear the custom message when the user starts typing or makes a selection
      inputElement.oninput = function() {
        inputElement.setCustomValidity('');
      };
    }
  </script>
