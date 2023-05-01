<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
    unset($_SESSION["uid"]);
    echo "UID unset.";
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Error: Invalid request.";
}
?>
