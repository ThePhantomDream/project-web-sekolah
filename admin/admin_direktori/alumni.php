<?php 
include '../../koneksi.php';

// Tentukan path upload foto alumni
$path_upload = "../../img_alumni/";

// Buat folder jika belum ada
if (!is_dir($path_upload)) {
    mkdir($path_upload, 0777, true);
}

$message = "";

// --- 1. LOGIKA PROSES (TAMBAH / EDIT / HAPUS) ---

// A. Logika Hapus Data
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);
    
    // Ambil nama file foto lama untuk dihapus dari server
    $cek_foto = mysqli_query($conn, "SELECT foto FROM alumni WHERE id = '$id'");
    $f = mysqli_fetch_assoc($cek_foto);
    if (!empty($f['foto']) && file_exists($path_upload . $f['foto'])) {
        unlink($path_upload . $f['foto']);
    }

    mysqli_query($conn, "DELETE FROM alumni WHERE id = '$id'");
    header("Location: alumni.php?pesan=dihapus");
    exit;
}

// B. Logika Simpan Data (Tambah & Update)
if (isset($_POST['action'])) {
    $action             = $_POST['action'];
    $nis                = mysqli_real_escape_string($conn, $_POST['nis']);
    $nama_lengkap       = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $jenis_kelamin      = $_POST['jenis_kelamin'];
    
    // PERBAIKAN UTAMA: Ambil nilai mentah $_POST lalu paksa konversi ke tipe data Integer murni (int)
    // Hal ini agar kolom bertipe data YEAR di MySQL menerima angka murni, bukan string teks.
    $tahun_masuk        = !empty($_POST['tahun_masuk']) ? (int)$_POST['tahun_masuk'] : 0;
    $tahun_lulus        = !empty($_POST['tahun_lulus']) ? (int)$_POST['tahun_lulus'] : 0;
    
    $no_hp              = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $aktivitas_sekarang = mysqli_real_escape_string($conn, $_POST['aktivitas_sekarang']);

    // Validasi Tahun (Harus 4 Digit Angka yang masuk akal untuk format YEAR MySQL)
    if ($tahun_masuk < 1901 || $tahun_masuk > 2155 || $tahun_lulus < 1901 || $tahun_lulus > 2155 || $tahun_lulus <= $tahun_masuk) {
        $message = "<div class='alert error'>Tahun Masuk dan Tahun Lulus harus berupa 4 digit angka valid dari 1901 hingga 2155, dan Tahun Lulus harus lebih besar dari Tahun Masuk.</div>";
    } else {
        $duplicateNis = false;
        if ($action == 'tambah') {
            $cekNis = mysqli_query($conn, "SELECT id FROM alumni WHERE nis='$nis'");
            if ($cekNis && mysqli_num_rows($cekNis) > 0) {
                $duplicateNis = true;
                $message = "<div class='alert error'>NIS '$nis' sudah terdaftar. Silakan gunakan NIS lain.</div>";
            }
        } elseif ($action == 'edit') {
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $cekNis = mysqli_query($conn, "SELECT id FROM alumni WHERE nis='$nis' AND id != '$id'");
            if ($cekNis && mysqli_num_rows($cekNis) > 0) {
                $duplicateNis = true;
                $message = "<div class='alert error'>NIS '$nis' sudah digunakan oleh data alumni lain.</div>";
            }
        }

        if (!$duplicateNis) {
            // Urusan Upload Foto
            $foto_name = $_FILES['foto']['name'];
            $foto_tmp  = $_FILES['foto']['tmp_name'];
            $nama_foto_baru = "";
            
            if (!empty($foto_name)) {
                $ekstensi = pathinfo($foto_name, PATHINFO_EXTENSION);
                $nama_foto_baru = "alumni_" . time() . "." . $ekstensi;
                $tujuan = $path_upload . $nama_foto_baru;

                if (move_uploaded_file($foto_tmp, $tujuan)) {
                    // Jika mode UPDATE/EDIT, hapus foto fisik yang lama
                    if ($action == 'edit') {
                        $id = $_POST['id'];
                        $lama = mysqli_query($conn, "SELECT foto FROM alumni WHERE id = '$id'");
                        $fl = mysqli_fetch_assoc($lama);
                        if (!empty($fl['foto']) && file_exists($path_upload . $fl['foto'])) {
                            unlink($path_upload . $fl['foto']);
                        }
                    }
                }
            }

            if ($action == 'tambah') {
                // PERBAIKAN: Nilai integer $tahun_masuk dan $tahun_lulus dimasukkan langsung TANPA tanda petik tunggal ('')
                $query = "INSERT INTO alumni (nis, nama_lengkap, jenis_kelamin, tahun_masuk, tahun_lulus, no_hp, aktivitas_sekarang, foto) 
                          VALUES ('$nis', '$nama_lengkap', '$jenis_kelamin', $tahun_masuk, $tahun_lulus, '$no_hp', '$aktivitas_sekarang', '$nama_foto_baru')";
            } elseif ($action == 'edit') {
                // PROSES UPDATE
                $id = $_POST['id'];
                $old_foto = $_POST['old_foto'];
                
                if (empty($foto_name)) {
                    $nama_foto_baru = $old_foto;
                }

                // PERBAIKAN: Klausa SET untuk tahun_masuk dan tahun_lulus juga dilepas dari tanda petik tunggal ('')
                $query = "UPDATE alumni SET 
                            nis='$nis', 
                            nama_lengkap='$nama_lengkap', 
                            jenis_kelamin='$jenis_kelamin', 
                            tahun_masuk=$tahun_masuk,
                            tahun_lulus=$tahun_lulus, 
                            no_hp='$no_hp', 
                            aktivitas_sekarang='$aktivitas_sekarang', 
                            foto='$nama_foto_baru' 
                          WHERE id='$id'";
            }
        }
    }

        if (isset($duplicateNis) && $duplicateNis === false) {
            if (mysqli_query($conn, $query)) {
                $message = "<div class='alert success'><i class='fas fa-check-circle'></i> Data alumni berhasil disimpan!</div>";
            } else {
                $message = "<div class='alert error'>Gagal: " . mysqli_error($conn) . "</div>";
            }
        }
    }

