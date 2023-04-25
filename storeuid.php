<?php
session_start();

if (isset($_POST['uid'])) {
    // Store the UID in a global PHP variable (session variable)
    $_SESSION['uid'] = $_POST['uid'];
    echo "UID stored successfully: " . $_SESSION['uid'];
} else {
    http_response_code(400);
    echo "Error: UID not received.";
}
?>
