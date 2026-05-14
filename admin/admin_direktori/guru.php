<?php 
include '../../koneksi.php'; 

// Tentukan satu path folder yang konsisten
$path_upload = "../../img_guru/";

// 1. LOGIKA PROSES (TAMBAH / EDIT / HAPUS)
$notif = "";

// A. Logika Hapus Data
if (isset($_GET['hapus'])) {
    $id = mysqli_real_escape_string($conn, $_GET['hapus']);
    
    // Ambil nama file foto lama untuk dihapus dari folder
    $cek_foto = mysqli_query($conn, "SELECT foto FROM guru WHERE id = '$id'");
    $f = mysqli_fetch_assoc($cek_foto);
    if (!empty($f['foto']) && file_exists($path_upload . $f['foto'])) {
        unlink($path_upload . $f['foto']);
    }

    mysqli_query($conn, "DELETE FROM guru WHERE id = '$id'");
    header("Location: admin_direktori_guru.php?pesan=dihapus");
}

// B. Logika Simpan Data (Tambah & Update)
if (isset($_POST['simpan'])) {
    $id = $_POST['id'] ?? '';
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $jk = $_POST['jenis_kelamin'];
    $mapel = mysqli_real_escape_string($conn, $_POST['mata_pelajaran']);

    // Urusan Upload Foto
    $foto_name = $_FILES['foto']['name'];
    $foto_tmp  = $_FILES['foto']['tmp_name'];
    $nama_foto_baru = "";
    
    if (!empty($foto_name)) {
        $ekstensi = pathinfo($foto_name, PATHINFO_EXTENSION);
        $nama_foto_baru = "guru_" . time() . "." . $ekstensi;
        $tujuan = $path_upload . $nama_foto_baru;

        if (move_uploaded_file($foto_tmp, $tujuan)) {
            // Jika update, hapus foto lama
            if (!empty($id)) {
                $lama = mysqli_query($conn, "SELECT foto FROM guru WHERE id = '$id'");
                $fl = mysqli_fetch_assoc($lama);
                if (!empty($fl['foto']) && file_exists($path_upload . $fl['foto'])) {
                    unlink($path_upload . $fl['foto']);
                }
            }
            $query_foto = ", foto = '$nama_foto_baru'";
        }
    } else {
        $query_foto = "";
    }

    if (empty($id)) {
        // INSERT
        $sql = "INSERT INTO guru (nip, nama_lengkap, jenis_kelamin, mata_pelajaran, foto) 
                VALUES ('$nip', '$nama', '$jk', '$mapel', '$nama_foto_baru')";
    } else {
        // UPDATE
        $sql = "UPDATE guru SET nip='$nip', nama_lengkap='$nama', jenis_kelamin='$jk', 
                mata_pelajaran='$mapel' $query_foto WHERE id='$id'";
    }

    if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Data berhasil disimpan!');
            window.location.href = 'guru.php?pesan=berhasil';
          </script>";
    exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
};
    // C. Ambil data untuk Edit
