<!-- The Modal Sign-in Selection -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

        <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">กรุณาเข้าสู่ระบบ</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

        <!-- Modal body -->
            <div class="modal-body">
                <img id="fbbt" src="img/fb-bt.jpg" class="img-fluid rounded p-2">
                <img id="ggbt" src="img/gg-bt.jpg" class="img-fluid rounded p-2">
                <div class="text-center">
                    <button id="phonebt" type="button" class="btn btn-secondary rounded p-2">เข้าสู่ระบบด้วยเบอร์โทรศัพท์</button>
                </div>
            </div>

        <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
            </div>

        </div>
    </div>
</div>


<!-- The Modal Input Phone Number  -->
<div class="modal fade" id="phoneModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

        <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">กรุณากรอกเบอร์โทร</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

        <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <!-- Add two inputs for "phoneNumber" and "code" -->
                        <input type="tel" class="form-control" id="phoneNumber" placeholder="ใส่เบอร์โทร เช่น 0861234567">
                        <button id="getSMScode" class="btn btn-sm btn-primary my-2" >
                        รับรหัส sms </button>
                    </div>
                    
                    <div class="col-8 mt-4">
                        <input type="text" class="form-control" id="smsCode" placeholder="รหัสจาก sms เช่น 1234"/>
                        <button id="cfSMScode" class="btn btn-sm btn-primary my-2" >
                        ยืนยันรหัส sms</button>
                        <div id="codeFail" style="display: none;" class="text-danger">รหัสยืนยันไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง!</div>
                    </div>
                </div>


            </div>
            <!-- Add a container for reCaptcha -->
            <div id="recaptcha-container"></div>

        <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
            </div>

        </div>
    </div>
</div>