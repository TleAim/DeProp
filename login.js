
  const firebaseConfig = {
    apiKey: "AIzaSyBsmB5fIa2sJ9SbdGNbRAHtGiHCNax5YOE",
    authDomain: "basic-firebase-d5dbc.firebaseapp.com",
    projectId: "basic-firebase-d5dbc",
    storageBucket: "basic-firebase-d5dbc.appspot.com",
    messagingSenderId: "273388886612",
    appId: "1:273388886612:web:2497888a8126d49f6eabc1",
    measurementId: "G-KRECQE5FS0"
  };
  
  const profile   = document.getElementById("profile")    //สำหรับควบคุม แสดง/ซ่อน เมื่อ login แล้ว
  const welcome   = document.getElementById("welcome")    //สำหรับแสดง user info
  const logout    = document.getElementById("logout")     //สำหรับ logout
  const loginbt   = document.getElementById("login-bt")
  const ggbt      = document.getElementById("ggbt")  
  const fbbt      = document.getElementById("fbbt")  
  const phonebt   = document.getElementById("phonebt")
  const myModal   = document.getElementById("myModal")
  const getCodebt = document.getElementById("getSMScode")
  const cfCodebt  = document.getElementById("cfSMScode")
  //const postbt    = document.getElementById("freePost")
  const codeFail  = document.getElementById("codeFail") 

  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.auth().languageCode = 'th';

  // Initialize Firebase Authentication and get a reference to the service
  const auth = firebase.auth();

  //Create an instance provider
  var ggprovider = new firebase.auth.GoogleAuthProvider();
  var fbprovider = new firebase.auth.FacebookAuthProvider();

  ////////////////////////////////
  //ตรวจสอบการ login จากทุกช่องทาง//
  ////////////////////////////////
  console.log("==============IN APP.JS==============");
  firebase.auth().onAuthStateChanged((user) => {
    
    if(user){ //หาก login แล้ว
      profile.style.display   = "block"
      welcome.style.display   = "block"
      //postbt.style.display    = "block"
      logout.style.display    = "block"
      loginbt.style.display   = "none"
      welcome.innerText       = getName(user)
      console.log("email:"+user.email)
      console.log("displayName:"+user.displayName)
      console.log("phoneNumber:"+user.phoneNumber)
      console.log("UID:"+user.uid)
    }else{ //หากยังไม่ login
      profile.style.display   = "none"
      //postbt.style.display    = "none"
      logout.style.display    = "none"
      loginbt.style.display   = "block"
      welcome.style.display   = "none"
    }
  })

  function getName(user){
    if(user.displayName){
      return "สวัสดี "+user.displayName
    }else if(user.email){
      return "สวัสดีผู้ใช้ "+user.email
    }else if(user.phoneNumber){
      return "สวัสดีผู้ใช้ 0"+ user.phoneNumber.substr(3,9)
    }else{
      return "none"
    }

  }
  logout.addEventListener("click",(e)=>{
    firebase.auth().signOut().then(() => {
      profile.style.display   = "none"
      //postbt.style.display    = "none"
      logout.style.display    = "none"
      loginbt.style.display   = "block"
      welcome.style.display   = "none"
    }).catch((error) => {
      // An error happened.
    });
  })

  //Send a verification code to the user's phone
  if(phonebt){
    phonebt.addEventListener("click",(e)=>{
      e.preventDefault()
      $('#myModal').modal('hide');
      $('#phoneModal').modal('show');
    })
  }

  //FACEBOOK LOGIN
  if(fbbt){
  fbbt.addEventListener("click",(e)=>{
    e.preventDefault()
    $('#myModal').modal('hide');

    firebase.auth().signInWithPopup(fbprovider).then((result) => {
        var credential = result.credential;
        var user = result.user;
        var accessToken = credential.accessToken;
    
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
  if(ggbt){
  ggbt.addEventListener("click",(e)=>{
    e.preventDefault()
    $('#myModal').modal('hide');

    firebase.auth().signInWithPopup(ggprovider).then((result) => {
      var credential = result.credential;
      var token = credential.accessToken;
      var user = result.user;  //user.[displayName,email,phoneNumber,uid]
      console.log(user.email)
      displayN = user.email
    }).catch((error) => {
      // Handle Errors here.
      var errorCode = error.code;
      var errorMessage = error.message;
      // The email of the user's account used.
      var email = error.email;
      // The firebase.auth.AuthCredential type that was used.
      var credential = error.credential;
      // ...
    });

  })
  }

  //Phone LOGIN

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

  