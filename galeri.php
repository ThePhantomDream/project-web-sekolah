<?php 
    require_once 'conn.php';

    // 1. Get the filter category from the URL (default to 'semua')
    $filter = isset($_GET['cat']) ? $_GET['cat'] : 'semua';

    // 2. Adjust the SQL query based on the selected button
    if ($filter == 'semua') {
        $query = "SELECT * FROM website ORDER BY id DESC";
    } else {
        $safe_filter = $mysqli->real_escape_string($filter);
        $query = "SELECT * FROM website WHERE category = '$safe_filter' ORDER BY id DESC";
    }

    $result = $mysqli->query($query);

    if (!$result) {
        die("Query Error: " . $mysqli->error);
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Kegiatan - SMA YARI SCHOOL</title>
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
                <a href="galeri.php?cat=semua" style="padding: 8px 20px; text-decoration: none; border-radius: 20px; display: inline-block; transition: 0.3s; 
                    <?php echo ($filter == 'semua') ? 'background: #007bff; color: white;' : 'background: #eee; color: #333;'; ?>">Semua</a>
                
                <a href="galeri.php?cat=akademik" style="padding: 8px 20px; text-decoration: none; border-radius: 20px; margin-left: 10px; display: inline-block; transition: 0.3s; 
                    <?php echo ($filter == 'akademik') ? 'background: #007bff; color: white;' : 'background: #eee; color: #333;'; ?>">Akademik</a>
                
                <a href="galeri.php?cat=olahraga" style="padding: 8px 20px; text-decoration: none; border-radius: 20px; margin-left: 10px; display: inline-block; transition: 0.3s; 
                    <?php echo ($filter == 'olahraga') ? 'background: #007bff; color: white;' : 'background: #eee; color: #333;'; ?>">Olahraga</a>
            </div>

            <div class="gallery-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 15px;">
                
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        
                        <div class="gallery-item" style="overflow: hidden; border-radius: 8px; position: relative; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                            <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" 
                                 alt="Kegiatan" 
                                 style="width: 100%; height: 250px; object-fit: cover; display: block; transition: 0.3s;">
                            
                            <div class="overlay" style="padding: 10px; background: rgba(0,0,0,0.7); color: white; text-align: center; position: absolute; bottom: 0; width: 100%;">
                                <?php echo htmlspecialchars($row['name']); ?>
                            </div>
                        </div>

                    <?php endwhile; ?>
                <?php else: ?>
                    <p style="text-align: center; grid-column: 1 / -1; padding: 50px; color: #666;">Belum ada foto dalam kategori ini.</p>
                <?php endif; ?>

            </div>
        </div>
    </section>
    
</body>
</html>
