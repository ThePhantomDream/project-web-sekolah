<?php
session_start();

// Tambahkan header ini agar halaman tidak tersimpan di cache browser
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

// Proteksi halaman: Cek apakah session 'status' ada DAN bernilai 'login'
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: admin.html"); 
    exit(); 
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .card-menu {
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }
        .card-menu:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            color: inherit;
        }
        .icon-large { font-size: 3rem; color: #0d6efd; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <div class="ms-auto">
                <span class="text-white me-3">Halo, <?php echo $_SESSION['username']; ?></span>
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <h2 class="fw-bold">Selamat Datang, <?php echo $_SESSION['username']; ?></h2>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <a href="../admin/admin_galeri/index.php" class="card h-100 text-center p-4 card-menu">
                    <div class="card-body">
                        <i class="bi bi-images icon-large"></i>
                        <h4 class="card-title mt-3">Galeri & Foto</h4>
                        <p class="card-text text-muted">Upload dan hapus gambar yang tampil di halaman depan.</p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="../admin/admin_pengumuman/index.php" class="card h-100 text-center p-4 card-menu">
                    <div class="card-body">
                        <i class="bi bi-megaphone icon-large"></i>
                        <h4 class="card-title mt-3">Pengumuman</h4>
                        <p class="card-text text-muted">Tulis berita atau informasi terbaru untuk siswa.</p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="direktori.php" class="card h-100 text-center p-4 card-menu">
                    <div class="card-body">
                        <i class="bi bi-folder2-open icon-large"></i>
                        <h4 class="card-title mt-3">Direktori</h4>
                        <p class="card-text text-muted">Kelola data guru, staf, atau file penting lainnya.</p>
                    </div>
                </a>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>