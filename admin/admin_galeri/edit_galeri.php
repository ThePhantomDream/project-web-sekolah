<?php
session_start();
require_once '../../koneksi.php';

// 1. PROTEKSI LOGIN
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("Location: ../../admin.html");
    exit();
}

// 2. FETCH DATA FIRST (Ensures $row is available everywhere)
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM galeri WHERE id=$id");
    $row = mysqli_fetch_assoc($result);
    
    // If ID doesn't exist in DB
    if(!$row) { header("Location: index.php"); exit(); }
} else {
    header("Location: index.php"); exit();
}

// 3. LOGIKA EDIT
if(isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi'] ?? 'Tanpa deskripsi');
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori'] ?? 'Umum');

    /* CRITICAL CHECK: 
       If your database column is named 'gambar', change ['galeri'] back to ['gambar'] below.
    */
    $nama_file = $row['gambar']; // Default ke nama file lama jika tidak ada upload baru

    if(isset($_FILES['gambar_baru']) && $_FILES['gambar_baru']['error'] === 0) {
        $ext = pathinfo($_FILES['gambar_baru']['name'], PATHINFO_EXTENSION);
        $nama_file_baru = time() . "_" . $id . "." . $ext; 
        $target = "../../store_galeri/" . $nama_file_baru;

        if(move_uploaded_file($_FILES['gambar_baru']['tmp_name'], $target)) {
            // Delete old file if it exists
            if(!empty($row['galeri']) && file_exists("../../store_galeri/" . $row['galeri'])) {
                unlink("../../store_galeri/" . $row['galeri']);
            }
            $nama_file = $nama_file_baru;
        }
    }

    // Update query - ensure the column name 'galeri' matches your DB
    $query = "UPDATE galeri SET 
              judul='$judul', 
              deskripsi='$deskripsi', 
              kategori='$kategori', 
              gambar='$nama_file' 
              WHERE id=$id";

    if(mysqli_query($conn, $query)) {
        echo "<script>alert('Berhasil update!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal update!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Galeri - SMA YARI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #f4f7f6; }
        .card { border: none; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .img-clickable { 
            width: 100%; max-width: 400px; border-radius: 8px; 
            cursor: zoom-in; transition: transform 0.3s ease;
        }
        .img-clickable:hover { transform: scale(1.02); filter: brightness(90%); }
        .zoom-hint { font-size: 0.75rem; color: #6c757d; margin-top: 5px; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand"><i class="fas fa-edit me-2"></i> Edit Data Galeri</span>
        <a href="index.php" class="btn btn-outline-light btn-sm">Kembali</a>
    </div>
</nav>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">

                    <div class="mb-4 text-center">
                        <label class="form-label d-block fw-bold">Foto Saat Ini</label>
                        <?php $img_path = "../../store_galeri/" . $row['gambar']; ?>
                        <img src="<?= $img_path; ?>" 
                             class="img-clickable border shadow-sm" 
                             data-bs-toggle="modal" 
                             data-bs-target="#zoomModal">
                        <div class="zoom-hint"><i class="fas fa-search-plus me-1"></i> Klik untuk memperbesar</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Ganti Foto (Opsional)</label>
                        <input type="file" name="gambar_baru" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Judul</label>
                        <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($row['judul']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Kategori</label>
                        <select name="kategori" class="form-select">
                            <?php 
                            $cats = ['Umum', 'Acara', 'Akademik', 'Olahraga'];
                            foreach($cats as $c):
                                $sel = ($row['kategori'] == $c) ? 'selected' : '';
                                echo "<option value='$c' $sel>$c</option>";
                            endforeach;
                            ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($row['deskripsi']); ?></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="index.php" class="btn btn-light">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="zoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 text-end">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0 text-center">
                <img src="<?= $img_path; ?>" class="img-fluid rounded shadow-lg">
                <h5 class="text-white mt-3"><?= htmlspecialchars($row['judul']); ?></h5>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>