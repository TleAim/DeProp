<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
    unset($_SESSION["uid"]);
    unset($_SESSION["name"]); 
    unset($_SESSION["email"]);
    unset($_SESSION["phone"]);
    echo "UID unset.";
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Error: Invalid request.";
}
?>
