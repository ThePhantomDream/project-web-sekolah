<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $kategori = $_POST['kategori'];
    
    // Penanganan Upload Gambar
    $nama_file = $_FILES['gambar']['name'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    $path = "img_galeri/" . $nama_file;

    if (move_uploaded_file($tmp_file, $path)) {
        $query = "INSERT INTO galeri (gambar, judul, deskripsi, kategori) VALUES ('$path', '$judul', '$deskripsi', '$kategori')";
        $input = mysqli_query($conn, $query);

        if ($input) {
            echo "<script>alert('Data berhasil ditambahkan!'); window.location='galeri.php';</script>";
        } else {
            echo "<script>alert('Gagal input database');</script>";
        }
    } else {
        echo "<script>alert('Gagal upload gambar ke folder');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Galeri</title>
    <style>
        body { font-family: sans-serif; background: #f4f7f6; padding: 40px; }
        .form-container { background: white; padding: 25px; border-radius: 10px; max-width: 500px; margin: auto; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        input, textarea, select { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        button { background: #007bff; color: white; border: none; padding: 12px; width: 100%; border-radius: 5px; cursor: pointer; font-weight: bold; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Tambah Kegiatan Baru</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Judul Kegiatan:</label>
            <input type="text" name="judul" required placeholder="Contoh: Lomba Mewarnai">
            
            <label>Deskripsi:</label>
            <textarea name="deskripsi" rows="4" required placeholder="Jelaskan detail kegiatan..."></textarea>
            
            <label>Kategori:</label>
            <select name="kategori" required>
                <option value="Akademik">Akademik</option>
                <option value="Olahraga">Olahraga</option>
                <option value="Kesenian">Kesenian</option>
                <option value="Lainnya">Lainnya</option>
            </select>
            
            <label>Pilih Gambar:</label>
            <input type="file" name="gambar" accept="image/*" required>
            
            <button type="submit" name="submit">Simpan ke Galeri</button>
            <a href="galeri2.php" style="display:block; text-align:center; margin-top:15px; color:#666; text-decoration:none;">Batal</a>
        </form>
    </div>
</body>
</html>