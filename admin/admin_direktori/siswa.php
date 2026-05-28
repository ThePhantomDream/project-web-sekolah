<?php 
include '../../koneksi.php';

// --- PROSES ACTION (TAMBAH, EDIT, HAPUS) ---
$message = "";

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $nama   = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $nis    = mysqli_real_escape_string($conn, $_POST['nis']);
    $jk     = $_POST['jenis_kelamin'];
    $kelas  = mysqli_real_escape_string($conn, $_POST['kelas']);
    $thn    = mysqli_real_escape_string($conn, $_POST['tahun_masuk']);
    $hp     = mysqli_real_escape_string($conn, $_POST['no_hp']);

   // Validate tahun_masuk: Must be a 4-digit year between 1900 and 2100
    if (!is_numeric($thn) || strlen($thn) != 4 || $thn < 1900 || $thn > 2100) {
        $message = "<div class='alert error'>Tahun Masuk harus berupa angka 4 digit antara 1900-2100.</div>";
    } else {
        // Folder foto (pastikan folder ini ada di root project Anda)
        $target_dir = "../img_siswa/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

        if ($action == 'tambah') {
            $foto = $_FILES['foto']['name'];
            if ($foto) {
                $ext = pathinfo($foto, PATHINFO_EXTENSION);
                $new_name = "siswa_" . time() . "." . $ext;
                move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $new_name);
            } else {
                $new_name = "";
            }

        $query = "INSERT INTO siswa_aktif (nis, nama_lengkap, jenis_kelamin, kelas, tahun_masuk, no_hp, foto) 
                  VALUES ('$nis', '$nama', '$jk', '$kelas', '$thn', '$hp', '$new_name')";
        
    } elseif ($action == 'edit') {
        $id = $_POST['id'];
        $old_foto = $_POST['old_foto'];
        
        if ($_FILES['foto']['name']) {
            $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $new_name = "siswa_" . time() . "." . $ext;
            move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $new_name);
            if ($old_foto && file_exists($target_dir . $old_foto)) unlink($target_dir . $old_foto);
        } else {
            $new_name = $old_foto;
        }

        $query = "UPDATE siswa_aktif SET nis='$nis', nama_lengkap='$nama', jenis_kelamin='$jk', 
                  kelas='$kelas', tahun_masuk='$thn', no_hp='$hp', foto='$new_name' WHERE id='$id'";
    }

        if (mysqli_query($conn, $query)) {
            $message = "<div class='alert success'>Data berhasil disimpan!</div>";
        } else {
            $message = "<div class='alert error'>Gagal: " . mysqli_error($conn) . "</div>";
        }
    }
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // Hapus file foto fisik
    $res = mysqli_query($conn, "SELECT foto FROM siswa_aktif WHERE id='$id'");
    $d = mysqli_fetch_assoc($res);
    if ($d['foto'] && file_exists("../img_siswa/" . $d['foto'])) unlink("../img_siswa/" . $d['foto']);
    
    mysqli_query($conn, "DELETE FROM siswa_aktif WHERE id='$id'");
    header("Location: siswa.php");
}

$search = $_GET['q'] ?? '';
$where = $search ? "WHERE nama_lengkap LIKE '%$search%' OR nis LIKE '%$search%'" : "";
$result = mysqli_query($conn, "SELECT * FROM siswa_aktif $where ORDER BY kelas ASC, nama_lengkap ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Kelola Siswa Aktif</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; margin: 0; padding: 20px; }
        .container { max-width: 1100px; margin: auto; background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        h2 { color: #8a5f00; border-bottom: 2px solid #ffe88a; padding-bottom: 10px; }
        
        /* Form Styling */
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 20px; background: #fffbea; padding: 15px; border-radius: 8px; border: 1px solid #ffe88a; }
        input, select { padding: 10px; border: 1px solid #ddd; border-radius: 5px; width: 100%; box-sizing: border-box; }
        .btn { padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: 600; }
        .btn-add { background: #f39c12; color: black; }
       
        /* AFTER */
        .btn-edit { background: #2980b9; color: white; font-size: 1em; padding: 8px 14px; border-radius: 6px; border: none; cursor: pointer; }
        .btn-del  { background: #c0392b; color: white; font-size: 1em; text-decoration: none; padding: 8px 14px; border-radius: 6px; display: inline-block; }
        .btn-edit i, .btn-del i { font-size: 1.1em; }
        
        /* Table Styling */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 0.9em; }
        th { background: #fffbea; color: #8a5f00; padding: 12px; text-align: left; border-bottom: 2px solid #ffe88a; }
        td { padding: 10px; border-bottom: 1px solid #eee; }
        .img-admin { width: 50px; height: 65px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd; }
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; }
        .btn-edit i, .btn-del i { font-size: 1.2em; }
    </style>
</head>
<body>

<div class="container">
    <h2><i class="fas fa-user-graduate"></i> Kelola Data Siswa Aktif</h2>
    <a href="../index.php" style="text-decoration:none; color:#666; font-size:0.9em;"><i class="fas fa-arrow-left"></i> Kembali ke Web</a>
    
    <?php echo $message; ?>

    <!-- Form Tambah/Edit -->
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="form-id">
        <input type="hidden" name="old_foto" id="form-old-foto">
        <input type="hidden" name="action" value="tambah" id="form-action">
        
        <div class="form-grid">
            <input type="text" name="nis" id="form-nis" placeholder="NIS" required>
            <input type="text" name="nama_lengkap" id="form-nama" placeholder="Nama Lengkap" required>
            <select name="jenis_kelamin" id="form-jk">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <input type="text" name="kelas" id="form-kelas" placeholder="Kelas (Contoh: X-A)">
            <input type="text" name="tahun_masuk" id="form-thn" placeholder="Tahun Masuk" pattern="[0-9]{4}" maxlength="4" required>
            <input type="text" name="no_hp" id="form-hp" placeholder="No. HP">
            <input type="file" name="foto" accept="image/*">
            <button type="submit" class="btn btn-add" id="btn-submit">Tambah Data</button>
        </div>
    </form>

    <!-- Tabel Data -->
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td>
                    <?php if($row['foto']): ?>
                        <img src="../img_siswa/<?php echo $row['foto']; ?>" class="img-admin">
                    <?php else: ?>
                        <i class="fas fa-user-circle fa-2x" style="color:#ccc"></i>
                    <?php endif; ?>
                </td>
                <td><?php echo $row['nis']; ?></td>
                <td><?php echo $row['nama_lengkap']; ?></td>
                <td><?php echo $row['kelas']; ?></td>
                <td>
                    <button class="btn btn-edit" onclick="editData(<?php echo htmlspecialchars(json_encode($row)); ?>)" title="Edit"><i class="fas fa-edit"></i></button>
                    <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-del" onclick="return confirm('Hapus data ini?')" title="Hapus"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
function editData(data) {
    document.getElementById('form-id').value = data.id;
    document.getElementById('form-nis').value = data.nis;
    document.getElementById('form-nama').value = data.nama_lengkap;
    document.getElementById('form-jk').value = data.jenis_kelamin;
    document.getElementById('form-kelas').value = data.kelas;
    document.getElementById('form-thn').value = data.tahun_masuk;
    document.getElementById('form-hp').value = data.no_hp;
    document.getElementById('form-old-foto').value = data.foto;
    
    document.getElementById('form-action').value = 'edit';
    document.getElementById('btn-submit').innerText = 'Update Data';
    document.getElementById('btn-submit').style.background = '#2980b9';
    window.scrollTo(0,0);
}
</script>

</body>
</html>