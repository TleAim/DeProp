<?php/*
session_start();

if (isset($_POST['uid'])) {
    // Store the UID in a global PHP variable (session variable)
    $_SESSION['uid'] = $_POST['uid'];
    echo "UID stored successfully: " . $_SESSION['uid'];
} else {
    http_response_code(400);
    echo "Error: UID not received.";
}*/
?>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["uid"])) {
    $_SESSION["uid"] = $_POST["uid"];
    echo "UID set.";
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Error: Invalid request.";
}
?>
