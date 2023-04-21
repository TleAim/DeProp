<!DOCTYPE html>
<html>
  <head>
    <title>Firebase Phone Authentication Example</title>
    <!-- Add Firebase JavaScript library -->

    
    <script>
         import { initializeApp } from "https://www.gstatic.com/firebasejs/9.9.3/firebase-app.js";
      // Initialize Firebase
      const firebaseConfig = {
    apiKey: "AIzaSyBsmB5fIa2sJ9SbdGNbRAHtGiHCNax5YOE",
    authDomain: "basic-firebase-d5dbc.firebaseapp.com",
    projectId: "basic-firebase-d5dbc",
    storageBucket: "basic-firebase-d5dbc.appspot.com",
    messagingSenderId: "273388886612",
    appId: "1:273388886612:web:2497888a8126d49f6eabc1",
    measurementId: "G-KRECQE5FS0"
  };
      firebase.initializeApp(firebaseConfig);
      firebase.analytics();
      
      // Function to handle phone number authentication
      function handlePhoneAuth() {
        // Get user's phone number input
        const phoneNumber = document.getElementById("phone-number").value;
        
        // Send verification code to user's phone number
        const appVerifier = window.recaptchaVerifier;
        firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
          .then((confirmationResult) => {
            // Code sent successfully
            const code = prompt("Please enter the verification code sent to your phone number:");
            return confirmationResult.confirm(code);
          })
          .then((result) => {
            // User successfully authenticated
            console.log(result);
          })
          .catch((error) => {
            // Error occurred during authentication
            console.log(error);
          });
      }
    </script>
  </head>
  <body>
    <h1>Firebase Phone Authentication Example</h1>
    <p>Please enter your phone number to authenticate:</p>
    <input type="tel" id="phone-number" placeholder="Enter phone number">
    <div id="recaptcha-container"></div>
    <button onclick="handlePhoneAuth()">Login with Phone Number</button>
    
    <script src="https://www.google.com/recaptcha/api.js?render=explicit" async defer></script>
    <script>
      // Render reCAPTCHA widget
      window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
        'size': 'invisible',
        'callback': (response) => {
          console.log("reCAPTCHA widget loaded");
        }
      });
    </script>
  </body>
</html>
