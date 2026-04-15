<?php
include 'koneksi.php';
$id  = (int)($_GET['id'] ?? 0);
$row = $id ? mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pengumuman WHERE id=$id")) : null;
if (!$row) { header('Location: pengumuman.php'); exit; }
$bl  = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni',
        '07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
$d   = explode('-', $row['tanggal']);
$tgl = $d[2].' '.($bl[$d[1]]??$d[1]).' '.$d[0];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['judul']); ?> - SMA YARI SCHOOL</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f5f7fa; }
        .page-hero {
            background: linear-gradient(135deg, #47784b 0%, #2d5c32 60%, #1a3a1e 100%);
            padding: 22px 0 20px; position: relative; overflow: hidden;
        }
        .page-hero::before { content:''; position:absolute; inset:0;
            background-image: radial-gradient(circle at 15% 60%, rgba(80,200,100,.12) 0%, transparent 50%); }
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
        .page-hero-icon { width:64px; height:64px; background:rgba(30,30,30,.25); border:2px solid rgba(111,207,127,.4);
            border-radius:16px; display:flex; align-items:center; justify-content:center; font-size:1.7rem; color:rgba(255,255,255,.75); flex-shrink:0; }
        .page-hero-text h1 { font-size:1.6em; font-weight:700; color:#fff; margin:0 0 6px; line-height:1.3; }
        .page-hero-text p  { color:rgba(255,255,255,.65); font-size:.88em; margin:0; }

        .detail-wrap { max-width:860px; margin:36px auto 60px; padding:0 1.5rem; }
        .detail-card { background:#fff; border-radius:16px; box-shadow:0 2px 16px rgba(0,0,0,.08); overflow:hidden; }
        .detail-tag-bar {
            padding:18px 28px; border-bottom:1px solid #f3f4f6;
            display:flex; align-items:center; gap:12px; flex-wrap:wrap;
        }
        .detail-tag { font-size:.72rem; font-weight:700; padding:4px 12px; border-radius:4px; text-transform:uppercase; }
        .detail-tag.Penting   { background:#fde8e8; color:#c0392b; }
        .detail-tag.Kegiatan  { background:#d1fae5; color:#1e7e34; }
        .detail-tag.Informasi { background:#dbeafe; color:#004d99; }
        .detail-tag.Libur     { background:#fef9c3; color:#c68a00; }
        .detail-date { font-size:.82rem; color:#6b7280; display:flex; align-items:center; gap:6px; }

        .detail-body { padding:28px 32px; }
        .detail-body h2 { font-family:'Playfair Display',serif; font-size:1.7rem; color:#111; margin:0 0 20px; line-height:1.3; }
        .detail-body .isi {
            font-size:.95rem; color:#374151; line-height:1.85;
            white-space: pre-line;
        }
        .detail-footer {
            padding:18px 28px; border-top:1px solid #f3f4f6;
            display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;
        }
        .back-btn {
            display:inline-flex; align-items:center; gap:7px;
            background:#f0f5ff; color:#004d99; text-decoration:none;
            padding:9px 18px; border-radius:8px; font-size:.875rem; font-weight:600;
            transition:background .18s;
        }
        .back-btn:hover { background:#dbeafe; }
        .share-text { font-size:.8rem; color:#9ca3af; }

    </style>
</head>
<body>

<?php include 'header-content.php'; ?>

<div class="page-hero">
    <div class="container">
        <div class="page-breadcrumb">
            <a href="/project-web-sekolah/index.php"><i class="fas fa-home"></i> Beranda</a>
            <i class="fas fa-chevron-right"></i>
            <a href="/project-web-sekolah/pengumuman.php">Pengumuman</a>
            <i class="fas fa-chevron-right"></i>
            <span class="current">Detail</span>
        </div>
        <div class="page-hero-body">
            <div class="page-hero-icon"><i class="fas fa-bullhorn"></i></div>
            <div class="page-hero-text">
                <h1><?php echo htmlspecialchars($row['judul']); ?></h1>
                <p><?php echo $tgl; ?> &middot; <?php echo htmlspecialchars($row['kategori']); ?></p>
            </div>
        </div>
    </div>
</div>

<div class="detail-wrap">
    <div class="detail-card">
        <div class="detail-tag-bar">
            <span class="detail-tag <?php echo htmlspecialchars($row['kategori']); ?>"><?php echo htmlspecialchars($row['kategori']); ?></span>
            <span class="detail-date"><i class="far fa-calendar-alt"></i> <?php echo $tgl; ?></span>
        </div>
        <div class="detail-body">
            <h2><?php echo htmlspecialchars($row['judul']); ?></h2>
            <div class="isi"><?php echo htmlspecialchars(str_replace('\\n', "\n", $row['isi'])); ?></div>
        </div>
        <div class="detail-footer">
            <a href="/project-web-sekolah/pengumuman.php" class="back-btn">
                <i class="fas fa-arrow-left"></i> Kembali ke Pengumuman
            </a>
            <span class="share-text"><i class="fas fa-info-circle"></i> SMA YARI SCHOOL</span>
        </div>
    </div>
</div>

</body>
</html>