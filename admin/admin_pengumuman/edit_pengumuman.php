<?php
    session_start();
    require_once '../../koneksi.php';

    // 1. PROTEKSI LOGIN
    if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
        header("Location: ../../admin.html");
        exit();
    }

    // 2. LOGIKA UPDATE (Hanya jalan jika tombol 'update' diklik)
    if(isset($_POST['update'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $judul = mysqli_real_escape_string($conn, $_POST['judul']);
        $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
        $isi = mysqli_real_escape_string($conn, $_POST['isi']);
        $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);

        $query = "UPDATE pengumuman SET 
                  judul='$judul', 
                  kategori='$kategori', 
                  isi='$isi', 
                  tanggal='$tanggal' 
                  WHERE id=$id";

        if(mysqli_query($conn, $query)) {
            echo "<script>alert('Berhasil diupdate!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Gagal update: " . mysqli_error($conn) . "');</script>";
        }
    }

    // 3. AMBIL DATA AWAL (Untuk mengisi form)
    if(isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $result = mysqli_query($conn, "SELECT * FROM pengumuman WHERE id=$id");
        $row = mysqli_fetch_assoc($result);

        if(!$row) {
            die("Data tidak ditemukan!");
        }
    } else {
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengumuman - SMA YARI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Edit Pengumuman</h5>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul</label>
                            <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($row['judul']); ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kategori</label>
                                <select name="kategori" class="form-select">
                                    <?php 
                                    $cats = ['Penting', 'Kegiatan', 'Informasi', 'Libur'];
                                    foreach($cats as $c):
                                        $selected = ($row['kategori'] == $c) ? 'selected' : '';
                                        echo "<option value='$c' $selected>$c</option>";
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="<?= $row['tanggal']; ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Isi Pengumuman</label>
                            <textarea name="isi" class="form-control" rows="8" required><?= htmlspecialchars($row['isi']); ?></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-secondary">Batal</a>
                            <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>