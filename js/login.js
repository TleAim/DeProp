  //TOP BAR USER PROFILE 
  const profile   = document.getElementById("profile")    //สำหรับควบคุม แสดง/ซ่อน เมื่อ login แล้ว
  const welcome   = document.getElementById("welcome")    //สำหรับแสดง user info
  const logout    = document.getElementById("logout")     //สำหรับ logout
  const loginbt   = document.getElementById("login-bt")

  //MADAL LOGOUT CONFIRM
  const cfModal   = document.getElementById("modalcflogout")
  const cflogoutbt= document.getElementById("cflogoutbt") 

  //account info
  const info_name = document.getElementById("info_name")
  const info_email = document.getElementById("info_email")
  const info_phone = document.getElementById("info_phone")

  ////////////////////////////////
  //ตรวจสอบการ login จากทุกช่องทาง//
  ////////////////////////////////
  console.log("==============IN login.js==============");
  firebase.auth().onAuthStateChanged((user) => {
    
    if(user){ //หาก login แล้ว
      profile.style.display   = "block"
      welcome.style.display   = "block"
      loginbt.style.display   = "none"
      welcome.innerText       = getName(user)
      uid = user.uid //set uid global

      //Update Bar info
      if(info_name)   info_name.innerText     = user.displayName ? user.displayName : " -"
      if(info_email)  info_email.innerText    = user.email ? user.email : " -"
      if(info_phone)  info_phone.innerText    = user.phoneNumber ? user.phoneNumber : " -"

      console.log("email:"+user.email)
      console.log("displayName:"+user.displayName)
      console.log("phoneNumber:"+user.phoneNumber)
      console.log("User UID :"+user.uid)
      console.log("UID Global:"+uid)

      // Send the user UID to your server-side script using AJAX
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "session_storeuid.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
              console.log("Set up $_SESSION successfully");
              //console.log(this.responseText);
          }
      };
      xhr.send("uid=" + user.uid + "&name=" + user.displayName + "&email=" + user.email + "&phone=" + user.phoneNumber);

    }else{ //หากยังไม่ login
      profile.style.display   = "none"
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
  
  function signout(){
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
              
          }
        };
      xhr.send("logout=true");

      }).catch((error) => {
      // An error happened.
      });
  }
