<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri SMA YARI SCHOOL</title>
    <link rel="stylesheet" href="style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* 1. Filter Style */
        .filter-container { text-align: center; margin: 30px 0; }
        .filter-btn {
            padding: 10px 25px; border: none; background: #ebedef;
            cursor: pointer; border-radius: 30px; margin: 5px;
            transition: 0.3s; font-weight: 600; color: #2c3e50;
        }
        .filter-btn.active { background: #007bff; color: white; box-shadow: 0 4px 10px rgba(0,123,255,0.3); }

        /* 2. Grid Style (Solusi agar tidak ada space kosong) */
        .gallery-grid {
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); 
            gap: 20px; padding: 20px;
        }

        .gallery-card {
            background: white; border-radius: 15px; overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: 0.3s;
            display: flex; flex-direction: column;
        }
        
        /* Hilangkan elemen sepenuhnya saat tidak sesuai kategori */
        .gallery-card.hide { display: none; }

        .image-box { position: relative; width: 100%; height: 230px; cursor: pointer; overflow: hidden; }
        .image-box img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
        .image-box:hover img { transform: scale(1.1); }

        .category-tag {
            position: absolute; top: 12px; left: 12px;
            background: #007bff; color: white;
            padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: bold; z-index: 5;
        }

        .info-box { padding: 15px; flex-grow: 1; }
        .info-box h3 { margin: 0 0 8px 0; font-size: 17px; color: #2c3e50; }
        .info-box p { margin: 0; font-size: 13px; color: #7f8c8d; line-height: 1.4; }

        /* 3. Popup (Lightbox) Style */
        .lightbox-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.9); display: none; /* Sembunyi secara default */
            justify-content: center; align-items: center; z-index: 9999;
            padding: 20px;
        }
        .lightbox-content { position: relative; max-width: 900px; width: 100%; text-align: center; }
        .lightbox-content img { max-width: 100%; max-height: 80vh; border: 3px solid #000000; }
        .close-btn { 
            position: absolute; top: -40px; right: 0; color: white; 
            font-size: 30px; cursor: pointer; background: none; border: none; 
        }
    </style>
</head>
<body>

    <?php include 'header-content.php'; ?>

    <section class="page-header" style="background: #2c3e50; color: white; padding: 40px 0; text-align: center;">
        <div class="container">
            <h1><i class="fas fa-images"></i> Galeri Sekolah</h1>
            <p>Momen berharga SMA YARI SCHOOL</p>
        </div>
    </section>

    <div class="container">
        <div class="filter-container">
            <button class="filter-btn active" onclick="filterSelection('all', this)">Semua</button>
            <?php
            $get_cats = mysqli_query($conn, "SELECT DISTINCT kategori FROM galeri");
            while($c = mysqli_fetch_assoc($get_cats)) {
                echo '<button class="filter-btn" onclick="filterSelection(\''.$c['kategori'].'\', this)">'.$c['kategori'].'</button>';
            }
            ?>
        </div>

        <div class="gallery-grid" id="mainGrid">
            <?php
            $query = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
            while($row = mysqli_fetch_assoc($query)) {
            ?>
                <div class="gallery-card filter-item <?php echo $row['kategori']; ?>">
                    <div class="image-box" onclick="openLightbox('<?php echo $row['gambar']; ?>')">
                        <div class="category-tag"><?php echo $row['kategori']; ?></div>
                        <img src="<?php echo $row['gambar']; ?>" alt="Kegiatan">
                    </div>
                    <div class="info-box">
                        <h3><?php echo $row['judul']; ?></h3>
                        <p><?php echo $row['deskripsi']; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div id="lightbox" class="lightbox-overlay" onclick="closeLightbox()">
        <div class="lightbox-content" onclick="event.stopPropagation()">
            <button class="close-btn" onclick="closeLightbox()">&times;</button>
            <img id="lightbox-img" src="" alt="Full Image">
            <h3 id="lightbox-caption" style="color: white; margin-top: 15px;"></h3>
        </div>
    </div>

    <script>
        // Fungsi Filter Kategori agar Rapi
        function filterSelection(category, btn) {
            // Update tombol active
            let buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Filter item
            let items = document.querySelectorAll('.filter-item');
            items.forEach(item => {
                if (category === 'all' || item.classList.contains(category)) {
                    item.classList.remove('hide');
                } else {
                    item.classList.add('hide');
                }
            });
        }

        // Fungsi Popup Gambar
        function openLightbox(src) {
            document.getElementById('lightbox-img').src = src;
            document.getElementById('lightbox').style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Matikan scroll saat popup muncul
        }

        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
            document.body.style.overflow = 'auto'; // Aktifkan scroll kembali
        }
    </script>
</body>
</html>