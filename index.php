<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMA YARI SCHOOL - Fun Learning For A Brighter Future</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #004d99;
            --navy-dark: #001a3a;
            --red: #c0392b;
            --green: #1e7e34;
            --gold: #c68a00;
            --white: #fff;
            --light: #f5f7fa;
            --gray: #6b7280;
        }

        body { font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; }

        /* ══ HERO ══ */
        .hero-section {
            position: relative;
            min-height: 88vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            background: var(--navy-dark);
        }
        .hero-bg {
            position: absolute; inset: 0;
            background: url('beranda_sekolah.jpg') center/cover no-repeat;
            transform: scale(1.05);
            animation: slowZoom 18s ease-in-out infinite alternate;
        }
        @keyframes slowZoom {
            from { transform: scale(1.05); }
            to   { transform: scale(1.12); }
        }
        .hero-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(
                120deg,
                rgba(0,26,58,.88) 0%,
                rgba(0,26,58,.70) 50%,
                rgba(0,77,153,.40) 100%
            );
        }
        .hero-dots {
            position: absolute; inset: 0;
            background-image: radial-gradient(rgba(255,255,255,.06) 1px, transparent 1px);
            background-size: 32px 32px;
        }
        .hero-content {
            position: relative; z-index: 2;
            max-width: 1200px; margin: 0 auto; padding: 0 1.5rem;
            width: 100%;
        }
        .hero-tag {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.2);
            color: rgba(255,255,255,.8);
            font-size: .78rem; font-weight: 600;
            letter-spacing: .08em; text-transform: uppercase;
            padding: 6px 16px; border-radius: 50px;
            margin-bottom: 24px;
            animation: fadeUp .6s ease both;
        }
        .hero-tag i { color: #ffd700; }
        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 5vw, 3.8rem);
            font-weight: 900;
            color: #fff;
            line-height: 1.15;
            margin: 0 0 20px;
            max-width: 700px;
            animation: fadeUp .7s .1s ease both;
        }
        .hero-title span { color: #ffd700; }
        .hero-sub {
            font-size: 1.05rem;
            color: rgba(255,255,255,.7);
            max-width: 520px;
            line-height: 1.7;
            margin: 0 0 36px;
            animation: fadeUp .7s .2s ease both;
        }
        .hero-actions {
            display: flex; gap: 14px; flex-wrap: wrap;
            animation: fadeUp .7s .3s ease both;
        }
        .btn-primary {
            background: linear-gradient(135deg, #004d99, #002f5f);
            color: #fff; border: none; border-radius: 8px;
            padding: 13px 28px; font-size: .95rem; font-weight: 700;
            cursor: pointer; text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 4px 20px rgba(0,77,153,.4);
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,77,153,.5); }
        .btn-outline {
            background: rgba(255,255,255,.1);
            backdrop-filter: blur(8px);
            color: #fff; border: 1.5px solid rgba(255,255,255,.35);
            border-radius: 8px; padding: 13px 28px;
            font-size: .95rem; font-weight: 600;
            cursor: pointer; text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
            transition: background .2s, border-color .2s;
        }
        .btn-outline:hover { background: rgba(255,255,255,.18); border-color: rgba(255,255,255,.6); }

        /* Stat strip */
        .hero-stats {
            position: absolute; bottom: 0; left: 0; right: 0; z-index: 2;
            background: rgba(0,26,58,.75);
            backdrop-filter: blur(12px);
            border-top: 1px solid rgba(255,255,255,.08);
            animation: fadeUp .7s .4s ease both;
        }
        .hero-stats .container {
            max-width: 1200px; margin: 0 auto; padding: 0 1.5rem;
            display: flex;
        }
        .stat-item {
            flex: 1; padding: 18px 24px;
            display: flex; align-items: center; gap: 14px;
            border-right: 1px solid rgba(255,255,255,.08);
        }
        .stat-item:last-child { border-right: none; }
        .stat-icon {
            width: 42px; height: 42px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; flex-shrink: 0;
        }
        .stat-icon.red   { background: rgba(192,57,43,.2); color: #ff8a7a; }
        .stat-icon.green { background: rgba(30,126,52,.2); color: #6fcf7f; }
        .stat-icon.gold  { background: rgba(198,138,0,.2); color: #ffd700; }
        .stat-icon.blue  { background: rgba(0,77,153,.3); color: #7ab8ff; }
        .stat-num { font-size: 1.4rem; font-weight: 700; color: #fff; line-height: 1; }
        .stat-lbl { font-size: .75rem; color: rgba(255,255,255,.55); margin-top: 2px; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ══ SECTION UMUM ══ */
        section { padding: 72px 0; }
        .section-label {
            display: inline-block;
            font-size: .75rem; font-weight: 700;
            letter-spacing: .1em; text-transform: uppercase;
            color: var(--navy); margin-bottom: 10px;
        }
        .section-label::before {
            content: ''; display: inline-block;
            width: 20px; height: 3px; background: currentColor;
            border-radius: 2px; margin-right: 8px; vertical-align: middle;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.6rem, 3vw, 2.2rem);
            font-weight: 700; color: #111;
            margin: 0 0 14px; line-height: 1.25;
        }
        .section-desc { color: var(--gray); font-size: .95rem; line-height: 1.7; max-width: 540px; }

        /* ══ MENU SHORTCUT ══ */
        .shortcut-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 48px;
        }
        .shortcut-card {
            border-radius: 16px; padding: 32px 24px;
            text-decoration: none; color: inherit;
            display: flex; flex-direction: column; gap: 16px;
            transition: transform .2s, box-shadow .2s;
            position: relative; overflow: hidden;
        }
        .shortcut-card::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(rgba(255,255,255,.07) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        .shortcut-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,.18); }
        .shortcut-card.c-red   { background: linear-gradient(135deg, #c0392b, #8b1a1a); }
        .shortcut-card.c-green { background: linear-gradient(135deg, #1e7e34, #0a3516); }
        .shortcut-card.c-gold  { background: linear-gradient(135deg, #c68a00, #4a3200); }
        .shortcut-card.c-blue  { background: linear-gradient(135deg, #004d99, #001a3a); }
        .shortcut-icon {
            width: 52px; height: 52px; border-radius: 14px;
            background: rgba(30,30,30,.25); border: 2px solid rgba(255,255,255,.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; color: rgba(255,255,255,.85);
        }
        .shortcut-card h3 { font-size: 1.1rem; font-weight: 700; color: #fff; margin: 0; }
        .shortcut-card p  { font-size: .83rem; color: rgba(255,255,255,.65); margin: 0; line-height: 1.5; }
        .shortcut-arrow {
            margin-top: auto; color: rgba(255,255,255,.5);
            font-size: .85rem; display: flex; align-items: center; gap: 6px;
            transition: gap .2s, color .2s;
        }
        .shortcut-card:hover .shortcut-arrow { gap: 10px; color: rgba(255,255,255,.9); }

        /* ══ TENTANG KAMI ══ */
        .about-section { background: var(--light); }
        .about-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;
        }
        .about-img-wrap {
            position: relative; border-radius: 20px; overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,.15);
        }
        .about-img-wrap img { width: 100%; height: 380px; object-fit: cover; display: block; }
        .about-img-badge {
            position: absolute; bottom: 20px; left: 20px;
            background: rgba(0,26,58,.85); backdrop-filter: blur(8px);
            color: #fff; padding: 12px 20px; border-radius: 12px;
            border: 1px solid rgba(255,255,255,.15);
        }
        .about-img-badge strong { display: block; font-size: 1.3rem; font-weight: 700; color: #ffd700; }
        .about-img-badge span  { font-size: .78rem; color: rgba(255,255,255,.65); }
        .visi-misi { margin-top: 28px; display: flex; flex-direction: column; gap: 14px; }
        .vm-card {
            display: flex; gap: 14px; align-items: flex-start;
            background: #fff; border-radius: 12px; padding: 16px 18px;
            box-shadow: 0 2px 10px rgba(0,0,0,.06);
        }
        .vm-icon {
            width: 38px; height: 38px; border-radius: 10px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center; font-size: .95rem;
        }
        .vm-icon.blue  { background: #dbeafe; color: #004d99; }
        .vm-icon.green { background: #d1fae5; color: #1e7e34; }
        .vm-card h4 { margin: 0 0 4px; font-size: .9rem; font-weight: 700; color: #111; }
        .vm-card p  { margin: 0; font-size: .82rem; color: var(--gray); line-height: 1.5; }

        /* ══ PENGUMUMAN ══ */
        .announce-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 40px; }
        .announce-card {
            background: #fff; border-radius: 14px; padding: 22px;
            box-shadow: 0 2px 12px rgba(0,0,0,.07);
            border-left: 4px solid var(--navy);
            transition: transform .2s, box-shadow .2s;
        }
        .announce-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.1); }
        .announce-card.urgent { border-left-color: var(--red); }
        .announce-card.event  { border-left-color: var(--green); }
        .announce-meta { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
        .announce-tag {
            font-size: .7rem; font-weight: 700; padding: 3px 10px;
            border-radius: 4px; text-transform: uppercase;
        }
        .announce-tag.urgent { background: #fde8e8; color: var(--red); }
        .announce-tag.event  { background: #d1fae5; color: var(--green); }
        .announce-date { font-size: .78rem; color: var(--gray); }
        .announce-card h3 { font-size: .98rem; font-weight: 700; color: #111; margin: 0 0 8px; }
        .announce-card p  { font-size: .83rem; color: var(--gray); line-height: 1.55; margin: 0 0 14px; }
        .announce-link { font-size: .82rem; font-weight: 700; color: var(--navy); text-decoration: none; }
        .announce-link:hover { text-decoration: underline; }

        /* ══ CTA BOTTOM ══ */
        .cta-section {
            background: linear-gradient(135deg, var(--navy-dark), #004d99);
            position: relative; overflow: hidden; text-align: center;
        }
        .cta-section::after {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(rgba(255,255,255,.05) 1px, transparent 1px);
            background-size: 28px 28px;
        }
        .cta-section .container { position: relative; z-index: 1; }
        .cta-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.6rem, 3vw, 2.4rem);
            color: #fff; margin: 0 0 14px;
        }
        .cta-section p { color: rgba(255,255,255,.65); font-size: .95rem; margin: 0 0 32px; }

        @media(max-width: 900px) {
            .shortcut-grid { grid-template-columns: repeat(2,1fr); }
            .about-grid { grid-template-columns: 1fr; }
            .announce-grid { grid-template-columns: 1fr; }
        }
        @media(max-width: 600px) {
            .shortcut-grid { grid-template-columns: 1fr 1fr; }
            .hero-stats .container { flex-wrap: wrap; }
            .stat-item { flex: 50%; border-right: none; border-bottom: 1px solid rgba(255,255,255,.08); }
        }
    </style>
</head>
<body>

<?php include 'header-content.php'; ?>

<!-- ══ HERO ══ -->
<section class="hero-section" id="beranda">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-dots"></div>
    <div class="hero-content">
        <div class="hero-tag"><i class="fas fa-star"></i> Selamat Datang di SMA YARI SCHOOL</div>
        <h1 class="hero-title">
            Fun Learning For A<br><span>Brighter Future</span>
        </h1>
        <p class="hero-sub">
            Memberikan pendidikan berkualitas dengan suasana belajar yang menyenangkan
            di Kota Padang sejak bertahun-tahun lamanya.
        </p>
        <div class="hero-actions">
            <a href="/project-web-sekolah/profil.php" class="btn-primary">
                <i class="fas fa-school"></i> Tentang Sekolah
            </a>
            <a href="/project-web-sekolah/direktori/direktori_guru.php" class="btn-outline">
                <i class="fas fa-users"></i> Lihat Direktori
            </a>
        </div>
    </div>
    <div class="hero-stats">
        <div class="container">
            <div class="stat-item">
                <div class="stat-icon red"><i class="fas fa-chalkboard-teacher"></i></div>
                <div>
                    <div class="stat-num">25+</div>
                    <div class="stat-lbl">Tenaga Pengajar</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon green"><i class="fas fa-user-graduate"></i></div>
                <div>
                    <div class="stat-num">300+</div>
                    <div class="stat-lbl">Siswa Aktif</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon gold"><i class="fas fa-award"></i></div>
                <div>
                    <div class="stat-num">500+</div>
                    <div class="stat-lbl">Alumni</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon blue"><i class="fas fa-trophy"></i></div>
                <div>
                    <div class="stat-num">50+</div>
                    <div class="stat-lbl">Prestasi</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ SHORTCUT MENU ══ -->
<section style="background:#fff; padding: 64px 0;">
    <div class="container" style="max-width:1200px;margin:0 auto;padding:0 1.5rem;">
        <div style="text-align:center;">
            <span class="section-label">Navigasi Cepat</span>
            <h2 class="section-title" style="margin:0 auto;">Akses Halaman Utama</h2>
        </div>
        <div class="shortcut-grid">
            <a href="/project-web-sekolah/profil.php" class="shortcut-card c-blue">
                <div class="shortcut-icon"><i class="fas fa-school"></i></div>
                <h3>Profil Sekolah</h3>
                <p>Visi, misi, sejarah, dan informasi lengkap sekolah kami.</p>
                <div class="shortcut-arrow">Selengkapnya <i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="/project-web-sekolah/direktori/direktori_guru.php" class="shortcut-card c-red">
                <div class="shortcut-icon"><i class="fas fa-address-book"></i></div>
                <h3>Direktori</h3>
                <p>Data guru, tendik, siswa aktif, dan alumni sekolah.</p>
                <div class="shortcut-arrow">Selengkapnya <i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="/project-web-sekolah/galeri.php" class="shortcut-card c-green">
                <div class="shortcut-icon"><i class="fas fa-images"></i></div>
                <h3>Galeri</h3>
                <p>Dokumentasi kegiatan dan momen berharga sekolah.</p>
                <div class="shortcut-arrow">Selengkapnya <i class="fas fa-arrow-right"></i></div>
            </a>
            <a href="/project-web-sekolah/pengumuman.php" class="shortcut-card c-gold">
                <div class="shortcut-icon"><i class="fas fa-bullhorn"></i></div>
                <h3>Pengumuman</h3>
                <p>Informasi terbaru kegiatan dan kebijakan sekolah.</p>
                <div class="shortcut-arrow">Selengkapnya <i class="fas fa-arrow-right"></i></div>
            </a>
        </div>
    </div>
</section>

<!-- ══ TENTANG ══ -->
<section class="about-section" id="profil">
    <div class="container" style="max-width:1200px;margin:0 auto;padding:0 1.5rem;">
        <div class="about-grid">
            <div class="about-img-wrap">
                <img src="beranda_sekolah.jpg" alt="Gedung SMA YARI SCHOOL">
            </div>
            <div>
                <span class="section-label">Tentang Kami</span>
                <h2 class="section-title">Sekolah Unggulan<br>di Kota Padang</h2>
                <p class="section-desc">
                    SMA YARI SCHOOL berkomitmen menciptakan lingkungan belajar yang menyenangkan,
                    inovatif, dan berprestasi. Kami mendidik generasi penerus bangsa dengan
                    fondasi akademik kuat dan karakter yang mulia.
                </p>
                <div class="visi-misi">
                    <div class="vm-card">
                        <div class="vm-icon blue"><i class="fas fa-eye"></i></div>
                        <div>
                            <h4>Visi</h4>
                            <p>Menjadi sekolah unggulan yang melahirkan generasi cerdas, berkarakter, dan berdaya saing global.</p>
                        </div>
                    </div>
                    <div class="vm-card">
                        <div class="vm-icon green"><i class="fas fa-bullseye"></i></div>
                        <div>
                            <h4>Misi</h4>
                            <p>Menyelenggarakan pendidikan berkualitas dengan suasana fun learning yang mendorong kreativitas dan prestasi siswa.</p>
                        </div>
                    </div>
                </div>
                <a href="/project-web-sekolah/profil.php" class="btn-primary" style="margin-top:24px;display:inline-flex;">
                    <i class="fas fa-arrow-right"></i> Lihat Profil Lengkap
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ══ PENGUMUMAN ══ -->
<section id="pengumuman" style="background:#fff;">
    <div class="container" style="max-width:1200px;margin:0 auto;padding:0 1.5rem;">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:16px;">
            <div>
                <span class="section-label">Terbaru</span>
                <h2 class="section-title" style="margin:0;">Pengumuman Sekolah</h2>
            </div>
            <a href="/project-web-sekolah/pengumuman.php" style="color:var(--navy);font-weight:600;font-size:.88rem;text-decoration:none;">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <div class="announce-grid">
            <div class="announce-card urgent">
                <div class="announce-meta">
                    <span class="announce-tag urgent">Penting</span>
                    <span class="announce-date"><i class="far fa-calendar-alt"></i> 20 Januari 2026</span>
                </div>
                <h3>Pelaksanaan Ujian Tengah Semester Genap 2026</h3>
                <p>Diberitahukan kepada seluruh siswa kelas X, XI, dan XII bahwa UTS akan dilaksanakan mulai tanggal 2 Februari 2026.</p>
                <a href="/project-web-sekolah/pengumuman.php" class="announce-link">Selengkapnya &rarr;</a>
            </div>
            <div class="announce-card event">
                <div class="announce-meta">
                    <span class="announce-tag event">Kegiatan</span>
                    <span class="announce-date"><i class="far fa-calendar-alt"></i> 15 Januari 2026</span>
                </div>
                <h3>Lomba Kebersihan Kelas Antar Angkatan</h3>
                <p>Dalam rangka memperingati HUT Sekolah, OSIS SMA YARI SCHOOL mengadakan lomba kebersihan kelas dengan total hadiah jutaan rupiah.</p>
                <a href="/project-web-sekolah/pengumuman.php" class="announce-link">Selengkapnya &rarr;</a>
            </div>
        </div>
    </div>
</section>

<!-- ══ CTA ══ -->
<section class="cta-section">
    <div class="container" style="max-width:1200px;margin:0 auto;padding:0 1.5rem;">
        <h2>Bergabunglah Bersama Kami</h2>
        <p>Daftarkan putra-putri Anda di SMA YARI SCHOOL dan rasakan pengalaman belajar yang menyenangkan.</p>
        <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
            <a href="/project-web-sekolah/profil.php" class="btn-primary">
                <i class="fas fa-info-circle"></i> Informasi Pendaftaran
            </a>
            <a href="/project-web-sekolah/direktori/direktori_siswa.php" class="btn-outline">
                <i class="fas fa-user-graduate"></i> Lihat Siswa Aktif
            </a>
        </div>
    </div>
</section>

</body>
</html>