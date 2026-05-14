<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direktori Siswa Aktif - SMA YARI SCHOOL</title>
    <link rel="stylesheet" href="/project-web-sekolah/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        html::-webkit-scrollbar { display: none; }
        html { -ms-overflow-style: none; scrollbar-width: none; }

        /* ── HERO ── */
        .dir-hero {
            background: linear-gradient(135deg, #c68a00 0%, #8a5f00 60%, #4a3200 100%);
            padding: 22px 0 20px;
            position: relative; overflow: hidden;
        }
        .dir-hero::before {
            content: ''; position: absolute; inset: 0;
            background-image:
                radial-gradient(circle at 15% 60%, rgba(255,210,50,.14) 0%, transparent 50%),
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
        .dir-breadcrumb a:hover { color: #fff; text-decoration: underline; }
        .dir-breadcrumb i { font-size: .65em; color: rgba(255,255,255,.4); }
        .dir-breadcrumb .current { color: rgba(255,255,255,.9); }

        .dir-hero-body { display: flex; align-items: center; gap: 20px; }
        .dir-hero-icon { width:64px; height:64px; background:rgba(255,255,255,.1); border:1px solid rgba(255,255,255,.2); border-radius:16px; display:flex; align-items:center; justify-content:center; font-size:1.7rem; color:#fff; }
        .dir-hero-text h1 { font-size: 1.9em; font-weight: 700; color: #fff; margin: 0 0 6px; }
        .dir-hero-text p { color: rgba(255,255,255,.65); font-size: .92em; margin: 0; }

        .dir-hero-badge {
            margin-left: auto;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.2);
            color: rgba(255,255,255,.75);
            font-size: .8em; font-weight: 600;
            padding: 6px 16px; border-radius: 50px;
            white-space: nowrap; flex-shrink: 0;
        }

        /* ── CONTENT ── */
        .dir-content { padding: 28px 0 50px; }
        .dir-toolbar {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 16px; flex-wrap: wrap;
        }
        .dir-toolbar input {
            flex: 1; min-width: 220px; border: 1px solid #ddd;
            border-radius: 5px; padding: 8px 14px;
            font-size: .9em; color: #333; outline: none;
        }
        .dir-toolbar input:focus { border-color: #c68a00; box-shadow: 0 0 0 3px rgba(198,138,0,.1); }
        .dir-toolbar button {
            background: #c68a00; color: #fff; border: none;
            border-radius: 5px; padding: 8px 18px;
            font-size: .88em; font-weight: 600; cursor: pointer;
        }
        .dir-toolbar button:hover { background: #a87200; }
        .dir-toolbar a.reset-btn {
            color: #666; font-size: .85em; text-decoration: none;
            padding: 8px 14px; border: 1px solid #ddd; border-radius: 5px;
        }
        .dir-toolbar a.reset-btn:hover { background: #f5f5f5; }

        .dir-stat { font-size: .85em; color: #888; margin-bottom: 14px; }
        .dir-stat strong { color: #555; }

        .table-wrap {
            overflow-x: auto; border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0,0,0,.08); border: 1px solid #eef0f5;
        }
        table { width: 100%; border-collapse: collapse; background: #fff; font-size: .9em; }
        thead { background: #fffbea; }
        thead th {
            padding: 11px 14px; text-align: left; font-size: .8em;
            font-weight: 700; text-transform: uppercase; letter-spacing: .04em;
            color: #8a5f00; border-bottom: 2px solid #ffe88a; white-space: nowrap;
        }
        tbody tr { border-bottom: 1px solid #f2f4f8; transition: background .12s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #fffbea; }
        tbody td { padding: 10px 14px; color: #333; vertical-align: middle; }
        tbody td:first-child { font-weight: 700; color: #c68a00; width: 44px; text-align: center; }

        /* Photo column */
        thead th:nth-child(3) { width: 70px; text-align: center; }
        tbody td:nth-child(3) { text-align: center; }

        .img-siswa {
            width: 50px; height: 60px;
            object-fit: cover; object-position: center;
            border-radius: 4px; border: 1px solid #ddd;
            cursor: pointer;
            transition: transform .2s, box-shadow .2s;
        }
        .img-siswa:hover { transform: scale(1.08); box-shadow: 0 4px 12px rgba(0,0,0,.2); }

        .no-photo-icon {
            width: 50px; height: 60px;
            display: flex; align-items: center; justify-content: center;
            background: #f5f5f5; border-radius: 4px; color: #ccc;
            margin: auto;
        }

        .no-data { text-align:center; padding: 50px; color: #aaa; }
        .no-data i { font-size: 2.2rem; display:block; margin-bottom:10px; color:#ccc; }

        /* ── LIGHTBOX ── */
        #lightbox {
            display: none; position: fixed; inset: 0; z-index: 9999;
            background: rgba(0,0,0,.85);
            align-items: center; justify-content: center;
            backdrop-filter: blur(4px);
        }
        #lightbox.active { display: flex; }
        #lightbox img {
            max-width: 90vw; max-height: 85vh;
            border-radius: 10px;
            box-shadow: 0 8px 40px rgba(0,0,0,.6);
            animation: zoomIn .2s ease;
        }
        #lightbox .lb-name {
            position: absolute; bottom: 30px;
            color: #fff; font-size: 1em; font-weight: 600;
            background: rgba(0,0,0,.45); padding: 6px 18px;
            border-radius: 50px; letter-spacing: .03em;
        }
        #lightbox .close-btn {
            position: absolute; top: 20px; right: 28px;
            color: #fff; font-size: 2.2rem; cursor: pointer;
            line-height: 1; opacity: .8;
        }
        #lightbox .close-btn:hover { opacity: 1; }
        @keyframes zoomIn {
            from { transform: scale(.7); opacity: 0; }
            to   { transform: scale(1);  opacity: 1; }
        }
    </style>
</head>
<body>

<?php include '../header-content.php'; ?>

<?php
$search = trim($_GET['q'] ?? '');
$where  = '';
if ($search !== '') {
    $s     = mysqli_real_escape_string($conn, $search);
    $where = "WHERE nama_lengkap LIKE '%$s%' OR nis LIKE '%$s%' OR kelas LIKE '%$s%'";
}
$result = mysqli_query($conn, "SELECT * FROM `siswa_aktif` $where ORDER BY nama_lengkap ASC");
$total  = $result ? mysqli_num_rows($result) : 0;
?>

<div class="dir-hero">
    <div class="container">
        <div class="dir-breadcrumb">
            <a href="/project-web-sekolah/index.php"><i class="fas fa-home"></i> Beranda</a>
            <i class="fas fa-chevron-right"></i>
            <span>Direktori</span>
            <i class="fas fa-chevron-right"></i>
            <span class="current">Siswa Aktif</span>
        </div>
        <div class="dir-hero-body">
            <div class="dir-hero-icon"><i class="fas fa-user-graduate"></i></div>
            <div class="dir-hero-text">
                <h1>Siswa Aktif</h1>
                <p>Daftar seluruh siswa aktif SMA YARI School.</p>
            </div>
            <div class="dir-hero-badge">
                <i class="fas fa-database" style="margin-right:5px;"></i>
                <?php echo $total; ?> Data
            </div>
        </div>
    </div>
</div>

<div class="container dir-content">
    <form method="GET" action="direktori_siswa.php">
        <div class="dir-toolbar">
            <input type="text" name="q" placeholder="Cari nama, NIS, atau kelas..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit"><i class="fas fa-search"></i> Cari</button>
            <?php if ($search): ?>
            <a href="direktori_siswa.php" class="reset-btn"><i class="fas fa-times"></i> Reset</a>
            <?php endif; ?>
        </div>
    </form>

    <div class="dir-stat">
        Menampilkan <strong><?php echo $total; ?></strong> data
        <?php if ($search): ?>&nbsp;&mdash;&nbsp;hasil pencarian: <strong>"<?php echo htmlspecialchars($search); ?>"</strong><?php endif; ?>
    </div>

    <div class="table-wrap">
    <?php if ($result && $total > 0): ?>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>NIS</th>
                <th>Foto</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>Kelas</th>
                <th>Tahun Masuk</th>
                <th>No. HP</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
            <?php
                $image_path = "../admin/img_siswa/" . ($row['foto'] ?? '');
                $has_image  = !empty($row['foto']) && file_exists($image_path);
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['nis'] ?? '-'); ?></td>
                <td>
                    <?php if ($has_image): ?>
                        <img src="<?php echo htmlspecialchars($image_path); ?>"
                             alt="Foto <?php echo htmlspecialchars($row['nama_lengkap']); ?>"
                             class="img-siswa"
                             onclick="openLightbox(this.src, '<?php echo htmlspecialchars($row['nama_lengkap']); ?>')">
                    <?php else: ?>
                        <div class="no-photo-icon">
                            <i class="fas fa-user-circle fa-2x"></i>
                        </div>
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($row['nama_lengkap'] ?? '-'); ?></td>
                <td><?php echo htmlspecialchars($row['jenis_kelamin'] ?? '-'); ?></td>
                <td><?php echo htmlspecialchars($row['kelas'] ?? '-'); ?></td>
                <td><?php echo htmlspecialchars($row['tahun_masuk'] ?? '-'); ?></td>
                <td><?php echo htmlspecialchars($row['no_hp'] ?? '-'); ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="no-data">
        <i class="fas fa-inbox"></i>
        <p>Tidak ada data ditemukan.</p>
    </div>
    <?php endif; ?>
    </div>
</div>

<!-- Lightbox Overlay -->
<div id="lightbox">
    <span class="close-btn" onclick="closeLightbox()">&times;</span>
    <img id="lightbox-img" src="" alt="Foto Siswa">
    <span class="lb-name" id="lightbox-name"></span>
</div>

<script>
function openLightbox(src, name) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox-name').textContent = name;
    document.getElementById('lightbox').classList.add('active');
}
function closeLightbox() {
    document.getElementById('lightbox').classList.remove('active');
    document.getElementById('lightbox-img').src = '';
}
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) closeLightbox();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeLightbox();
});
</script>

</body>
</html>