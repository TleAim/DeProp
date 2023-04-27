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


function consolelog($output) {
    // Convert the output to a JSON string to handle special characters
    $outputJson = json_encode($output);

    // Print JavaScript code with the console.log() function
    echo "<script>console.log('PHP output: $outputJson');</script>";
}

function printPostValues() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<h3>POST Values:</h3>";
        echo "<pre>";
        
        foreach ($_POST as $key => $value) {
            echo "Key: " . htmlspecialchars($key) . " | Value: " . htmlspecialchars($value) . "\n";
        }
        echo "</pre>";
    }
}

function removeCommas($inputString) {
    $outputString = str_replace(',', '', $inputString);
    return $outputString;
}

function addCommas($number) {
    $formattedNumber = number_format($number);
    return $formattedNumber;
}

function removeHyphens($inputString) {
    $outputString = str_replace('-', '', $inputString);
    return $outputString;
}
?>