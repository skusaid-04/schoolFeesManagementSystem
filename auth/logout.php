<?php
session_start();

// Unset all session variables
$_SESSION =[];

//clear the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
// Destroy the session
session_destroy();

// diable back button
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // HTTP 1.1

//prevent caching
// header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0"); // HTTP 1.1
header("Cache-control: post-check=0, pre-check=0, false"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0


header("Location: login.php");
exit();
?>