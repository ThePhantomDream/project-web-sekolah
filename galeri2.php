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
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f5f7fa; }

        /* ── HERO ── */
        .page-hero {
            background: linear-gradient(135deg, #2c3e50 0%, #1a2535 60%, #0d1520 100%);
            padding: 22px 0 20px; position: relative; overflow: hidden;
        }
        .page-hero::before { content:''; position:absolute; inset:0;
            background-image: radial-gradient(circle at 15% 60%, rgba(100,150,255,.10) 0%, transparent 50%),
                              radial-gradient(circle at 85% 20%, rgba(255,255,255,.04) 0%, transparent 40%); }
        .page-hero::after  { content:''; position:absolute; inset:0;
            background-image: radial-gradient(rgba(255,255,255,.06) 1px, transparent 1px);
            background-size: 28px 28px; }
        .page-hero .container { position:relative; z-index:1; }
        .page-breadcrumb { display:flex; align-items:center; gap:6px; font-size:.82em; color:rgba(255,255,255,.5); margin-bottom:14px; }
        .page-breadcrumb a { color:rgba(255,255,255,.7); text-decoration:none; }
        .page-breadcrumb a:hover { color:#fff; text-decoration:underline; }
        .page-breadcrumb i { font-size:.65em; color:rgba(255,255,255,.4); }
        .page-breadcrumb .current { color:rgba(255,255,255,.9); }
        .page-hero-body { display:flex; align-items:center; gap:20px; }
        .page-hero-icon { width:64px; height:64px; background:rgba(30,30,30,.25);
            border:2px solid rgba(150,180,255,.4); border-radius:16px;
            display:flex; align-items:center; justify-content:center; font-size:1.7rem;
            color:rgba(255,255,255,.75); flex-shrink:0; }
        .page-hero-text h1 { font-size:1.9em; font-weight:700; color:#fff; margin:0 0 6px; }
        .page-hero-text p  { color:rgba(255,255,255,.65); font-size:.92em; margin:0; }
        .page-hero-badge { margin-left:auto; background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.2);
            color:rgba(255,255,255,.75); font-size:.8em; font-weight:600;
            padding:6px 16px; border-radius:50px; white-space:nowrap; flex-shrink:0; }

        /* ── WRAP ── */
        .galeri-wrap { max-width:1200px; margin:32px auto 60px; padding:0 1.5rem; }

        /* ── FILTER ── */
        .filter-bar { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:28px; }
        .filter-btn {
            padding:6px 18px; border:1.5px solid #e5e7eb; border-radius:50px;
            background:#fff; color:#4b5563; font-size:.82rem; font-weight:600;
            cursor:pointer; transition:all .18s; font-family:'Plus Jakarta Sans',sans-serif;
        }
        .filter-btn:hover  { border-color:#2c3e50; color:#2c3e50; }
        .filter-btn.active { background:#2c3e50; border-color:#2c3e50; color:#fff; }

        /* ── GRID ── */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .gallery-card {
            background:#fff; border-radius:14px; overflow:hidden;
            box-shadow:0 2px 12px rgba(0,0,0,.07);
            transition:transform .2s, box-shadow .2s;
            cursor:pointer;
        }
        .gallery-card:hover { transform:translateY(-4px); box-shadow:0 8px 28px rgba(0,0,0,.12); }
        .gallery-card.hide  { display:none; }

        .image-box { position:relative; width:100%; height:220px; overflow:hidden; }
        .image-box img { width:100%; height:100%; object-fit:cover; transition:transform .4s; }
        .gallery-card:hover .image-box img { transform:scale(1.06); }

        /* overlay on hover */
        .image-box::after {
            content:'00e'; font-family:'Font Awesome 6 Free'; font-weight:900;
            position:absolute; inset:0; background:rgba(0,0,0,.35);
            color:#fff; font-size:1.6rem;
            display:flex; align-items:center; justify-content:center;
            opacity:0; transition:opacity .25s;
        }
        .gallery-card:hover .image-box::after { opacity:1; }

        .cat-tag {
            position:absolute; top:10px; left:10px; z-index:5;
            background:rgba(44,62,80,.85); backdrop-filter:blur(4px);
            color:#fff; font-size:.7rem; font-weight:700;
            padding:3px 10px; border-radius:50px;
        }

        .info-box { padding:14px 16px; }
        .info-box h3 { margin:0 0 5px; font-size:.95rem; font-weight:700; color:#111; }
        .info-box p  { margin:0; font-size:.82rem; color:#6b7280; line-height:1.5; 
                       display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }

        /* ── EMPTY ── */
        .no-data { text-align:center; padding:60px; color:#9ca3af; grid-column:1/-1; }
        .no-data i { font-size:2.5rem; display:block; margin-bottom:12px; color:#d1d5db; }

        /* ── LIGHTBOX ── */
        .lightbox-overlay {
            position:fixed; inset:0; background:rgba(0,0,0,.92);
            display:none; justify-content:center; align-items:center;
            z-index:9999; padding:20px;
        }
        .lightbox-overlay.open { display:flex; }
        .lightbox-inner { position:relative; max-width:900px; width:100%; text-align:center; }
        .lightbox-inner img { max-width:100%; max-height:80vh; border-radius:8px; display:block; margin:0 auto; }
        .lightbox-caption { color:rgba(255,255,255,.8); font-size:.9rem; margin-top:14px; }
        .lightbox-close {
            position:absolute; top:-44px; right:0;
            background:none; border:none; color:#fff; font-size:1.8rem;
            cursor:pointer; line-height:1; opacity:.7; transition:opacity .18s;
        }
        .lightbox-close:hover { opacity:1; }

        /* ── FOOTER ── */
        footer { background:#0d1520; color:rgba(255,255,255,.5); text-align:center; padding:22px; font-size:.83rem; }
        footer span { color:#ffd700; }
    </style>
</head>
<body>

<?php include 'header-content.php'; ?>

<!-- HERO -->
<div class="page-hero">
    <div class="container">
        <div class="page-breadcrumb">
            <a href="/project-web-sekolah/index.php"><i class="fas fa-home"></i> Beranda</a>
            <i class="fas fa-chevron-right"></i>
            <span class="current">Galeri</span>
        </div>
        <div class="page-hero-body">
            <div class="page-hero-icon"><i class="fas fa-images"></i></div>
            <div class="page-hero-text">
                <h1>Galeri Sekolah</h1>
                <p>Foto dokumentasi dan momen berharga</p>
            </div>
            <?php
            $total_foto = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM galeri"))[0];
            ?>
            <div class="page-hero-badge">
                <i class="fas fa-photo-video" style="margin-right:5px;"></i>
                <?php echo $total_foto; ?> Foto
            </div>
        </div>
    </div>
</div>

<?php
$result   = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
$cat_rows = mysqli_query($conn, "SELECT DISTINCT kategori FROM galeri ORDER BY kategori");
?>

<!-- CONTENT -->
<div class="galeri-wrap">

    <!-- Filter -->
    <div class="filter-bar">
        <button class="filter-btn active" onclick="filterGaleri('all', this)">Semua</button>
        <?php while ($c = mysqli_fetch_assoc($cat_rows)): ?>
        <button class="filter-btn" onclick="filterGaleri('<?php echo htmlspecialchars($c['kategori']); ?>', this)">
            <?php echo htmlspecialchars($c['kategori']); ?>
        </button>
        <?php endwhile; ?>
    </div>

    <!-- Grid -->
    <div class="gallery-grid" id="galleryGrid">
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="gallery-card filter-item <?php echo htmlspecialchars($row['kategori']); ?>"
                 onclick="openLightbox('<?php echo htmlspecialchars($row['gambar']); ?>', '<?php echo htmlspecialchars(addslashes($row['judul'])); ?>')">
                <div class="image-box">
                    <span class="cat-tag"><?php echo htmlspecialchars($row['kategori']); ?></span>
                    <img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['judul']); ?>" loading="lazy">
                </div>
                <div class="info-box">
                    <h3><?php echo htmlspecialchars($row['judul']); ?></h3>
                    <?php if (!empty($row['deskripsi'])): ?>
                    <p><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-data">
                <i class="fas fa-images"></i>
                <p>Belum ada foto di galeri.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- LIGHTBOX -->
<div id="lightbox" class="lightbox-overlay" onclick="closeLightbox()">
    <div class="lightbox-inner" onclick="event.stopPropagation()">
        <button class="lightbox-close" onclick="closeLightbox()">&times;</button>
        <img id="lightbox-img" src="" alt="">
        <div class="lightbox-caption" id="lightbox-caption"></div>
    </div>
</div>

<footer>
    &copy; <?php echo date('Y'); ?> <span>SMA YARI SCHOOL</span> &middot; Padang. All rights reserved.
</footer>

<script>
function filterGaleri(cat, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.filter-item').forEach(item => {
        item.classList.toggle('hide', cat !== 'all' && !item.classList.contains(cat));
    });
}
function openLightbox(src, caption) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox-caption').textContent = caption;
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightbox').classList.remove('open');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
</script>
</body>
</html>