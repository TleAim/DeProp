<?php
include 'display.php';
include 'init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS --> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- My CSS -->
    <link href="bs5.css" rel="stylesheet">
    <link href="bg.css" rel="stylesheet">
    
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    
    <!-- Firebase Authen -->
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-auth.js"></script>
    
    <script src="app.js" type="module" ></script>
    <title>ประกาศขายบ้านและที่ดิน อสังหาริมทรัพย์</title>
</head>
<body class="svgbg01">
    
    
    <?php if (is_mobile()) { ?>
        <div class="container-fluid" >
    <?php }else{ ?>
        <div class="container-fluid" style="width: 1200px;">
    <?php } ?>
    <link href="loginform1.css" rel="stylesheet">

<form>
  
  <div class="segment">
    <h1>Sign up</h1>
  </div>
  
  <label>
    <input type="text" placeholder="Email Address"/>
  </label>
  <label>
    <input type="password" placeholder="Password"/>
  </label>
  <button class="red" type="button"><i class="icon ion-md-lock"></i> Log in</button>
  
  <div class="segment">
    <button class="unit" type="button"><i class="icon ion-md-arrow-back"></i></button>
    <button class="unit" type="button"><i class="icon ion-md-bookmark"></i></button>
    <button class="unit" type="button"><i class="icon ion-md-settings"></i></button>
  </div>
  
  <div class="input-group">
    <label>
      <input type="text" placeholder="Email Address"/>
    </label>
    <button class="unit" type="button"><i class="icon ion-md-search"></i></button>
  </div>
  
</form>
        
    </div>

    <?php include 'modal.php'; ?>
    <?php if (is_mobile()) { ?>
        <div class="container-fluid" >
    <?php }else{ ?>
        <div class="container-fluid" style="width: 1200px;">
    <?php } ?>
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>