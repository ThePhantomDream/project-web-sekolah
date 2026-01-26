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

    <section class="page-header" style="background-color: #47784b; padding: 40px 0; text-align: center;">
        <div class="container">
            <h2 style="color: white"><i class="fas fa-bullhorn"></i> Pengumuman Sekolah</h2>
            <p style="color: white">Informasi terbaru mengenai kegiatan dan kebijakan SMA YARI SCHOOL</p>
        </div>
    </section>

    <section class="announcement-content" style="padding: 40px 0;">
        <div class="container">
            <div class="announcement-list" style="display: flex; flex-direction: column; gap: 20px;">
                
                <article class="card-announcement" style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                    <div class="meta-info" style="font-size: 0.9em; color: #666; margin-bottom: 10px;">
                        <span class="category" style="background: #e74c3c; color: white; padding: 2px 10px; border-radius: 4px; font-weight: bold;">PENTING</span>
                        <span class="date"><i class="far fa-calendar-alt"></i> 20 Januari 2026</span>
                    </div>
                    <h2 style="margin: 10px 0;"><a href="#" style="text-decoration: none; color: #333;">Pelaksanaan Ujian Tengah Semester Genap 2026</a></h2>
                    <p>Diberitahukan kepada seluruh siswa kelas X, XI, dan XII bahwa UTS akan dilaksanakan mulai tanggal 2 Februari 2026. Jadwal lengkap dapat diunduh melalui tombol di bawah.</p>
                    <a href="#" class="btn-read-more" style="color: #007bff; font-weight: bold; text-decoration: none;">Selengkapnya →</a>
                </article>

                <article class="card-announcement" style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                    <div class="meta-info" style="font-size: 0.9em; color: #666; margin-bottom: 10px;">
                        <span class="category" style="background: #2ecc71; color: white; padding: 2px 10px; border-radius: 4px; font-weight: bold;">KEGIATAN</span>
                        <span class="date"><i class="far fa-calendar-alt"></i> 15 Januari 2026</span>
                    </div>
                    <h2 style="margin: 10px 0;"><a href="#" style="text-decoration: none; color: #333;">Lomba Kebersihan Kelas Antar Angkatan</a></h2>
                    <p>Dalam rangka memperingati HUT Sekolah, OSIS SMA YARI SCHOOL mengadakan lomba kebersihan kelas dengan total hadiah jutaan rupiah.</p>
                    <a href="#" class="btn-read-more" style="color: #007bff; font-weight: bold; text-decoration: none;">Selengkapnya →</a>
                </article>

            </div>

            <aside class="announcement-sidebar" style="margin-top: 40px; padding: 20px; background: #f9f9f9; border-radius: 8px;">
                <h4><i class="fas fa-search"></i> Cari Pengumuman</h4>
                <form action="" method="GET">
                    <input type="text" placeholder="Ketik kata kunci..." style="width: 100%; padding: 10px; margin-top: 10px; border: 1px solid #ccc; border-radius: 4px;">
                </form>
            </aside>
        </div>
    </section>

    <footer style="background: #333; color: white; padding: 20px 0; text-align: center; margin-top: 50px;">
        <p>&copy; 2026 SMA YARI SCHOOL. All Rights Reserved.</p>
    </footer>
    
    </body>
</html>