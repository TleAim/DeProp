<?php
$pagename = "ดีพร๊อพ ตลาดบ้านและที่ดิน";
$weburl = "https://deprop.finance/";
?>

    <!-- Bootstrap 5 CSS --> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="./css/bs5.css" rel="stylesheet">
    <link href="./css/bg.css" rel="stylesheet">
    <link href="./css/loader.css" rel="stylesheet">
    <link href="./css/button.css" rel="stylesheet">

    <!-- Google Font --> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dongle:wght@700&display=swap" rel="stylesheet">
    
    <!-- Font AweSome -->
    <script src="https://kit.fontawesome.com/72b9ebe0e3.js" crossorigin="anonymous"></script>
    
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    
    <!-- Firebase Authen -->
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-auth.js"></script>
    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyBsmB5fIa2sJ9SbdGNbRAHtGiHCNax5YOE",
            authDomain: "basic-firebase-d5dbc.firebaseapp.com",
            projectId: "basic-firebase-d5dbc",
            storageBucket: "basic-firebase-d5dbc.appspot.com",
            messagingSenderId: "273388886612",
            appId: "1:273388886612:web:2497888a8126d49f6eabc1",
            measurementId: "G-KRECQE5FS0"
        };
        
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        firebase.auth().languageCode = 'th';
            
        // Initialize Firebase Authentication and get a reference to the service
        const auth = firebase.auth();
            
        //Create an instance provider
        var ggprovider = new firebase.auth.GoogleAuthProvider();
        var fbprovider = new firebase.auth.FacebookAuthProvider();

    </script>

<!-- Global Var -->
<script>
    let uid = "none";
</script>

