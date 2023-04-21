<?php
include 'connect2.php';

$sql2 = "SELECT * FROM `provinces` ORDER BY `provinces`.`name_th`";
$query = mysqli_query($conn2, $sql2);
?>

<div class="bgWhiteOP2 p-3">

    <p class="text-center fs-5">ลงประกาศ สำหรับอสังหาริมทรัพย์เท่านั้น</p>
    <form action="submit_form.php" method="post" enctype="multipart/form-data" id="sale-form">
    
    <!-- พื้นที่อัพโหลดรูปภาพ -->
    <div class="dropzone" id="dropzone">
        <p class="text-center fs-6">ลากรูปภาพมาใส่ หรือ กดที่นี่เพื่อใส่รูปภาพ</p>
    </div>
    <div class="" id="thumbnails"></div>
    <script src="upload.js"></script>  

    
    
    <!-- รายละเอียดประกาศ -->
    <div class="mb-2 mt-3">
        <input type="text" class="form-control" id="post_head" name="post_head" placeholder="หัวข้อประกาศ: เช่น บ้าน ติดถนนใหญ่ ใกล้ตัวเมือง" required oninvalid="setCustomMessage(this, 'กรุณาใส่หัวข้อประกาศ')">
    </div>

    <div class="mb-2">
        <input type="text" class="form-control" id="price" placeholder="ใส่ราคาเช่น 1500000 หากไม่ต้องการระบุราคา ใส่ 0" name="price" oninput="clearNonNumericInput(this); formatNumberWithCommas(this);  " >
    </div>

    <div class="row my-2">
        <div class="col-12 ">
            <select name="province_id" id="province" class="form-select form-select-sm" required oninvalid="setCustomMessage(this, 'กรุณาระบุพื้นที่สินทรัพย์ด้วยค่ะ')">
                <option value="" class="text-center"> เลือกจังหวัด </option>
            <?php while($result = mysqli_fetch_assoc($query)): ?>
                <option class="text-center" value="<?=$result['id']?>"><?=$result['name_th']?></option>
            <?php endwhile; ?>
            </select>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12">
            <select name="amphure_id" id="amphure" class="form-select form-select-sm" disabled>
                <option value="0" class="text-center"> เลือกอำเภอ </option>
            </select>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12">
            <select name="district_id" id="district" class="form-select form-select-sm" disabled>
                <option value="0" class="text-center"> เลือกตำบล </option>
            </select>
        </div>
    </div>                

    <div class="mb-3">
        <textarea class="form-control" id="post_desc" name="post_desc" rows="5" cols="30" placeholder="รายละเอียดสินทรัพย์"></textarea>
    </div>
    
    <div class="mb-3 form-control">
        <p class="mb-1 form-label">สินทรัพย์นี้สำหรับ:</p>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="type-sale" name="type" value="1" checked>
            <label class="form-check-label" for="type-sale">ขาย</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="type-rent" name="type" value="1">
            <label class="form-check-label" for="type-rent">ให้เช่า</label>
        </div>
    </div>

    <div class="mb-2 form-control ">
        <p class="mb-1 form-label">ขนาดพื้นที่:</p>
        <div class="d-flex">
        <select class="form-select form-select-sm me-1" id="rai" name="rai" style="width: 30%;"></select>
        <select class="form-select form-select-sm me-1" id="ngan" name="ngan" style="width: 30%;">
            <option value="0" class="text-center"> 0 งาน </option>
            <option value="1" class="text-center"> 1 งาน </option>
            <option value="2" class="text-center"> 2 งาน </option>
            <option value="3" class="text-center"> 3 งาน </option>
        </select>
        <select class="form-select form-select-sm" id="va" name="va" style="width: 30%;"></select>
        </div> 
    </div>

    <div class="mb-3 form-control">
        <p class="mb-1 form-label">ระยะเวลาที่แสดงประกาศ</p>
        <input type="radio" id="d30" name="duration" value="30">
        <label for="d30" class="pe-2">30 วัน</label>
        <input type="radio" id="d60" name="duration" value="60" checked>
        <label for="d60" class="pe-2">60 วัน</label>
        <input type="radio" id="d90" name="duration" value="90">
        <label for="d90" class="pe-2">90 วัน</label>
        <input type="radio" id="d120" name="duration" value="120">
        <label for="d120" class="pe-2">120 วัน</label>
    </div>

    
    <h5 class="mt-2 pt-2 ps-2 form-label"> ช่องทางติดต่อ</h5>
    <div class="mb-3">
        <input type="tel" class="form-control" id="contact_phone"  placeholder="เบอร์โทรติดต่อ เช่น 0633435158" name="phone" maxlength="12" pattern="[0-9]{10}" required>
    </div>

    <div class="mb-3 mt-3">
        <input type="text" class="form-control" id="contact_line" name="contact_line" placeholder="LINE ID ไลน์ไอดี (ถ้ามี)" required>
    </div>

    <div class="mb-3">
        <input type="url" class="form-control" id="location" name="location" required placeholder="ลิงค์แผนที่(ถ้ามี) เช่น https://goo.gl/maps/TYJXRquKGHrKcG47A">
    </div>

    <button type="submit" class="btn btn-primary mt-2">ยืนยัน ลงประกาศ</button>
    </form>
    <p class="mb-3"></p>


  <script src="loc.js"></script>
  <script>
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

    $('#phone').keyup(function(){
        $(this).val($(this).val().replace(/(\d{3})\-?(\d{3})\-?(\d{4})/,'$1-$2-$3'))
    });
  </script>

<script>
    function generateOptions() {
      const raiElement = document.getElementById('rai');
      const vaElement = document.getElementById('va');
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
