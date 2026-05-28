<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direktori Tenaga Kependidikan - SMA YARI SCHOOL</title>
    <link rel="stylesheet" href="/project-web-sekolah/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        html::-webkit-scrollbar { display: none; }
        html { -ms-overflow-style: none; scrollbar-width: none; }

        /* ── HERO ── */
        .dir-hero {
            background: linear-gradient(135deg, #1e7e34 0%, #145a26 60%, #0a3516 100%);
            padding: 22px 0 20px;
            position: relative; overflow: hidden;
        }
        .dir-hero::before {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(circle at 15% 60%, rgba(80,200,100,.12) 0%, transparent 50%),
                              radial-gradient(circle at 85% 20%, rgba(255,255,255,.04) 0%, transparent 40%);
        }
        .dir-hero::after {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(rgba(255,255,255,.06) 1px, transparent 1px);
            background-size: 28px 28px;
        }
        .dir-hero .container { position: relative; z-index: 1; }

        .dir-breadcrumb {
            display: flex; align-items: center; gap: 6px;
            font-size: .82em; color: rgba(255,255,255,.5); margin-bottom: 14px;
        }
        .dir-breadcrumb a { color: rgba(255,255,255,.7); text-decoration: none; }
        .dir-hero-body { display: flex; align-items: center; gap: 20px; }
        .dir-hero-icon { width:64px; height:64px; background:rgba(255,255,255,.1); border:1px solid rgba(255,255,255,.2); border-radius:16px; display:flex; align-items:center; justify-content:center; font-size:1.7rem; color:#fff; }
        .dir-hero-text h1 { font-size: 1.9em; font-weight: 700; color: #fff; margin: 0 0 6px; }
        .dir-hero-text p { color: rgba(255,255,255,.65); font-size: .92em; margin: 0; }
        .dir-hero-badge { margin-left: auto; background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2); color: rgba(255,255,255,.75); font-size: .8em; font-weight: 600; padding: 6px 16px; border-radius: 50px; white-space: nowrap; flex-shrink: 0; }

        /* ── KONTEN ── */
        .dir-content { padding: 28px 0 50px; }
        .dir-toolbar { display: flex; align-items: center; gap: 10px; margin-bottom: 16px; flex-wrap: wrap; }
        .dir-toolbar input { flex: 1; min-width: 220px; border: 1px solid #ddd; border-radius: 5px; padding: 8px 14px; font-size: .9em; }
        .dir-toolbar input:focus { border-color: #1e7e34; box-shadow: 0 0 0 3px rgba(30,126,52,.1); }
        .dir-toolbar button { background: #1e7e34; color: #fff; border: none; border-radius: 5px; padding: 8px 18px; font-weight: 600; cursor: pointer; }
        
        .table-wrap { overflow-x: auto; border-radius: 8px; box-shadow: 0 2px 12px rgba(0,0,0,.08); border: 1px solid #eef0f5; }
        table { width: 100%; border-collapse: collapse; background: #fff; font-size: .9em; }
        thead { background: #f2fff4; }
        thead th { padding: 11px 14px; text-align: left; color: #1e7e34; border-bottom: 2px solid #c3e6cb; }
        tbody tr:hover { background: #f2fff4; }
        tbody td { padding: 10px 14px; vertical-align: middle; }

        /* ── STYLING FOTO (SAMA DENGAN GURU.PHP) ── */
        .img-tendik {
            width: 80px; 
            height: 100px; 
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ddd;
            display: block;
            margin: 0 auto;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .img-tendik:hover { transform: scale(1.05); border-color: #1e7e34; }
        
        .no-img-icon {
            width: 80px; height: 100px;
            background: #f9f9f9;
            display: flex; align-items: center; justify-content: center;
            color: #ddd; font-size: 2em; border: 1px solid #eee; margin: 0 auto;
        }

        /* ── MODAL ZOOM ── */
        .modal-zoom {
            display: none; position: fixed; z-index: 9999; padding-top: 50px;
            left: 0; top: 0; width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.9); cursor: pointer;
        }
        .modal-content-zoom {
            margin: auto; display: block; max-height: 85vh; max-width: 90%;
            border-radius: 8px; animation: zoomIn 0.3s;
        }
        @keyframes zoomIn { from {transform: scale(0.5); opacity: 0;} to {transform: scale(1); opacity: 1;} }
    </style>
</head>
<body>

<?php include '../header-content.php'; ?>

<?php
$search = trim($_GET['q'] ?? '');
$where  = '';
if ($search !== '') {
    $s     = mysqli_real_escape_string($conn, $search);
    $where = "WHERE nama_lengkap LIKE '%$s%' OR niy LIKE '%$s%' OR jabatan LIKE '%$s%'";
}
$result = mysqli_query($conn, "SELECT * FROM `tendik` $where ORDER BY nama_lengkap ASC");
$total  = $result ? mysqli_num_rows($result) : 0;
?>

<div class="dir-hero">
    <div class="container">
        <div class="dir-breadcrumb">
            <a href="/project-web-sekolah/index.php" style="color:white; text-decoration:none;"><i class="fas fa-home"></i> Beranda</a>
            <i class="fas fa-chevron-right" style="font-size:0.7em; margin:0 5px;"></i>
            <span>Direktori</span>
            <i class="fas fa-chevron-right" style="font-size:0.7em; margin:0 5px;"></i>
            <span style="color:white;">Tenaga Kependidikan</span>
        </div>
        <div class="dir-hero-body">
            <div class="dir-hero-icon"><i class="fas fa-users-cog"></i></div>
            <div class="dir-hero-text">
                <h1>Tenaga Kependidikan</h1>
                <p>Daftar seluruh tenaga kependidikan SMA YARI School.</p>
            </div>
            <div class="dir-hero-badge">
                <i class="fas fa-database" style="margin-right:5px;"></i>
                <?php echo $total; ?> Data
            </div>
        </div>
    </div>
</div>

<div class="container dir-content">
    <form method="GET" action="direktori_tendik.php">
        <div class="dir-toolbar">
            <input type="text" name="q" placeholder="Cari nama, NIY, atau jabatan..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit"><i class="fas fa-search"></i> Cari</button>
            <?php if ($search): ?>
            <a href="direktori_tendik.php" class="reset-btn" style="text-decoration:none; color:#666; padding:8px; border:1px solid #ddd; border-radius:5px;"> Reset</a>
            <?php endif; ?>
        </div>
    </form>

    <div class="table-wrap">
    <?php if ($result && $total > 0): ?>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th style="text-align: center;">Foto</th>
                <th>NIY</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>No. HP</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td style="text-align: center;">
                    <?php 
                    $path_foto = "../img_tendik/" . $row['foto'];
                    if (!empty($row['foto']) && file_exists($path_foto)): 
                    ?>
                        <img src="<?php echo $path_foto; ?>" class="img-tendik" onclick="openZoom(this.src)">
                    <?php else: ?>
                        <div class="no-img-icon"><i class="fas fa-user"></i></div>
                    <?php endif; ?>
                </td>
                <td style="font-weight:bold; color:#1e7e34;"><?php echo htmlspecialchars($row['niy'] ?? '-'); ?></td>
                <td><?php echo htmlspecialchars($row['nama_lengkap'] ?? '-'); ?></td>
                <td><?php echo htmlspecialchars($row['jenis_kelamin'] ?? '-'); ?></td>
                <td><?php echo htmlspecialchars($row['jabatan'] ?? '-'); ?></td>
                <td><?php echo htmlspecialchars($row['no_hp'] ?? '-'); ?></td>
                <td><?php echo htmlspecialchars($row['email'] ?? '-'); ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="no-data" style="text-align:center; padding:50px;">
        <i class="fas fa-inbox" style="font-size:3em; color:#ccc;"></i>
        <p>Tidak ada data ditemukan.</p>
    </div>
    <?php endif; ?>
    </div>
</div>

<!-- Modal for Fullscreen Image -->
<div id="photoModal" class="modal-zoom" onclick="this.style.display='none'">
    <img class="modal-content-zoom" id="imgFull">
</div>

<script>
function openZoom(src) {
    const modal = document.getElementById("photoModal");
    const modalImg = document.getElementById("imgFull");
    modal.style.display = "block";
    modalImg.src = src;
}

// Menutup modal dengan tombol Esc
document.addEventListener('keydown', function(event) {
    if (event.key === "Escape") {
        document.getElementById("photoModal").style.display = 'none';
    }
});
</script>

</body>
</html>
