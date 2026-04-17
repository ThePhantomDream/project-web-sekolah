<?php
session_start();
require_once '../../koneksi.php';

// 1. PROTEKSI LOGIN
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("Location: ../../admin.html");
    exit();
}

// 2. LOGIKA UPLOAD
if(isset($_POST['upload'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi'] ?? 'Tanpa deskripsi');
    $kategori  = mysqli_real_escape_string($conn, $_POST['kategori'] ?? 'Umum');
    
    $foto  = $_FILES['foto']['name'];
    $tmp   = $_FILES['foto']['tmp_name'];
    $size  = $_FILES['foto']['size'];
    
    $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
    $allowed_ext = array('jpg', 'jpeg', 'png');

    if (in_array($ext, $allowed_ext) && $size <= 4 * 1024 * 1024) {
        $new_name = uniqid() . '.' . $ext;
        $tujuan = '../../store_galeri/' . $new_name;

        if (move_uploaded_file($tmp, $tujuan)) {
            $query = "INSERT INTO galeri (judul, deskripsi, gambar, kategori) 
                      VALUES ('$judul', '$deskripsi', '$new_name', '$kategori')";

            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Berhasil upload!'); window.location='index.php';</script>";
            } else {
                unlink($tujuan);
                echo "<script>alert('Gagal simpan ke database!');</script>";
            }
        } else {
            echo "<script>alert('Gagal memindahkan file!');</script>";
        }
    } else {
        echo "<script>alert('File tidak valid (Maks 4MB & JPG/PNG)!');</script>";
    }
}

// 3. AMBIL DATA UNTUK VIEW
$result = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Galeri - SMA YARI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #f4f7f6; }
        .img-preview { width: 100px; height: 70px; object-fit: cover; border-radius: 8px; cursor: pointer; transition: 0.3s; }
        .img-preview:hover { opacity: 0.7; }
        .card { border: none; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        
        /* Style untuk Fallback X di Modal */
        #previewFallbackX {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #222;
            border-radius: 15px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fas fa-camera-retro me-2"></i> Admin Galeri</a>
        <a href="../dashboard.php" class="btn btn-outline-danger btn-sm">Kembali</a>
    </div>
</nav>

<div class="container mb-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card p-4">
                <h5 class="fw-bold mb-3">Upload Foto Baru</h5>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Judul</label>
                        <input type="text" name="judul" class="form-control" required placeholder="Judul foto">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="Umum">Umum</option>
                            <option value="Acara">Acara</option>
                            <option value="Akademik">Akademik</option>
                            <option value="Olaharaga">Olahraga</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Pilih Gambar</label>
                        <input type="file" name="foto" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" name="upload" class="btn btn-primary w-100">Simpan Foto</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card p-4">
                <h5 class="fw-bold mb-3">Daftar Galeri</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Info</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            while($row = mysqli_fetch_assoc($result)): 
                                $img_show = "../../store_galeri/" . $row['gambar'];
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <img src="<?= $img_show; ?>" class="img-preview border" 
                                         onclick="previewImage('<?= $img_show; ?>', '<?= htmlspecialchars($row['judul']); ?>')"
                                         onerror="this.src='https://placehold.co/100x70?text=No+Image'">
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($row['judul']); ?></strong><br>
                                    <span class="badge bg-info text-dark" style="font-size: 0.7em;"><?= $row['kategori']; ?></span>
                                </td>
                                <td class="text-center">
                                    <a href="hapus_galeri.php?id=<?= $row['id']; ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Yakin ingin menghapus?')">
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
    </div>
</div>

<div class="modal fade" id="modalPreview" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 bg-transparent">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-white fw-bold mb-2" id="previewJudul"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 text-center position-relative">
                
                <img src="" id="previewImg" class="img-fluid rounded shadow-lg" onerror="handleBrokenImage()">
                
                <div id="previewFallbackX" class="d-none">
                    <span class="text-danger fw-bold" style="font-size: 120px;">&times;</span>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    var previewImg = document.getElementById('previewImg');
    var fallbackX = document.getElementById('previewFallbackX');

    function previewImage(src, judul) {
        // Reset tampilan awal
        previewImg.classList.remove('d-none');
        fallbackX.classList.add('d-none');
        
        // Isi data
        previewImg.src = src;
        document.getElementById('previewJudul').innerText = judul;
        
        // Tampilkan modal
        var myModal = new bootstrap.Modal(document.getElementById('modalPreview'));
        myModal.show();
    }

    function handleBrokenImage() {
        // Sembunyikan gambar, tampilkan X
        previewImg.classList.add('d-none');
        fallbackX.classList.remove('d-none');
    }
</script>

</body>
</html>