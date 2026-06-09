<?php
session_start();

$_SESSION = array(); // Clear session data

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy(); // Destroy session on server

// Clear browser cache so clicking 'Back' doesn't work
header("Cache-Control: no-cache, no-store, must-revalidate"); 
header("Pragma: no-cache"); 
header("Expires: 0"); 

header("Location: ../admin.html"); // Redirect to login
exit();
?>