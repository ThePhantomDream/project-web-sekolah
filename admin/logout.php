<?php
session_start();

// 1. Kosongkan semua variabel session
$_SESSION = array();

// 2. Hapus cookie session di browser jika ada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Hancurkan data session di server
session_destroy();

// 4. Tambahkan header anti-cache agar tidak bisa di-"Back" oleh browser
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

// 5. Redirect ke halaman login dengan pesan sukses
header("Location: admin.html?pesan=logout");
exit();
?>