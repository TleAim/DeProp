
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["uid"])) {
    $_SESSION["uid"]    = $_POST["uid"];
    //$_SESSION["name"]   = $_POST["name"];
    //$_SESSION["email"]  = isset($_POST["email"]) ? $_POST["email"] : "-";
    //$_SESSION["phone"]  = isset($_POST["phone"]) ? $_POST["phone"] : "-";
    echo "UID set.";
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Error: Invalid request.";
}
?>