$data_edit = null;
if (isset($_GET['edit'])) {
    $id_edit = mysqli_real_escape_string($conn, $_GET['edit']);
    $res_edit = mysqli_query($conn, "SELECT * FROM guru WHERE id = '$id_edit'");
    $data_edit = mysqli_fetch_assoc($res_edit);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Guru</title>
    <link rel="stylesheet" href="/project-web-sekolah/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-wrap { padding: 30px; background: #f9f9f9; min-height: 100vh; font-family: sans-serif; }
        .card { background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 25px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 5px; color: #555; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        
        .btn { padding: 10px 20px; border-radius: 6px; border: none; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-block; }
        .btn-primary { background: #c0392b; color: #fff; width: 100%; transition: 0.3s; }
        .btn-primary:hover { background: #a93226; }
        .btn-edit { background: #f39c12; color: #fff; font-size: 0.8em; margin-right: 5px; }
        .btn-delete { background: #e74c3c; color: #fff; font-size: 0.8em; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table th { background: #f2f2f2; padding: 12px; text-align: left; border-bottom: 2px solid #ddd; color: #c0392b; font-size: 0.85em; text-transform: uppercase; }
        table td { padding: 12px; border-bottom: 1px solid #eee; font-size: 0.9em; vertical-align: middle; }

        .img-preview { width: 50px; height: 65px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd; display: block; }
        .alert { padding: 10px; background: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 15px; border-left: 5px solid #28a745; }
        
        .header-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .header-top h2 { margin: 0; }
    </style>
</head>
<body>

<div class="admin-wrap">
    <div class="header-top">
        <h2><i class="fas fa-user-cog"></i> Kelola Data Guru</h2>
        <a href="index.php" class="btn btn-delete" style="display:inline-flex; align-items:center; gap:8px;">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    <hr style="margin-bottom: 20px; opacity: 0.2;">

    <?php if (isset($_GET['pesan'])): ?>
        <div class="alert">
            <i class="fas fa-check-circle"></i> Operasi database berhasil dilakukan!
        </div>
    <?php endif; ?>

    <!-- FORM INPUT / EDIT -->
    <div class="card">
        <h3><?php echo $data_edit ? "Edit Data Guru" : "Tambah Guru Baru"; ?></h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $data_edit['id'] ?? ''; ?>">
            
            <div class="form-grid">
                <div class="form-group">
                    <label>NIY / NIP</label>
                    <input type="text" name="nip" value="<?php echo $data_edit['nip'] ?? ''; ?>" required placeholder="Contoh: 1980...">
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="<?php echo $data_edit['nama_lengkap'] ?? ''; ?>" required placeholder="Nama dan Gelar">
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki" <?php echo (isset($data_edit) && $data_edit['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                        <option value="Perempuan" <?php echo (isset($data_edit) && $data_edit['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mata Pelajaran</label>
                    <select name="mata_pelajaran" required>
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        <?php
                        $mapel_list = [
                            "Matematika", "Bahasa Indonesia", "Bahasa Inggris", 
                            "Fisika", "Kimia", "Biologi", "Ekonomi", 
                            "Geografi", "Sosiologi", "Sejarah", "Pkn", 
                            "PAI", "PJOK", "Seni Budaya", "TIK", "Bahasa Jepang"
                        ];
                        
                        foreach ($mapel_list as $mp) {
                            $selected = (isset($data_edit) && $data_edit['mata_pelajaran'] == $mp) ? 'selected' : '';
                            echo "<option value=\"$mp\" $selected>$mp</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label>Foto Guru</label>
                <?php if($data_edit && !empty($data_edit['foto'])): ?>
                    <div style="margin-bottom: 10px;">
                        <small>Foto saat ini:</small><br>
                        <img src="<?php echo $path_upload . $data_edit['foto']; ?>" style="width: 60px; border-radius: 4px;">
                    </div>
                <?php endif; ?>
                <input type="file" name="foto" accept="image/*">
                <small style="color: #888;">Format: JPG/PNG, Maks 2MB. Kosongkan jika tidak ingin mengubah foto.</small>
            </div>

            <button type="submit" name="simpan" class="btn btn-primary">
                <i class="fas fa-save"></i> <?php echo $data_edit ? "Update Data Guru" : "Simpan Data Guru"; ?>
            </button>
            
            <?php if($data_edit): ?>
                <a href="admin_direktori_guru.php" style="display:block; text-align:center; margin-top:15px; color:#c0392b; font-size: 0.9em;">
                    <i class="fas fa-times"></i> Batal Edit & Kembali
                </a>
            <?php endif; ?>
        </form>
    </div>

    <!-- TABEL DATA -->
    <div class="card" style="overflow-x: auto;">
        <h3>Daftar Guru Terdaftar</h3>
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>NIY/NIP</th>
                    <th>Mapel</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql_list = mysqli_query($conn, "SELECT * FROM guru ORDER BY id DESC");
                if(mysqli_num_rows($sql_list) > 0):
                    while ($g = mysqli_fetch_assoc($sql_list)): 
                ?>
                <tr>
                    <td>
                        <?php if(!empty($g['foto']) && file_exists($path_upload . $g['foto'])): ?>
                            <img src="<?php echo $path_upload . $g['foto']; ?>" class="img-preview">
                        <?php else: ?>
                            <div style="width:50px; height:65px; background:#eee; display:flex; align-items:center; justify-content:center; border-radius:4px;">
                                <i class="fas fa-user" style="color:#ccc"></i>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td><strong><?php echo htmlspecialchars($g['nama_lengkap']); ?></strong></td>
                    <td><?php echo htmlspecialchars($g['nip']); ?></td>
                    <td><span style="background: #fff5f5; color: #c0392b; padding: 2px 8px; border-radius: 4px; font-size: 0.85em;"><?php echo htmlspecialchars($g['mata_pelajaran']); ?></span></td>
                    <td style="text-align: center; white-space: nowrap;">
                        <a href="?edit=<?php echo $g['id']; ?>" class="btn btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                        <a href="?hapus=<?php echo $g['id']; ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus data ini? Foto juga akan terhapus dari server.')" title="Hapus"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php 
                    endwhile; 
                else:
                ?>
                <tr>
                    <td colspan="5" style="text-align:center; padding: 30px; color: #aaa;">Belum ada data guru.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>