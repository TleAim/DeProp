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
  console.log("==============IN APP.JS==============");
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
  

