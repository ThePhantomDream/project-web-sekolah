<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Sekolah</title>
    <link rel="stylesheet" href="style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <?php include 'header-content.php'; ?>

    <section class="page-header" style="background-color: #2c3e50; color: white; padding: 40px 0; text-align: center;">
        <div class="container">
            <h2><i class="fas fa-images"></i> Galeri Kegiatan</h2>
            <p>Dokumentasi momen berharga di SMA YARI SCHOOL</p>
        </div>
    </section>

    <section class="gallery-content" style="padding: 40px 0;">
        <div class="container">
            <div class="gallery-filter" style="margin-bottom: 30px; text-align: center;">
                <button style="padding: 8px 20px; border: none; background: #007bff; color: white; border-radius: 20px; cursor: pointer;">Semua</button>
                <button style="padding: 8px 20px; border: none; background: #eee; border-radius: 20px; cursor: pointer; margin-left: 10px;">Akademik</button>
                <button style="padding: 8px 20px; border: none; background: #eee; border-radius: 20px; cursor: pointer; margin-left: 10px;">Olahraga</button>
            </div>

            <div class="gallery-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 15px;">
                
                <div class="gallery-item" style="overflow: hidden; border-radius: 8px; position: relative;">
                    <img src="kegiatan1.jpg" alt="Lomba" style="width: 100%; height: 250px; object-fit: cover; display: block; transition: 0.3s;">
                    <div class="overlay" style="padding: 10px; background: rgba(0,0,0,0.6); color: white; text-align: center;">
                        Kegiatan Upacara Bendera
                    </div>
                </div>

                <div class="gallery-item" style="overflow: hidden; border-radius: 8px;">
                    <img src="kegiatan2.jpg" alt="Lomba" style="width: 100%; height: 250px; object-fit: cover; display: block;">
                    <div class="overlay" style="padding: 10px; background: rgba(0,0,0,0.6); color: white; text-align: center;">
                        Pertandingan Basket antar Kelas
                    </div>
                </div>

                <div class="gallery-item" style="overflow: hidden; border-radius: 8px;">
                    <img src="kegiatan3.jpg" alt="Lomba" style="width: 100%; height: 250px; object-fit: cover; display: block;">
                    <div class="overlay" style="padding: 10px; background: rgba(0,0,0,0.6); color: white; text-align: center;">
                        Praktikum Biologi di Laboratorium
                    </div>
                </div>

            </div>
        </div>
    </section>
    
    </body>
</html>