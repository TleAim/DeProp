<?php
function menu_navi($pname){
    echo "
    <nav class=\"navbar navbar-expand-md bg-dark navbar-dark\">
    <a class=\"navbar-brand\" href=\"./index.php\">".$pname."</a>
    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapsibleNavbar\">
      <span class=\"navbar-toggler-icon\"></span>
    </button>
    <div class=\"collapse navbar-collapse\" id=\"collapsibleNavbar\">
      <ul class=\"navbar-nav\">
        <li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php\">หน้าหลัก</a></li>  
        <li class=\"nav-item\"><a class=\"nav-link\" href=\"#contact\">ติดต่อเรา</a></li>    
      </ul>
    </div>  
  </nav>
    ";
  }

function is_mobile() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $mobile_agents = [
        "Android", "iPhone", "iPad", "iPod", "webOS", "BlackBerry", "Windows Phone"
    ];
    foreach ($mobile_agents as $mobile_agent) {
        if (strpos($user_agent, $mobile_agent) !== false) {
            return true;
        }
    }
    return false;
}
?>