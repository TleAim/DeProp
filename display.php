<?php


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
//test commit
?>