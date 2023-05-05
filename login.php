<div class="d-flex flex-row-reverse align-items-end p-0 " id="profile">
    <div class="d-flex flex-row-reverse align-items-end rounded py-1 px-2 me-0">
        <div class="btn3 mt-1">
            <button  id="login-bt" class=""  style="display: none;" onclick="redirectToLogin();">
                <span class="shadow"></span>
                <span class="edge"></span>
                <span class="front text"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ </span>
            </button>
        </div>

        <div id="myaccount">
            <a href="myaccount.php" class="no-underline" >
                <span id="welcome" class="text-black scale-button f14 fw-bold pb-1 dynamic-font"></span>
            </a>
        </div>
    </div>
</div>

<!-- The Modal for LOGOUT-->
<div class="modal" id="modalcflogout">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content ">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">คุณต้องการออกจากระบบหรือไม่?</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="cflogout" >
        <button type="button" id="cflogoutbt"  class="btn btn-primary px-5 mx-2" data-bs-dismiss="modal">ยืนยัน</button>
        <button type="button" class="btn btn-danger px-5 mx-2" data-bs-dismiss="modal">ไม่ต้องการ</button>
      </div>

    </div>
  </div>
</div>

<script>
    cflogoutbt.addEventListener("click",(e)=>{
        firebase.auth().signOut().then(() => {
            profile.style.display   = "none"
            loginbt.style.display   = "block"
            welcome.style.display   = "none"
            cfModal.style.display   = "none"

            // Send request to your server-side script to unset the user UID using AJAX
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "session_reset.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    // Redirect to login.php
                    window.location.href = "myaccount_login.php";
                }
            };
            xhr.send("logout=true");

        }).catch((error) => {
          // An error happened.
        });

    })

    function redirectToLogin() {
        window.location.href = "myaccount_login.php";
    }
</script>