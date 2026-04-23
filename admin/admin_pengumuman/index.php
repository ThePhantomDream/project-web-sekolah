<?php
session_start();
require_once '../../koneksi.php';

// 1. PROTEKSI LOGIN (Check ONLY - do not destroy!)
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("Location: ../../admin.html");
    exit();
}

// 2. AMBIL DATA
$query = "SELECT * FROM pengumuman ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);

// ... The rest of your HTML code goes here ...
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Pengumuman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }
        .navbar { background-color: #1a5c37; } /* Matching your green theme */
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .btn-add { background-color: #1a5c37; color: white; border-radius: 8px; }
        .btn-add:hover { background-color: #14462a; color: white; }
        .badge-penting { background-color: #dc3545; }
        .badge-kegiatan { background-color: #198754; }
        .badge-informasi { background-color: #0dcaf0; }
        .badge-libur { background-color: #6c757d; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="fas fa-bullhorn me-2"></i> Admin Pengumuman
        </a>
        <div class="d-flex">
            <a href="../dashboard.php" class="btn btn-outline-light btn-sm me-2">Ke Dashboard Utama</a>
            <a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h4 class="fw-bold">Manajemen Pengumuman</h4>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus me-1"></i> Tambah Pengumuman
            </button>
        </div>
    </div>

    <div class="card p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Preview Isi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td class="small text-muted"><?= date('d M Y', strtotime($row['tanggal'])); ?></td>
                        <td class="fw-bold"><?= $row['judul']; ?></td>
                        <td>
                            <span class="badge badge-<?= strtolower($row['kategori']); ?>">
                                <?= $row['kategori']; ?>
                            </span>
                        </td>
                        <td class="text-truncate" style="max-width: 200px;">
                            <?= strip_tags($row['isi']); ?>
                        </td>
                        <td class="text-center">
                            <a href="edit_pengumuman.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="delete_pengumuman.php?id=<?= $row['id']; ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Hapus pengumuman ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buat Pengumuman Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="proses_tambah.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Pengumuman</label>
                        <input type="text" name="judul" class="form-control" placeholder="Contoh: Jadwal UTS Semester Genap" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Kategori</label>
                            <select name="kategori" class="form-select">
                                <option value="Penting">Penting (Merah)</option>
                                <option value="Kegiatan">Kegiatan (Hijau)</option>
                                <option value="Informasi">Informasi (Biru)</option>
                                <option value="Libur">Libur (Abu-abu)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Isi Pengumuman</label>
                        <textarea name="isi" class="form-control" rows="6" placeholder="Tuliskan detail informasi di sini..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-success">Publikasikan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>