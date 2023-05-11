<div class="container-fluid bg-white py-5" id="login_area" >

        <div class="p-1 d-flex justify-content-center">
            <h2 class="modal-title">กรุณาเข้าสู่ระบบ</h2>
        </div>    

        <div class="p-1 d-flex justify-content-center">
            <img id="fbbt" src="img/fb-bt.jpg" class="img-fluid rounded p-2 scale-button">
        </div>

        <div class="p-1 d-flex justify-content-center">
            <img id="ggbt" src="img/gg-bt.jpg" class="img-fluid rounded p-2 scale-button">
        </div>

        <div class="p-2 mb-3 d-flex justify-content-center">
            <button id="phonebt" type="button" class="button2 p-2 scale-button">เชื่อมต่อด้วยเบอร์โทรศัพท์</button>
        </div>

</div>

<style>
    #phonebt,#ggbt,#fbbt {
      width: 90%;
      max-width: 400px;
    }
</style>


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

<script>
    const ggbt      = document.getElementById("ggbt")  
    const fbbt      = document.getElementById("fbbt")  
    const phonebt   = document.getElementById("phonebt")

    const getCodebt = document.getElementById("getSMScode")
    const cfCodebt  = document.getElementById("cfSMScode")
    const codeFail  = document.getElementById("codeFail") 

    //FACEBOOK LOGIN
    if(fbbt){
        fbbt.addEventListener("click",(e)=>{
            e.preventDefault()
            $('#myModal').modal('hide');
            
            firebase.auth().signInWithPopup(fbprovider).then((result) => {
                var credential = result.credential;
                var user = result.user;
                var accessToken = credential.accessToken;

                // Send the user UID to your server-side script using AJAX
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "session_storeuid.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                        // Redirect to myaccount.php
                        window.location.href = "myaccount.php";
                    }
                };
                xhr.send("uid=" + user.uid);

          }).catch((error) => {
                // Handle Errors here.
                var errorCode = error.code;
                var errorMessage = error.message;
                // The email of the user's account used.
                var email = error.email;
                // The firebase.auth.AuthCredential type that was used.
                var credential = error.credential;
          });
        })
    } 

    //GOOGLE LOGIN
    if (ggbt) {
        ggbt.addEventListener("click", (e) => {
            e.preventDefault();
            console.log("Google Login Start:");

            firebase.auth().signInWithPopup(ggprovider).then((result) => {
                const credential = result.credential;
                const token = credential.accessToken;
                const user = result.user;
                console.log("Login success :" + user.email);

                // Send the user UID to your server-side script using AJAX
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "session_storeuid.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                        // Redirect to myaccount.php
                        window.location.href = "myaccount.php";
                    }
                };
                xhr.send("uid=" + user.uid);
              
            }).catch((error) => {
                const errorCode = error.code;
                const errorMessage = error.message;
                const email = error.email;
                const credential = error.credential;
                // Handle errors as needed
            });
        });
    }



  //Send a verification code to the user's phone
  if(phonebt){
    phonebt.addEventListener("click",(e)=>{
      e.preventDefault()
      $('#myModal').modal('hide');
      $('#phoneModal').modal('show');
    })
  }

  //Button Action
  if(getCodebt){
      getCodebt.addEventListener("click",(e)=>{
        e.preventDefault()
        var phoneNumber = document.getElementById("phoneNumber").value;
        phoneNumber = "+66"+phoneNumber.substr(1);
        console.log(phoneNumber);
        submitPhoneNumberAuth();
      })
  }
  if(cfCodebt){
      cfCodebt.addEventListener("click",(e)=>{
        e.preventDefault()
        console.log(document.getElementById("smsCode").value);
        submitPhoneNumberAuthCode();
      })
  }

  window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('phoneNumber', {
    'size': 'invisible',
    'callback': (response) => {
      // reCAPTCHA solved, allow signInWithPhoneNumber.
      submitPhoneNumberAuth()
    }
  });

  // This function runs when the 'sign-in-button' is clicked
  // Takes the value from the 'phoneNumber' input and sends SMS to that phone number
function submitPhoneNumberAuth() {
    var appVerifier = window.recaptchaVerifier;
    var phoneNumber = document.getElementById("phoneNumber").value;
    phoneNumber = "+66"+phoneNumber.substr(1);
    console.log(phoneNumber);
    firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier).then(function(confirmationResult) {
        window.confirmationResult = confirmationResult;
      }).catch(function(error) {
        console.log(error);
      });
}

  // This function runs when the 'confirm-code' button is clicked
  // Takes the value from the 'code' input and submits the code to verify the phone number
  // Return a user object if the authentication was successful, and auth is complete
  function submitPhoneNumberAuthCode() {
    var smsCode = document.getElementById("smsCode").value;
    if (typeof confirmationResult !== 'undefined') {
      confirmationResult.confirm(smsCode)
        .then(function(result) {
          var user = result.user;
          console.log(user);
        $('#phoneModal').modal('hide');

        // Send the user UID to your server-side script using AJAX
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "session_storeuid.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                // Redirect to myaccount.php
                window.location.href = "myaccount.php";
            }
        };
        xhr.send("uid=" + user.uid);
        
        })
        .catch(function(error) {
          console.log(error);
          codeFail.style.opacity = 0;
          showMessageCodeFail()
          
        });
    }else{
      console.log("Incorrect SMS Code")
      showMessageCodeFail()
    }
  }

  function showMessageCodeFail(){
    codeFail.style.display = 'block';
    let opacity = 0;
    const intervalId = setInterval(() => {
      opacity += 0.1;
      codeFail.style.opacity = opacity;
  
      if (opacity >= 1) {
        clearInterval(intervalId);
        setTimeout(() => {
          codeFail.style.opacity = 0;
          codeFail.style.display = 'none';
        }, 5000); // Hide the message after 5 seconds
      }
    }, 50);
  }

  
</script>


