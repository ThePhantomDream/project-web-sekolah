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

    <section class="page-header" style="background-color: #003366; color: white; padding: 40px 0; text-align: center;">
        <div class="container">
            <h2><i class="fas fa-users"></i> Direktori Guru & Staf</h2>
            <p>Mengenal lebih dekat para pendidik SMA YARI SCHOOL</p>
        </div>
    </section>

    <section class="directory-content" style="padding: 40px 0;">
        <div class="container">
            <div class="teacher-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
                
                <div class="teacher-card" style="text-align: center; border: 1px solid #eee; padding: 20px; border-radius: 10px; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    <img src="foto-guru1.jpg" alt="Guru" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; margin-bottom: 15px; border: 5px solid #f4f4f4;">
                    <h4 style="margin: 5px 0;">Drs. Ahmad Subarjo</h4>
                    <p style="color: #007bff; font-weight: bold; margin-bottom: 10px;">Kepala Sekolah</p>
                    <p style="font-size: 0.9em; color: #666;"><i class="fas fa-envelope"></i> ahmad@yari.sch.id</p>
                </div>

                <div class="teacher-card" style="text-align: center; border: 1px solid #eee; padding: 20px; border-radius: 10px; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    <img src="foto-guru2.jpg" alt="Guru" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; margin-bottom: 15px; border: 5px solid #f4f4f4;">
                    <h4 style="margin: 5px 0;">Siti Aminah, S.Pd</h4>
                    <p style="color: #007bff; font-weight: bold; margin-bottom: 10px;">Guru Matematika</p>
                    <p style="font-size: 0.9em; color: #666;"><i class="fas fa-envelope"></i> siti@yari.sch.id</p>
                </div>

                <div class="teacher-card" style="text-align: center; border: 1px solid #eee; padding: 20px; border-radius: 10px; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    <img src="foto-guru3.jpg" alt="Guru" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; margin-bottom: 15px; border: 5px solid #f4f4f4;">
                    <h4 style="margin: 5px 0;">Budi Santoso, M.Si</h4>
                    <p style="color: #007bff; font-weight: bold; margin-bottom: 10px;">Guru Fisika</p>
                    <p style="font-size: 0.9em; color: #666;"><i class="fas fa-envelope"></i> budi@yari.sch.id</p>
                </div>

            </div>
        </div>
    </section>
    
    </body>
</html>