<?php 
include '../../koneksi.php'; 

// Path folder foto
$path_upload = "../../img_tendik/";

// Buat folder jika belum ada
if (!is_dir($path_upload)) {
    mkdir($path_upload, 0777, true);
}

// 1. LOGIKA PROSES (TAMBAH / EDIT / HAPUS)
if (isset($_GET['hapus'])) {
    $id = mysqli_real_escape_string($conn, $_GET['hapus']);
    
    $cek_foto = mysqli_query($conn, "SELECT foto FROM tendik WHERE id = '$id'");
    $f = mysqli_fetch_assoc($cek_foto);
    if (!empty($f['foto']) && file_exists($path_upload . $f['foto'])) {
        unlink($path_upload . $f['foto']);
    }

    mysqli_query($conn, "DELETE FROM tendik WHERE id = '$id'");
    header("Location: tendik.php?pesan=dihapus");
    exit;
}

if (isset($_POST['simpan'])) {
    $id = $_POST['id'] ?? '';
    // Sinkronisasi variabel: Gunakan $niy sesuai input name='niy'
    $niy = mysqli_real_escape_string($conn, $_POST['niy']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $jk = $_POST['jenis_kelamin'];
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $foto_name = $_FILES['foto']['name'];
    $foto_tmp  = $_FILES['foto']['tmp_name'];
    $nama_foto_baru = "";
    
    // Logika Upload Foto
    if (!empty($foto_name)) {
        $ekstensi = pathinfo($foto_name, PATHINFO_EXTENSION);
        $nama_foto_baru = "tendik_" . time() . "." . $ekstensi;
        $tujuan = $path_upload . $nama_foto_baru;

        if (move_uploaded_file($foto_tmp, $tujuan)) {
            // Hapus foto lama jika sedang mode EDIT
            if (!empty($id)) {
                $lama = mysqli_query($conn, "SELECT foto FROM tendik WHERE id = '$id'");
                $fl = mysqli_fetch_assoc($lama);
                if (!empty($fl['foto']) && file_exists($path_upload . $fl['foto'])) {
                    unlink($path_upload . $fl['foto']);
                }
            }
        }
    }

    if (empty($id)) {
        // PROSES INSERT
        $sql = "INSERT INTO tendik (niy, nama_lengkap, jenis_kelamin, jabatan, no_hp, email, foto) 
                VALUES ('$niy', '$nama', '$jk', '$jabatan', '$no_hp', '$email', '$nama_foto_baru')";
    } else {
        // PROSES UPDATE
        // Jika ada foto baru, masukkan ke query. Jika tidak, jangan update kolom foto.
        $query_foto = "";
        if (!empty($nama_foto_baru)) {
            $query_foto = ", foto = '$nama_foto_baru'";
        }
        
        $sql = "UPDATE tendik SET 
                niy='$niy', 
                nama_lengkap='$nama', 
                jenis_kelamin='$jk', 
                jabatan='$jabatan', 
                no_hp='$no_hp', 
                email='$email' 
                $query_foto 
                WHERE id='$id'";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href = 'tendik.php?pesan=berhasil';</script>";
        exit;
    } else {
        die("Error Database: " . mysqli_error($conn));
    }
}

$data_edit = null;
if (isset($_GET['edit'])) {
    $id_edit = mysqli_real_escape_string($conn, $_GET['edit']);
    $res_edit = mysqli_query($conn, "SELECT * FROM tendik WHERE id = '$id_edit'");
    $data_edit = mysqli_fetch_assoc($res_edit);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Kelola Tendik</title>
    <link rel="stylesheet" href="/project-web-sekolah/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-wrap { padding: 30px; background: #f4f7f6; min-height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card { background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); margin-bottom: 25px; border: 1px solid #e0e0e0; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 5px; color: #444; font-size: 0.9em; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; }
        
        .btn { padding: 10px 20px; border-radius: 6px; border: none; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-block; transition: 0.3s; }
        .btn-primary { background: #1e7e34; color: #fff; width: 100%; border: none; margin-top: 10px; }
        .btn-primary:hover { background: #145a26; }
        .btn-edit { background: #f39c12; color: #fff; padding: 5px 10px; border-radius: 4px; }
        .btn-delete { background: #e74c3c; color: #fff; padding: 5px 10px; border-radius: 4px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 15px; background: #fff; }
        table th { background: #f8f9fa; padding: 12px; text-align: left; border-bottom: 2px solid #1e7e34; color: #1e7e34; font-size: 0.8em; }
        table td { padding: 12px; border-bottom: 1px solid #eee; font-size: 0.9em; }
        .img-preview { width: 45px; height: 45px; object-fit: cover; border-radius: 50%; border: 2px solid #1e7e34; }
    </style>
</head>
<body>

<div class="admin-wrap">
    <h2><i class="fas fa-users-cog"></i> Panel Kontrol Tenaga Kependidikan</h2>
    
    <div class="card">
        <h3><?php echo $data_edit ? "Update Data Personel" : "Registrasi Personel Baru"; ?></h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $data_edit['id'] ?? ''; ?>">
            
            <div class="form-grid">
                <div class="form-group">
                    <label>NIP / NIY</label>
                    <input type="text" name="niy" value="<?php echo $data_edit['niy'] ?? ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="<?php echo $data_edit['nama_lengkap'] ?? ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" required>
                        <option value="Laki-laki" <?php echo (isset($data_edit) && $data_edit['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                        <option value="Perempuan" <?php echo (isset($data_edit) && $data_edit['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" value="<?php echo $data_edit['jabatan'] ?? ''; ?>" placeholder="Contoh: Tata Usaha" required>
                </div>
                <div class="form-group">
                    <label>No. HP</label>
                    <input type="text" name="no_hp" value="<?php echo $data_edit['no_hp'] ?? ''; ?>" placeholder="0812...">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $data_edit['email'] ?? ''; ?>" placeholder="alamat@email.com">
                </div>
            </div>
            
            <div class="form-group">
                <label>Foto Profil (Opsional)</label>
                <input type="file" name="foto" accept="image/*">
                <?php if($data_edit && $data_edit['foto']): ?>
                    <small style="color: blue">Foto saat ini: <?php echo $data_edit['foto']; ?></small>
                <?php endif; ?>
            </div>

            <button type="submit" name="simpan" class="btn btn-primary">
                <i class="fas fa-save"></i> <?php echo $data_edit ? "Simpan Perubahan" : "Tambahkan Data"; ?>
            </button>
            <?php if($data_edit): ?>
                <a href="tendik.php" class="btn" style="background: #ccc; width: 100%; text-align: center; margin-top: 5px;">Batal</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="card">
        <h3>Database Tendik Saat Ini</h3>
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama & NIY</th>
                    <th>Jabatan</th>
                    <th>Kontak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $res = mysqli_query($conn, "SELECT * FROM tendik ORDER BY id DESC");
                while ($row = mysqli_fetch_assoc($res)): 
                ?>
                <tr>
                    <td>
                        <?php if(!empty($row['foto']) && file_exists($path_upload . $row['foto'])): ?>
                            <img src="<?php echo $path_upload . $row['foto']; ?>" class="img-preview">
                        <?php else: ?>
                            <i class="fas fa-user-circle fa-2x" style="color: #ccc"></i>
                        <?php endif; ?>
                    </td>
                    <td><strong><?php echo $row['nama_lengkap']; ?></strong><br><small><?php echo $row['niy']; ?></small></td>
                    <td><?php echo $row['jabatan']; ?></td>
                    <td><?php echo $row['email']; ?><br><?php echo $row['no_hp']; ?></td>
                    <td>
                        <a href="?edit=<?php echo $row['id']; ?>" class="btn-edit"><i class="fas fa-edit"></i></a>
                        <a href="?hapus=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Hapus data?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>