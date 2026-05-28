<?php
session_start();
require_once '../../koneksi.php'; // Sesuaikan jika letak koneksi berbeda

// 1. PROTEKSI LOGIN
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("Location: ../admin.html");
    exit();
}

// 2. AMBIL STATISTIK DATA (Menghitung jumlah record tiap tabel)
$q_guru    = mysqli_query($conn, "SELECT id FROM guru");
$q_tendik  = mysqli_query($conn, "SELECT id FROM tendik");
$q_siswa   = mysqli_query($conn, "SELECT id FROM siswa_aktif");
$q_alumni  = mysqli_query($conn, "SELECT id FROM alumni");

$count_guru   = mysqli_num_rows($q_guru);
$count_tendik = mysqli_num_rows($q_tendik);
$count_siswa  = mysqli_num_rows($q_siswa);
$count_alumni = mysqli_num_rows($q_alumni);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }
        .navbar { background-color: #1a5c37; }
        .card-menu { 
            border: none; 
            border-radius: 20px; 
            transition: all 0.3s ease;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .card-menu:hover { transform: translateY(-10px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .icon-circle {
            width: 70px; height: 70px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 30px; margin-bottom: 15px;
        }
        .bg-guru { background-color: #e8f5e9; color: #2e7d32; }
        .bg-tendik { background-color: #fff3e0; color: #ef6c00; }
        .bg-siswa { background-color: #e3f2fd; color: #1565c0; }
        .bg-alumni { background-color: #f3e5f5; color: #7b1fa2; }
        
        .btn-masuk { border-radius: 10px; font-weight: 600; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark mb-5 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="fas fa-university me-2"></i> Admin Direktori
        </a>
        <div class="d-flex">
            <a href="logout.php" class="btn btn-danger btn-sm px-3 rounded-pill">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row mb-4 text-center">
        <div class="col-12">
            <h2 class="fw-bold">Manajemen Data Sekolah</h2>
            <p class="text-muted">Pilih direktori data yang ingin Anda kelola hari ini</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- DIREKTORI GURU -->
        <div class="col-md-3 col-sm-6">
            <div class="card card-menu h-100 p-4 text-center border-bottom border-4 border-success">
                <div class="icon-circle bg-guru mx-auto">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <h5 class="fw-bold">Data Guru</h5>
                <h2 class="fw-bold"><?= $count_guru; ?></h2>
                <p class="text-muted small">Total Tenaga Pengajar</p>
                <a href="guru.php" class="btn btn-success btn-masuk w-100 mt-3">Kelola Guru</a>
            </div>
        </div>

        <!-- DIREKTORI TENDIK -->
        <div class="col-md-3 col-sm-6">
            <div class="card card-menu h-100 p-4 text-center border-bottom border-4 border-warning">
                <div class="icon-circle bg-tendik mx-auto">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h5 class="fw-bold">Data Tendik</h5>
                <h2 class="fw-bold"><?= $count_tendik; ?></h2>
                <p class="text-muted small">Staf Tata Usaha / Tendik</p>
                <a href="tendik.php" class="btn btn-warning btn-masuk w-100 mt-3 text-white">Kelola Tendik</a>
            </div>
        </div>

        <!-- DIREKTORI SISWA AKTIF -->
        <div class="col-md-3 col-sm-6">
            <div class="card card-menu h-100 p-4 text-center border-bottom border-4 border-primary">
                <div class="icon-circle bg-siswa mx-auto">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h5 class="fw-bold">Siswa Aktif</h5>
                <h2 class="fw-bold"><?= $count_siswa; ?></h2>
                <p class="text-muted small">Siswa Terdaftar Aktif</p>
                <a href="siswa.php" class="btn btn-primary btn-masuk w-100 mt-3">Kelola Siswa</a>
            </div>
        </div>

        <!-- DIREKTORI ALUMNI -->
        <div class="col-md-3 col-sm-6">
            <div class="card card-menu h-100 p-4 text-center border-bottom border-4 border-secondary">
                <div class="icon-circle bg-alumni mx-auto">
                    <i class="fas fa-user-check"></i>
                </div>
                <h5 class="fw-bold">Data Alumni</h5>
                <h2 class="fw-bold"><?= $count_alumni; ?></h2>
                <p class="text-muted small">Data Lulusan Sekolah</p>
                <a href="alumni/index.php" class="btn btn-secondary btn-masuk w-100 mt-3">Kelola Alumni</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>