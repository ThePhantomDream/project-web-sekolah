<?php
session_start();
require_once '../koneksi.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query untuk memeriksa username dan password
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        // Login berhasil
        $_SESSION['username'] = $username; 
        $_SESSION['status'] = "login"; 
        header("Location: dashboard.php"); 
        exit();
    } else {
        // Login gagal
        echo "<script>alert('Username atau password salah!'); window.location.href='admin.html';</script>";
        exit();
    }
}
?>