// --- 2. LOGIKA AMBIL & PENCARIAN DATA ---
$search = trim($_GET['q'] ?? '');
$where  = $search ? "WHERE nama_lengkap LIKE '%$search%' OR nis LIKE '%$search%' OR tahun_lulus LIKE '%$search%' OR aktivitas_sekarang LIKE '%$search%'" : "";
$result = mysqli_query($conn, "SELECT * FROM alumni $where ORDER BY tahun_lulus DESC, nama_lengkap ASC");
$total  = $result ? mysqli_num_rows($result) : 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Kelola Data Alumni</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; margin: 0; padding: 20px; }
        .container { max-width: 1200px; margin: auto; background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        h2 { color: #6c757d; border-bottom: 2px solid #e2e6ea; padding-bottom: 10px; margin-top: 10px; }
        
        /* Form Styling (Tema Grey/Secondary Alumni sesuai Dashboard) */
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px; margin-bottom: 20px; background: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #e2e6ea; }
        input, select { padding: 10px; border: 1px solid #ddd; border-radius: 5px; width: 100%; box-sizing: border-box; font-size: 0.9em; }
        input:focus, select:focus { border-color: #6c757d; outline: none; }
        .btn { padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: 600; }
        .btn-add { background: #6c757d; color: white; transition: 0.3s; }
        .btn-add:hover { background: #5a6268; }
       
        /* Action Buttons */
        .btn-edit { background: #2980b9; color: white; font-size: 0.9em; padding: 6px 12px; border-radius: 5px; border: none; cursor: pointer; }
        .btn-del  { background: #c0392b; color: white; font-size: 0.9em; text-decoration: none; padding: 6px 12px; border-radius: 5px; display: inline-block; }
        
        /* Search Box Toolbar */
        .dir-toolbar { display: flex; align-items: center; gap: 10px; margin-bottom: 16px; flex-wrap: wrap; }
        .dir-search-box { display: flex; flex: 1; min-width: 220px; }
        .dir-search-box input { border-top-right-radius: 0; border-bottom-right-radius: 0; }
        .dir-search-box button { background: #6c757d; color: #fff; border: none; border-top-right-radius: 5px; border-bottom-right-radius: 5px; padding: 8px 18px; font-size: .88em; font-weight: 600; cursor: pointer; white-space: nowrap; }
        .dir-search-box button:hover { background: #5a6268; }
        .dir-toolbar a.cancel-btn { background-color: #dc3545; color: #fff; font-size: .88em; font-weight: 600; text-decoration: none; padding: 8px 18px; border-radius: 5px; display: inline-flex; align-items: center; gap: 6px; height: 38px; box-sizing: border-box; transition: background-color 0.12s; }
        .dir-toolbar a.cancel-btn:hover { background-color: #bd2130; }

        /* Table Styling */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 0.9em; }
        th { background: #f8f9fa; color: #495057; padding: 12px; text-align: left; border-bottom: 2px solid #e2e6ea; }
        td { padding: 10px; border-bottom: 1px solid #eee; vertical-align: middle; }
        .img-admin { width: 50px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd; }
        
        /* Alert Info */
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; border-left: 5px solid #28a745; }
        .error { background: #f8d7da; color: #721c24; border-left: 5px solid #dc3545; }
        .dir-stat { font-size: .85em; color: #888; margin-bottom: 14px; }
        .no-data { text-align:center; padding: 40px; color: #aaa; }
    </style>
</head>
<body>

<div class="container">
    <h2><i class="fas fa-user-check"></i> Kelola Data Alumni</h2>
    <a href="../index.php" style="text-decoration:none; color:#666; font-size:0.9em;"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
    
    <div style="margin-top: 15px;">
        <?php echo $message; ?>
        <?php if (empty($message) && isset($_GET['pesan']) && $_GET['pesan'] == 'dihapus'): ?>
            <div class="alert success"><i class="fas fa-check-circle"></i> Data alumni berhasil dihapus!</div>
        <?php endif; ?>
    </div>

    <div class="card-form" style="margin-top: 10px;">
        <h3 id="form-title" style="color: #495057; margin-bottom: 10px;"><i class="fas fa-plus-circle"></i> Tambah Alumni Baru</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="form-id">
            <input type="hidden" name="old_foto" id="form-old-foto">
            <input type="hidden" name="action" value="tambah" id="form-action">
            
            <div class="form-grid">
                <input type="text" name="nis" id="form-nis" placeholder="NIS" required>
                <input type="text" name="nama_lengkap" id="form-nama" placeholder="Nama Lengkap" required>
                <select name="jenis_kelamin" id="form-jk" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <input type="text" name="tahun_masuk" id="form-thn-masuk" placeholder="Thn Masuk (Ex: 2019)" pattern="[0-9]{4}" maxlength="4" required>
                <input type="text" name="tahun_lulus" id="form-thn-lulus" placeholder="Thn Lulus (Ex: 2022)" pattern="[0-9]{4}" maxlength="4" required>
                <input type="tel" name="no_hp" id="form-hp" placeholder="No. HP" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                <input type="text" name="aktivitas_sekarang" id="form-aktivitas" placeholder="Aktivitas (Contoh: Mahasiswa UI / Kerja)">
                <div style="display: flex; flex-direction: column; gap: 2px;">
                    <input type="file" name="foto" accept="image/*">
                    <small id="edit-photo-hint" style="color: #888; display: none; font-size: 0.75em;">Kosongkan jika tidak mengubah foto</small>
                </div>
                <button type="submit" class="btn btn-add" id="btn-submit">Tambah Data</button>
            </div>
        </form>
    </div>

    <form method="GET" action="index.php">
        <div class="dir-toolbar">
            <div class="dir-search-box">
                <input type="text" name="q" placeholder="Cari nama, NIS, tahun lulus, atau aktivitas..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit"><i class="fas fa-search"></i> Cari</button>
            </div>
            <?php if ($search): ?>
            <a href="index.php" class="cancel-btn"><i class="fas fa-times"></i> Cancel</a>
            <?php endif; ?>
        </div>
    </form>

    <div class="dir-stat">
        Menampilkan <strong><?php echo $total; ?></strong> data alumni yang ditemukan.
    </div>

    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>NIS</th>
                <th>Nama Lengkap</th>
                <th>Gender</th>
                <th>Tahun Masuk</th>
                <th>Tahun Lulus</th>
                <th>Nomor HP</th>
                <th>Aktivitas Sekarang</th>
                <th style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($total > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td>
                        <?php if(!empty($row['foto']) && file_exists($path_upload . $row['foto'])): ?>
                            <img src="<?php echo $path_upload . $row['foto']; ?>" class="img-admin">
                        <?php else: ?>
                            <i class="fas fa-user-circle fa-2x" style="color:#ccc"></i>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['nis']); ?></td>
                    <td><strong><?php echo htmlspecialchars($row['nama_lengkap']); ?></strong></td>
                    <td><?php echo $row['jenis_kelamin'] == 'Laki-laki' ? 'L' : 'P'; ?></td>
                    <td><span style="background: #e9ecef; color: #495057; padding: 3px 8px; border-radius: 4px; font-weight: bold;"><?php echo htmlspecialchars($row['tahun_masuk']); ?></span></td>
                    <td><span style="background: #e9ecef; color: #495057; padding: 3px 8px; border-radius: 4px; font-weight: bold;"><?php echo htmlspecialchars($row['tahun_lulus']); ?></span></td>
                    <td><?php echo htmlspecialchars($row['no_hp'] ?: '-'); ?></td>
                    <td><?php echo htmlspecialchars($row['aktivitas_sekarang'] ?: '-'); ?></td>
                    <td style="text-align: center; white-space: nowrap;">
                        <button class="btn btn-edit" onclick="editData(<?php echo htmlspecialchars(json_encode($row)); ?>)" title="Edit"><i class="fas fa-edit"></i></button>
                        <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-del" onclick="return confirm('Yakin ingin menghapus data alumni ini?')" title="Hapus"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="no-data">
                        <i class="fas fa-inbox fa-2x" style="display:block; margin-bottom:10px; color:#ccc;"></i>
                        Tidak ada data alumni ditemukan.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
function editData(data) {
    document.getElementById('form-id').value = data.id;
    document.getElementById('form-nis').value = data.nis;
    document.getElementById('form-nama').value = data.nama_lengkap;
    document.getElementById('form-jk').value = data.jenis_kelamin;
    document.getElementById('form-thn-masuk').value = data.tahun_masuk;
    document.getElementById('form-thn-lulus').value = data.tahun_lulus;
    document.getElementById('form-hp').value = data.no_hp ? data.no_hp : '';
    document.getElementById('form-aktivitas').value = data.aktivitas_sekarang;
    document.getElementById('form-old-foto').value = data.foto ? data.foto : '';
    
    // Switch Form ke Mode Edit
    document.getElementById('form-action').value = 'edit';
    document.getElementById('form-title').innerHTML = "<i class='fas fa-edit'></i> Edit Data Alumni: " + data.nama_lengkap;
    document.getElementById('edit-photo-hint').style.display = 'block';
    
    document.getElementById('btn-submit').innerText = 'Update Data';
    document.getElementById('btn-submit').style.background = '#2980b9';
    
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Auto-hide alert messages after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.display = 'none';
        }, 5000);
    });
});
</script>
</body>
</html>