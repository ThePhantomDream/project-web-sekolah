<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direktori Guru - SMA YARI SCHOOL</title>
    <link rel="stylesheet" href="/project-web-sekolah/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ── HERO — unik per halaman ── */
        .dir-hero {
            background: linear-gradient(135deg, #c0392b 0%, #8b1a1a 60%, #5a0f0f 100%);
            padding: 22px 0 20px;
            position: relative; overflow: hidden;
        }
        .dir-hero::before {
            content: ''; position: absolute; inset: 0;
            background-image:
                radial-gradient(circle at 15% 60%, rgba(255,100,80,.12) 0%, transparent 50%),
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
            background: rgba(30,30,30,.25); border: 2px solid rgba(255,138,122,.4);
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
        .dir-toolbar input:focus { border-color: #c0392b; box-shadow: 0 0 0 3px rgba(192,57,43,.1); }
        .dir-toolbar button {
            background: #c0392b; color: #fff; border: none;
            border-radius: 5px; padding: 8px 18px;
            font-size: .88em; font-weight: 600; cursor: pointer;
        }
        .dir-toolbar button:hover { background: #a93226; }
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
        thead { background: #fff5f5; }
        thead th {
            padding: 11px 14px; text-align: left; font-size: .8em;
            font-weight: 700; text-transform: uppercase; letter-spacing: .04em;
            color: #c0392b; border-bottom: 2px solid #ffd5d0; white-space: nowrap;
        }
        tbody tr { border-bottom: 1px solid #f2f4f8; transition: background .12s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #fff5f5; }
        tbody td { padding: 10px 14px; color: #333; vertical-align: middle; }
        tbody td:first-child { font-weight: 700; color: #c0392b; width: 44px; text-align: center; }

        /* Tombol Lihat Foto */
        .img-guru {
            width: 80px; 
            height: 100px; /* Rasio pas foto */
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ddd;
            display: block;
            margin: 0 auto;
        }
        
        .no-img-icon {
            width: 80px; height: 100px;
            background: #f9f9f9;
            display: flex; align-items: center; justify-content: center;
            color: #ddd; font-size: 2em; border: 1px solid #eee; margin: 0 auto;
        }

        .no-data { text-align:center; padding: 50px; color: #aaa; }
        .no-data i { font-size: 2.2rem; display:block; margin-bottom:10px; color:#ccc; }

        /* --- Modal Background --- */
.modal-zoom {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 9999; /* Sit on top of everything */
    padding-top: 50px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9); /* Black w/ opacity */
    cursor: pointer;
}

/* --- The Image inside the Modal --- */
.modal-content-zoom {
    margin: auto;
    display: block;
    max-height: 85vh; /* Keep it within screen height */
    max-width: 90%;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0,0,0,0.5);
    
    /* Animation */
    animation-name: zoomIn;
    animation-duration: 0.3s;
}

@keyframes zoomIn {
    from {transform: scale(0.5); opacity: 0;}
    to {transform: scale(1); opacity: 1;}
}

/* Make the cursor a pointer when hovering over teacher photos */
.img-guru {
    cursor: pointer;
    transition: transform 0.2s;
}
.img-guru:hover {
    transform: scale(1.05);
    border-color: #c0392b;
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
    $where = "WHERE nama_lengkap LIKE '%$s%' OR nip LIKE '%$s%' OR mata_pelajaran LIKE '%$s%'";
}
$result = mysqli_query($conn, "SELECT * FROM `guru` $where ORDER BY nama_lengkap ASC");
$total  = $result ? mysqli_num_rows($result) : 0;
?>

<div class="dir-hero">
    <div class="container">
        <div class="dir-breadcrumb">
            <a href="/project-web-sekolah/index.php"><i class="fas fa-home"></i> Beranda</a>
            <i class="fas fa-chevron-right"></i>
            <span>Direktori</span>
            <i class="fas fa-chevron-right"></i>
            <span class="current">Data Guru</span>
        </div>
        <div class="dir-hero-body">
            <div class="dir-hero-icon"><i class="fas fa-chalkboard-teacher"></i></div>
            <div class="dir-hero-text">
                <h1>Data Guru</h1>
                <p>Daftar seluruh guru pengajar SMA YARI School.</p>
            </div>
            <div class="dir-hero-badge">
                <i class="fas fa-database" style="margin-right:5px;"></i>
                <?php echo $total; ?> Data
            </div>
        </div>
    </div>
</div>

<div class="container dir-content">
    <form method="GET" action="direktori_guru.php">
        <div class="dir-toolbar">
            <input type="text" name="q" placeholder="Cari nama, NIP, atau mata pelajaran..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit"><i class="fas fa-search"></i> Cari</button>
            <?php if ($search): ?>
            <a href="direktori_guru.php" class="reset-btn"><i class="fas fa-times"></i> Reset</a>
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
                        <th style="text-align: center;">Foto</th>
                        <th>NIY</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Mata Pelajaran</th>
                        <th>No. HP</th>
                        <th>Email</th>
        </tr></thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td style="text-align: center;">
                    <?php if (!empty($row['foto']) && file_exists("../img_guru/" . $row['foto'])): ?>
                        <!-- Foto Tampil Langsung -->
                        <img src="../img_guru/<?php echo $row['foto']; ?>" alt="Foto" class="img-guru" onclick="openZoom(this.src)">
                    <?php else: ?>
                        <!-- Ikon jika foto kosong -->
                        <div class="no-img-icon"><i class="fas fa-user"></i></div>
                    <?php endif; ?>
                </td>

                <td><?php echo htmlspecialchars($row['nip'] ?? '-'); ?></td>
                <td><?php echo htmlspecialchars($row['nama_lengkap'] ?? '-'); ?></td>
                <td><?php echo htmlspecialchars($row['jenis_kelamin'] ?? '-'); ?></td>
                <td><?php echo htmlspecialchars($row['mata_pelajaran'] ?? '-'); ?></td>
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

// Close the modal when the user presses the 'Esc' key
document.addEventListener('keydown', function(event) {
    if (event.key === "Escape") {
        document.getElementById("photoModal").style.display = 'none';
    }
});
</script>

</body>
</html>
