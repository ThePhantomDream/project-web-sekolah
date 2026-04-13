<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman - SMA YARI SCHOOL</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* HERO */
        .page-hero {
            background: linear-gradient(135deg, #47784b 0%, #2d5c32 60%, #1a3a1e 100%);
            padding: 22px 0 20px; position: relative; overflow: hidden;
        }
        .page-hero::before {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(circle at 15% 60%, rgba(80,200,100,.12) 0%, transparent 50%),
                              radial-gradient(circle at 85% 20%, rgba(255,255,255,.04) 0%, transparent 40%);
        }
        .page-hero::after {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(rgba(255,255,255,.06) 1px, transparent 1px);
            background-size: 28px 28px;
        }
        .page-hero .container { position: relative; z-index: 1; }
        .page-breadcrumb {
            display: flex; align-items: center; gap: 6px;
            font-size: .82em; color: rgba(255,255,255,.5); margin-bottom: 14px;
        }
        .page-breadcrumb a { color: rgba(255,255,255,.7); text-decoration: none; }
        .page-breadcrumb a:hover { color: #fff; text-decoration: underline; }
        .page-breadcrumb i { font-size: .65em; color: rgba(255,255,255,.4); }
        .page-breadcrumb .current { color: rgba(255,255,255,.9); }
        .page-hero-body { display: flex; align-items: center; gap: 20px; }
        .page-hero-icon {
            width: 64px; height: 64px; background: rgba(30,30,30,.25);
            border: 2px solid rgba(111,207,127,.4); border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.7rem; color: rgba(255,255,255,.75); flex-shrink: 0;
        }
        .page-hero-text h1 { font-size: 1.9em; font-weight: 700; color: #fff; margin: 0 0 6px; }
        .page-hero-text p  { color: rgba(255,255,255,.65); font-size: .92em; margin: 0; }
        .page-hero-badge {
            margin-left: auto; background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.2); color: rgba(255,255,255,.75);
            font-size: .8em; font-weight: 600; padding: 6px 16px;
            border-radius: 50px; white-space: nowrap; flex-shrink: 0;
        }

        /* CONTENT */
        .content-wrap { max-width: 1200px; margin: 0 auto; padding: 36px 1.5rem 60px; display: grid; grid-template-columns: 1fr 300px; gap: 32px; }
        @media(max-width:800px){ .content-wrap { grid-template-columns: 1fr; } }

        /* FILTER BAR */
        .filter-bar { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 24px; }
        .filter-btn {
            padding: 6px 16px; border: 1.5px solid #e5e7eb; border-radius: 50px;
            background: #fff; color: #4b5563; font-size: .82rem; font-weight: 600;
            cursor: pointer; transition: all .18s; font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .filter-btn:hover  { border-color: #1e7e34; color: #1e7e34; }
        .filter-btn.active { background: #1e7e34; border-color: #1e7e34; color: #fff; }

        /* CARD */
        .ann-card {
            background: #fff; border-radius: 14px; padding: 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,.07); margin-bottom: 18px;
            border-left: 5px solid #e5e7eb;
            transition: transform .2s, box-shadow .2s;
            display: block; text-decoration: none; color: inherit;
        }
        .ann-card:hover { transform: translateY(-3px); box-shadow: 0 8px 28px rgba(0,0,0,.11); }
        .ann-card.Penting    { border-left-color: #c0392b; }
        .ann-card.Kegiatan   { border-left-color: #1e7e34; }
        .ann-card.Informasi  { border-left-color: #004d99; }
        .ann-card.Libur      { border-left-color: #c68a00; }

        .ann-meta { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; flex-wrap: wrap; }
        .ann-tag {
            font-size: .7rem; font-weight: 700; padding: 3px 10px;
            border-radius: 4px; text-transform: uppercase;
        }
        .ann-tag.Penting   { background: #fde8e8; color: #c0392b; }
        .ann-tag.Kegiatan  { background: #d1fae5; color: #1e7e34; }
        .ann-tag.Informasi { background: #dbeafe; color: #004d99; }
        .ann-tag.Libur     { background: #fef9c3; color: #c68a00; }
        .ann-date { font-size: .78rem; color: #6b7280; display: flex; align-items: center; gap: 5px; }
        .ann-card h2 { font-size: 1.05rem; font-weight: 700; color: #111; margin: 0 0 8px; }
        .ann-card p  { font-size: .875rem; color: #6b7280; line-height: 1.6; margin: 0 0 14px;
                       display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .ann-more { font-size: .82rem; font-weight: 700; color: #1e7e34; display: flex; align-items: center; gap: 5px; }

        .no-data { text-align: center; padding: 48px; color: #9ca3af; }
        .no-data i { font-size: 2.5rem; display: block; margin-bottom: 12px; color: #d1d5db; }

        /* SIDEBAR */
        .sidebar-card { background: #fff; border-radius: 14px; padding: 22px; box-shadow: 0 2px 12px rgba(0,0,0,.07); margin-bottom: 20px; }
        .sidebar-card h4 { font-size: .92rem; font-weight: 700; color: #111; margin: 0 0 14px; display: flex; align-items: center; gap: 8px; }
        .sidebar-card h4 i { color: #1e7e34; }
        .search-input-wrap { position: relative; }
        .search-input-wrap i { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: .82rem; }
        .search-input-wrap input {
            width: 100%; padding: 9px 12px 9px 32px; border: 1.5px solid #e5e7eb;
            border-radius: 8px; font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: .875rem; color: #111; outline: none; box-sizing: border-box;
        }
        .search-input-wrap input:focus { border-color: #1e7e34; }
        .sidebar-search-btn {
            width: 100%; margin-top: 8px; padding: 9px;
            background: #1e7e34; color: #fff; border: none; border-radius: 8px;
            font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 600;
            font-size: .875rem; cursor: pointer;
        }
        .sidebar-search-btn:hover { background: #145a26; }
        .cat-list { list-style: none; padding: 0; margin: 0; }
        .cat-list li { border-bottom: 1px solid #f3f4f6; }
        .cat-list li:last-child { border-bottom: none; }
        .cat-list li a {
            display: flex; align-items: center; justify-content: space-between;
            padding: 9px 4px; text-decoration: none; color: #374151;
            font-size: .875rem; font-weight: 500; transition: color .15s;
        }
        .cat-list li a:hover { color: #1e7e34; }
        .cat-count { background: #f3f4f6; color: #6b7280; font-size: .72rem; font-weight: 700; padding: 2px 8px; border-radius: 50px; }

        footer { background: #0d1520; color: rgba(255,255,255,.5); text-align: center; padding: 22px; font-size: .83rem; margin-top: 0; }
        footer span { color: #ffd700; }
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
            <span class="current">Pengumuman</span>
        </div>
        <div class="page-hero-body">
            <div class="page-hero-icon"><i class="fas fa-bullhorn"></i></div>
            <div class="page-hero-text">
                <h1>Pengumuman Sekolah</h1>
                <p>Informasi terbaru mengenai kegiatan dan kebijakan SMA YARI SCHOOL</p>
            </div>
            <?php
            $total_ann = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM pengumuman"))[0];
            ?>
            <div class="page-hero-badge">
                <i class="fas fa-bell" style="margin-right:5px;"></i>
                <?php echo $total_ann; ?> Pengumuman
            </div>
        </div>
    </div>
</div>

<?php
$kategori_filter = $_GET['kategori'] ?? 'semua';
$search          = trim($_GET['q'] ?? '');
$conditions = [];
if ($kategori_filter !== 'semua') {
    $kf = mysqli_real_escape_string($conn, $kategori_filter);
    $conditions[] = "kategori = '$kf'";
}
if ($search !== '') {
    $s = mysqli_real_escape_string($conn, $search);
    $conditions[] = "(judul LIKE '%$s%' OR isi LIKE '%$s%')";
}
$where  = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';
$result = mysqli_query($conn, "SELECT * FROM pengumuman $where ORDER BY tanggal DESC");
$total  = $result ? mysqli_num_rows($result) : 0;

// Hitung per kategori untuk sidebar
$cat_counts = [];
$cr = mysqli_query($conn, "SELECT kategori, COUNT(*) as c FROM pengumuman GROUP BY kategori");
while ($row = mysqli_fetch_assoc($cr)) $cat_counts[$row['kategori']] = $row['c'];
?>

<!-- MAIN CONTENT -->
<div class="content-wrap">
    <div class="main-col">

        <!-- Filter -->
        <div class="filter-bar">
            <a href="pengumuman.php" class="filter-btn <?php echo $kategori_filter==='semua'?'active':''; ?>">Semua</a>
            <?php foreach(['Penting','Kegiatan','Informasi','Libur'] as $kat): ?>
            <a href="pengumuman.php?kategori=<?php echo $kat; ?><?php echo $search ? '&q='.urlencode($search) : ''; ?>"
               class="filter-btn <?php echo $kategori_filter===$kat?'active':''; ?>"><?php echo $kat; ?></a>
            <?php endforeach; ?>
        </div>

        <!-- List -->
        <?php if ($result && $total > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <a href="/project-web-sekolah/pengumuman_detail.php?id=<?php echo $row['id']; ?>" class="ann-card <?php echo htmlspecialchars($row['kategori']); ?>">
                <div class="ann-meta">
                    <span class="ann-tag <?php echo htmlspecialchars($row['kategori']); ?>"><?php echo htmlspecialchars($row['kategori']); ?></span>
                    <span class="ann-date"><i class="far fa-calendar-alt"></i>
                        <?php
                        $bl = ['01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'Mei','06'=>'Jun',
                               '07'=>'Jul','08'=>'Agu','09'=>'Sep','10'=>'Okt','11'=>'Nov','12'=>'Des'];
                        $d = explode('-', $row['tanggal']);
                        echo $d[2].' '.($bl[$d[1]]??$d[1]).' '.$d[0];
                        ?>
                    </span>
                </div>
                <h2><?php echo htmlspecialchars($row['judul']); ?></h2>
                <p><?php echo htmlspecialchars(str_replace('\n', ' ', $row['isi'])); ?></p>
                <div class="ann-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></div>
            </a>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-data">
                <i class="fas fa-inbox"></i>
                <p>Tidak ada pengumuman ditemukan.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- SIDEBAR -->
    <aside>
        <div class="sidebar-card">
            <h4><i class="fas fa-search"></i> Cari Pengumuman</h4>
            <form method="GET" action="pengumuman.php">
                <?php if ($kategori_filter !== 'semua'): ?>
                <input type="hidden" name="kategori" value="<?php echo htmlspecialchars($kategori_filter); ?>">
                <?php endif; ?>
                <div class="search-input-wrap">
                    <i class="fas fa-search"></i>
                    <input type="text" name="q" placeholder="Kata kunci..." value="<?php echo htmlspecialchars($search); ?>">
                </div>
                <button type="submit" class="sidebar-search-btn">Cari</button>
            </form>
        </div>

        <div class="sidebar-card">
            <h4><i class="fas fa-tags"></i> Kategori</h4>
            <ul class="cat-list">
                <li><a href="pengumuman.php">Semua <span class="cat-count"><?php echo $total_ann; ?></span></a></li>
                <?php foreach(['Penting','Kegiatan','Informasi','Libur'] as $kat): ?>
                <li>
                    <a href="pengumuman.php?kategori=<?php echo $kat; ?>">
                        <?php echo $kat; ?>
                        <span class="cat-count"><?php echo $cat_counts[$kat] ?? 0; ?></span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </aside>
</div>

<footer>
    &copy; <?php echo date('Y'); ?> <span>SMA YARI SCHOOL</span> &middot; Padang. All rights reserved.
</footer>
</body>
</html>