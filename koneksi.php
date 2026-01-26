<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Coba format ini, ini paling standar buat MAMP
$conn = mysqli_connect("localhost:8889", "root", "root", "db_sekolah");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>