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
        /* ── HERO — unik per halaman ── */
        .dir-hero {
            background: linear-gradient(135deg, #1e7e34 0%, #145a26 60%, #0a3516 100%);
            padding: 22px 0 20px;
            position: relative; overflow: hidden;
        }
        .dir-hero::before {
            content: ''; position: absolute; inset: 0;
            background-image:
                radial-gradient(circle at 15% 60%, rgba(80,200,100,.12) 0%, transparent 50%),
                radial-gradient(circle at 85% 20%, rgba(255,255,255,.04) 0%, transparent 40%);
        }
        .dir-hero::after {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(rgba(255,255,255,.06) 1px, transparent 1px);
            background-size: 28px 28px;
        }
        .dir-hero .container { position: relative; z-index: 1; }

        /* breadcrumb — ABU */
        .dir-breadcrumb {
            display: flex; align-items: center; gap: 6px;
            font-size: .82em; color: rgba(255,255,255,.5); margin-bottom: 14px;
        }
        .dir-breadcrumb a { color: rgba(255,255,255,.7); text-decoration: none; }
        .dir-breadcrumb a:hover { color: #fff; text-decoration: underline; }
        .dir-breadcrumb i { font-size: .65em; color: rgba(255,255,255,.4); }
        .dir-breadcrumb .current { color: rgba(255,255,255,.9); }

        .dir-hero-body { display: flex; align-items: center; gap: 20px; }
        .dir-hero-icon {
            width: 64px; height: 64px;
            background: rgba(30,30,30,.25); border: 2px solid rgba(111,207,127,.4);
            border-radius: 16px; display: flex; align-items: center;
            justify-content: center; font-size: 1.7rem;
            color: rgba(255,255,255,.75); flex-shrink: 0;
        }
        .dir-hero-text h1 { font-size: 1.9em; font-weight: 700; color: #fff; margin: 0 0 6px; }
        .dir-hero-text p { color: rgba(255,255,255,.65); font-size: .92em; margin: 0; }

        /* badge "X Data" — ABU */
        .dir-hero-badge {
            margin-left: auto;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.2);
            color: rgba(255,255,255,.75);
            font-size: .8em; font-weight: 600;
            padding: 6px 16px; border-radius: 50px;
            white-space: nowrap; flex-shrink: 0;
        }

        /* ── KONTEN — ikut warna hero masing-masing ── */
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
        .dir-toolbar input:focus { border-color: #1e7e34; box-shadow: 0 0 0 3px rgba(30,126,52,.1); }
        .dir-toolbar button {
            background: #1e7e34; color: #fff; border: none;
            border-radius: 5px; padding: 8px 18px;
            font-size: .88em; font-weight: 600; cursor: pointer;
        }
        .dir-toolbar button:hover { background: #165a26; }
        .dir-toolbar a.reset-btn {
            color: #666; font-size: .85em; text-decoration: none;
            padding: 8px 14px; border: 1px solid #ddd; border-radius: 5px;
        }
        .dir-toolbar a.reset-btn:hover { background: #f5f5f5; }

        /* stat text — ABU */
        .dir-stat { font-size: .85em; color: #888; margin-bottom: 14px; }
        .dir-stat strong { color: #555; }

        .table-wrap {
            overflow-x: auto; border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0,0,0,.08); border: 1px solid #eef0f5;
        }
        table { width: 100%; border-collapse: collapse; background: #fff; font-size: .9em; }
        thead { background: #f2fff4; }
        thead th {
            padding: 11px 14px; text-align: left; font-size: .8em;
            font-weight: 700; text-transform: uppercase; letter-spacing: .04em;
            color: #1e7e34; border-bottom: 2px solid #c3e6cb; white-space: nowrap;
        }
        tbody tr { border-bottom: 1px solid #f2f4f8; transition: background .12s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #f2fff4; }
        tbody td { padding: 10px 14px; color: #333; vertical-align: middle; }
        tbody td:first-child { font-weight: 700; color: #1e7e34; width: 44px; text-align: center; }
        .no-data { text-align:center; padding: 50px; color: #aaa; }
        .no-data i { font-size: 2.2rem; display:block; margin-bottom:10px; color:#ccc; }
    </style>
</head>
<body>

<?php include '../header-content.php'; ?>

<?php
$search = trim($_GET['q'] ?? '');
$where  = '';
if ($search !== '') {
    $s     = mysqli_real_escape_string($conn, $search);
    $where = "WHERE nama_lengkap LIKE '%$s%' OR nip LIKE '%$s%' OR jabatan LIKE '%$s%'";
}
$result = mysqli_query($conn, "SELECT * FROM `tendik` $where ORDER BY nama_lengkap ASC");
$total  = $result ? mysqli_num_rows($result) : 0;
?>

<div class="dir-hero">
    <div class="container">
        <div class="dir-breadcrumb">
            <a href="/project-web-sekolah/index.php"><i class="fas fa-home"></i> Beranda</a>
            <i class="fas fa-chevron-right"></i>
            <span>Direktori</span>
            <i class="fas fa-chevron-right"></i>
            <span class="current">Tenaga Kependidikan</span>
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
            <input type="text" name="q" placeholder="Cari nama, NIP, atau jabatan..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit"><i class="fas fa-search"></i> Cari</button>
            <?php if ($search): ?>
            <a href="direktori_tendik.php" class="reset-btn"><i class="fas fa-times"></i> Reset</a>
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
        <thead><tr>
                        <th>#</th>
                        <th>NIP</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Jabatan</th>
                        <th>No. HP</th>
                        <th>Email</th>
        </tr></thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($row['nip'] ?? '-'); ?></td>
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
    <div class="no-data">
        <i class="fas fa-inbox"></i>
        <p>Tidak ada data ditemukan.</p>
    </div>
    <?php endif; ?>
    </div>
</div>
</body>
</html>