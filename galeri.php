<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - SMA YARI SCHOOL</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f5f7fa; margin: 0; }

        /* ── HERO ── */
        .page-hero {
            background: linear-gradient(135deg, #2c3e50 0%, #1a2535 60%, #0d1520 100%);
            padding: 40px 0; position: relative; overflow: hidden;
        }
        .page-hero::before { content:''; position:absolute; inset:0;
            background-image: radial-gradient(circle at 15% 60%, rgba(100,150,255,.10) 0%, transparent 50%); }
        
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; position: relative; z-index: 1; }
        
        .page-breadcrumb { display:flex; align-items:center; gap:6px; font-size:.82em; color:rgba(255,255,255,.5); margin-bottom:14px; }
        .page-breadcrumb a { color:rgba(255,255,255,.7); text-decoration:none; }
        .page-hero-body { display:flex; align-items:center; gap:20px; }
        .page-hero-icon { width:64px; height:64px; background:rgba(255,255,255,.1); border:1px solid rgba(255,255,255,.2); border-radius:16px; display:flex; align-items:center; justify-content:center; font-size:1.7rem; color:#fff; }
        .page-hero-text h1 { font-size:1.9em; color:#fff; margin:0; }
        .page-hero-text p { color:rgba(255,255,255,.6); margin: 5px 0 0; }
        .page-hero-badge { margin-left:auto; background:rgba(255,255,255,.1); padding:8px 16px; border-radius:50px; color:#fff; font-size:.85em; }

        /* ── CONTENT ── */
        .galeri-wrap { max-width:1200px; margin:40px auto; padding:0 20px; }
        .filter-bar { display:flex; gap:10px; margin-bottom:30px; flex-wrap: wrap; }
        .filter-btn { padding:8px 20px; border-radius:50px; border:1px solid #ddd; background:#fff; cursor:pointer; font-weight:600; transition: 0.3s; }
        .filter-btn.active { background:#2c3e50; color:#fff; border-color:#2c3e50; }

        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px; }
        .gallery-card { background:#fff; border-radius:15px; overflow:hidden; box-shadow:0 10px 20px rgba(0,0,0,0.05); transition: 0.3s; cursor:pointer; }
        .gallery-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
        .gallery-card.hide { display: none; }

        .image-box { position:relative; height:230px; }
        .image-box img { width:100%; height:100%; object-fit:cover; }
        .cat-tag { position:absolute; top:15px; left:15px; background:rgba(0,0,0,0.6); color:#fff; padding:4px 12px; border-radius:50px; font-size:0.75em; backdrop-filter: blur(4px); }

        .info-box { padding:20px; }
        .info-box h3 { margin:0 0 8px; font-size:1.1em; color:#2c3e50; }
        .info-box p { margin:0; color:#7f8c8d; font-size:0.9em; line-height:1.6; }

        /* ── LIGHTBOX ── */
        .lightbox-overlay { position:fixed; inset:0; background:rgba(0,0,0,0.9); display:none; justify-content:center; align-items:center; z-index:9999; }
        .lightbox-overlay.open { display:flex; }
        .lightbox-inner { position:relative; max-width:90%; }
        .lightbox-inner img { max-height:80vh; border-radius:10px; }
        .lightbox-close { position:absolute; top:-50px; right:0; color:#fff; font-size:2em; background:none; border:none; cursor:pointer; }
    </style>
</head>
<body>

<?php include 'header-content.php'; ?>

<div class="page-hero">
    <div class="container">
        <div class="page-breadcrumb">
            <a href="index.php"><i class="fas fa-home"></i> Beranda</a>
            <i class="fas fa-chevron-right" style="font-size: 0.7em;"></i>
            <span>Galeri</span>
        </div>
        <div class="page-hero-body">
            <div class="page-hero-icon"><i class="fas fa-images"></i></div>
            <div class="page-hero-text">
                <h1>Galeri Sekolah</h1>
                <p>Dokumentasi kegiatan SMA YARI SCHOOL</p>
            </div>
            <?php
            $count_query = mysqli_query($conn, "SELECT COUNT(*) FROM galeri");
            $total_foto = mysqli_fetch_row($count_query)[0];
            ?>
            <div class="page-hero-badge">
                <i class="fas fa-camera"></i> <?php echo $total_foto; ?> Foto
            </div>
        </div>
    </div>
</div>

<?php
// Query utama
$result = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
// Query kategori untuk tombol filter
$cat_rows = mysqli_query($conn, "SELECT DISTINCT kategori FROM galeri ORDER BY kategori");
?>

<div class="galeri-wrap">
    <div class="filter-bar">
        <button class="filter-btn active" onclick="filterGaleri('all', this)">Semua</button>
        <?php if ($cat_rows): ?>
            <?php while ($c = mysqli_fetch_assoc($cat_rows)): ?>
                <button class="filter-btn" onclick="filterGaleri('<?php echo htmlspecialchars($c['kategori']); ?>', this)">
                    <?php echo htmlspecialchars($c['kategori']); ?>
                </button>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

    <div class="gallery-grid" id="galleryGrid">
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): 
                // PERBAIKAN PATH: Mengarah ke folder admin/store_galeri
                $img_path = "../project-web-sekolah/store_galeri/" . htmlspecialchars($row['gambar']);
                $clean_judul = htmlspecialchars(addslashes($row['judul']));
            ?>
            <div class="gallery-card filter-item <?php echo htmlspecialchars($row['kategori']); ?>"
                 onclick="openLightbox('<?php echo $img_path; ?>', '<?php echo $clean_judul; ?>')">
                <div class="image-box">
                    <span class="cat-tag"><?php echo htmlspecialchars($row['kategori']); ?></span>
                    <img src="<?php echo $img_path; ?>" alt="" loading="lazy">
                </div>
                <div class="info-box">
                    <h3><?php echo htmlspecialchars($row['judul']); ?></h3>
                    <p><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-data" style="grid-column: 1/-1; text-align: center; padding: 50px;">
                <i class="fas fa-image-slash" style="font-size: 3em; color: #ccc;"></i>
                <p style="color: #999; margin-top: 15px;">Belum ada koleksi foto saat ini.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<div id="lightbox" class="lightbox-overlay" onclick="closeLightbox()">
    <div class="lightbox-inner" onclick="event.stopPropagation()">
        <button class="lightbox-close" onclick="closeLightbox()">&times;</button>
        <img id="lightbox-img" src="">
        <div id="lightbox-caption" style="color: #fff; text-align: center; margin-top: 15px; font-weight: 500;"></div>
    </div>
</div>

<script>
function filterGaleri(cat, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.filter-item').forEach(item => {
        if(cat === 'all') {
            item.classList.remove('hide');
        } else {
            item.classList.toggle('hide', !item.classList.contains(cat));
        }
    });
}

function openLightbox(src, caption) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox-caption').innerText = caption;
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').classList.remove('open');
    document.body.style.overflow = '';
}
</script>

</body>
</html>