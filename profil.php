<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Sekolah - SMA YARI SCHOOL</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f5f7fa; }
        html {
    scroll-behavior: smooth;
    scroll-padding-top: 80px; /* tinggi header lo */
    -ms-overflow-style: none;
    scrollbar-width: none;
}
        html::-webkit-scrollbar {
    display: none;
}

        /* ── HERO ── */
        .page-hero {
            background: linear-gradient(135deg, #004d99 0%, #002f5f 60%, #001a3a 100%);
            padding: 22px 0 20px; position: relative; overflow: hidden;
        }
        .page-hero::before { content:''; position:absolute; inset:0;
            background-image: radial-gradient(circle at 15% 60%, rgba(255,215,0,.08) 0%, transparent 50%),
                              radial-gradient(circle at 85% 20%, rgba(255,255,255,.04) 0%, transparent 40%); }
        .page-hero::after  { content:''; position:absolute; inset:0;
            background-image: radial-gradient(rgba(255,255,255,.06) 1px, transparent 1px);
            background-size: 28px 28px; }
        .page-hero .container { position:relative; z-index:1; }
        .page-breadcrumb { display:flex; align-items:center; gap:6px; font-size:.82em; color:rgba(255,255,255,.5); margin-bottom:14px; }
        .page-breadcrumb a { color:rgba(255,255,255,.7); text-decoration:none; }
        .page-breadcrumb a:hover { color:#fff; }
        .page-breadcrumb i { font-size:.65em; color:rgba(255,255,255,.4); }
        .page-breadcrumb .current { color:rgba(255,255,255,.9); }
        .page-hero-body { display:flex; align-items:center; gap:20px; }
        .page-hero-icon { width:64px; height:64px; background:rgba(255,255,255,.1); border:1px solid rgba(255,255,255,.2); border-radius:16px; display:flex; align-items:center; justify-content:center; font-size:1.7rem; color:#fff; }
        .page-hero-text h1 { font-size:1.9em; font-weight:700; color:#fff; margin:0 0 6px; }
        .page-hero-text p  { color:rgba(255,255,255,.65); font-size:.92em; margin:0; }
        .page-hero-badge { margin-left:auto; background:rgba(255,255,255,.12);
            border:1px solid rgba(255,255,255,.2); color:rgba(255,255,255,.75);
            font-size:.8em; font-weight:600; padding:6px 16px;
            border-radius:50px; white-space:nowrap; flex-shrink:0; }

        /* ── ANCHOR NAV ── */
        .profil-nav { background:#fff; border-bottom:1px solid #e5e7eb; position:sticky; top:0; z-index:100; }
        .profil-nav .container { display:flex; gap:0; overflow-x:auto; }
        .profil-nav a { padding:13px 18px; font-size:.82rem; font-weight:600; color:#6b7280;
            text-decoration:none; white-space:nowrap; border-bottom:3px solid transparent; transition:color .18s, border-color .18s; }
        .profil-nav a:hover, .profil-nav a.active { color:#004d99; border-bottom-color:#004d99; }

        /* ── MAIN WRAP ── */
        .profil-wrap { max-width:1100px; margin:36px auto 60px; padding:0 1.5rem; }

        /* ── SECTION CARD ── */
        .profil-card { background:#fff; border-radius:14px; box-shadow:0 2px 12px rgba(0,0,0,.07); padding:28px 30px; margin-bottom:20px; }
        .card-heading { display:flex; align-items:center; gap:10px; margin-bottom:20px; padding-bottom:14px; border-bottom:1px solid #f3f4f6; }
        .card-heading i { width:36px; height:36px; border-radius:9px; background:#dbeafe; color:#004d99;
            display:flex; align-items:center; justify-content:center; font-size:.9rem; flex-shrink:0; }
        .card-heading i.green { background:#d1fae5; color:#1e7e34; }
        .card-heading i.gold  { background:#fef9c3; color:#c68a00; }
        .card-heading i.red   { background:#fde8e8; color:#c0392b; }
        .card-heading h2 { font-size:1rem; font-weight:700; color:#111; margin:0; }

        /* ── IDENTITAS ── */
        .id-grid { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
        @media(max-width:600px){ .id-grid{grid-template-columns:1fr;} }
        .id-row { display:flex; gap:10px; align-items:flex-start; padding:12px 14px; border:1px solid #f3f4f6; border-radius:10px; }
        .id-row i { color:#004d99; width:16px; flex-shrink:0; margin-top:2px; font-size:.85rem; }
        .id-label { font-size:.75rem; color:#6b7280; margin-bottom:2px; }
        .id-val   { font-size:.875rem; font-weight:600; color:#111; }

        /* ── VISI ── */
        .visi-text { font-size:.95rem; color:#1f2937; line-height:1.8; background:#f0f5ff; border-left:4px solid #004d99; padding:16px 18px; border-radius:0 10px 10px 0; }

        /* ── MISI LIST ── */
        .num-list { list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:8px; }
        .num-list li { display:flex; gap:10px; align-items:flex-start; font-size:.9rem; color:#374151; line-height:1.6; }
        .num-badge { width:24px; height:24px; border-radius:50%; background:#004d99; color:#fff;
            font-size:.72rem; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:1px; }
        .num-badge.green { background:#1e7e34; }

        /* ── 2-COL GRID ── */
        .two-col { display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-top:4px; }
        @media(max-width:600px){ .two-col{grid-template-columns:1fr;} }
        .item-row { display:flex; gap:10px; align-items:flex-start; font-size:.875rem; color:#374151; line-height:1.55; padding:10px 12px; background:#f9fafb; border-radius:8px; }
        .item-row i { color:#004d99; flex-shrink:0; margin-top:2px; width:14px; }

        /* ── EKSKUL TAGS ── */
        .tag-wrap { display:flex; flex-wrap:wrap; gap:8px; }
        .pill { background:#f0f5ff; border:1.5px solid #dbeafe; color:#004d99;
            font-size:.82rem; font-weight:600; padding:6px 16px; border-radius:50px;
            display:flex; align-items:center; gap:6px; }

        /* ── PARTNER ── */
        .partner-grid { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
        @media(max-width:600px){ .partner-grid{grid-template-columns:1fr;} }
        .partner-card { border:1px solid #e5e7eb; border-radius:10px; padding:16px 18px; }
        .partner-card .flag { font-size:1.6rem; margin-bottom:8px; }
        .partner-card h3 { font-size:.9rem; font-weight:700; color:#111; margin:0 0 5px; }
        .partner-card p  { font-size:.82rem; color:#6b7280; margin:0; line-height:1.55; }

        /* ── KURIKULUM ── */
        .check-list { list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:8px; }
        .check-list li { display:flex; gap:10px; align-items:flex-start; font-size:.9rem; color:#374151; line-height:1.6; }
        .check-list li i { color:#1e7e34; margin-top:2px; flex-shrink:0; }

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
            <span class="current">Profil</span>
        </div>
        <div class="page-hero-body">
            <div class="page-hero-icon"><i class="fas fa-school"></i></div>
            <div class="page-hero-text">
                <h1>Profil Sekolah</h1>
                <p>Sejarah, visi, misi, dan informasi lengkap SMA YARI SCHOOL</p>
            </div>
            <div class="page-hero-badge"><i class="fas fa-info-circle" style="margin-right:5px;"></i>Tentang Kami</div>
        </div>
    </div>
</div>

<!-- ANCHOR NAV -->
<nav class="profil-nav">
    <div class="container">
        <a href="#identitas">Identitas</a>
        <a href="#visi-misi">Visi & Misi</a>
        <a href="#tujuan">Tujuan</a>
        <a href="#keunggulan">Keunggulan</a>
        <a href="#fasilitas">Fasilitas</a>
        <a href="#kurikulum">Kurikulum</a>
        <a href="#ekskul">Ekstrakurikuler</a>
        <a href="#partner">Mitra Sekolah</a>
        <a href="#kontak">Kontak</a>
    </div>
</nav>

<div class="profil-wrap">

    <!-- IDENTITAS -->
    <div class="profil-card" id="identitas">
        <div class="card-heading">
            <i class="fas fa-id-card"></i>
            <h2>Identitas Sekolah</h2>
        </div>
        <div class="id-grid">
            <div class="id-row">
                <i class="fas fa-school"></i>
                <div><div class="id-label">Nama Sekolah</div><div class="id-val">SMA YARI SCHOOL</div></div>
            </div>
            <div class="id-row">
                <i class="fas fa-map-marker-alt"></i>
                <div><div class="id-label">Alamat</div><div class="id-val">Jl. Batang Kandis No. 3-5, Padang Baru, Sumatera Barat</div></div>
            </div>
            <div class="id-row">
                <i class="fas fa-phone"></i>
                <div><div class="id-label">Kontak</div><div class="id-val">Ms. Meri: +62 852-6302-7614<br>Ms. Nisa: +62 812-6172-2968</div></div>
            </div>
            <div class="id-row">
                <i class="fas fa-envelope"></i>
                <div><div class="id-label">Email</div><div class="id-val">smayari587@gmail.com</div></div>
            </div>
        </div>
    </div>

    <!-- VISI & MISI -->
    <div class="profil-card" id="visi-misi">
        <div class="card-heading">
            <i class="fas fa-eye"></i>
            <h2>Visi & Misi</h2>
        </div>
        <p style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:#6b7280;margin:0 0 8px;">Visi</p>
        <div class="visi-text">
            Berkarakter, terampil, berprestasi, dan berwawasan global serta berkebudayaan lingkungan sesuai dengan Profil Pelajar Pancasila.
        </div>
        <p style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:#6b7280;margin:20px 0 10px;">Misi</p>
        <ul class="num-list">
            <li><div class="num-badge">1</div><span>Peningkatan karakter yang cerdas emotional, spiritual, dan intelektual.</span></li>
            <li><div class="num-badge">2</div><span>Peningkatan Ilmu Pengetahuan, Teknologi Informasi, Olahraga, Seni dan Kebudayaan.</span></li>
            <li><div class="num-badge">3</div><span>Peningkatan kemampuan berkomunikasi dalam bahasa Jerman dan bahasa Inggris.</span></li>
            <li><div class="num-badge">4</div><span>Mewujudkan pertukaran budaya melalui students exchange program.</span></li>
            <li><div class="num-badge">5</div><span>Peningkatan prestasi akademik maupun non akademik.</span></li>
            <li><div class="num-badge">6</div><span>Mewujudkan wawasan luas berbasis IPTEK serta berwawasan internasional tanpa meninggalkan akar budaya bangsa.</span></li>
            <li><div class="num-badge">7</div><span>Mewujudkan kesadaran diri untuk menjaga kelestarian lingkungan dengan konsep 5R (Reduce, Reuse, Recycle, Replace, Replant).</span></li>
        </ul>
    </div>

    <!-- TUJUAN -->
    <div class="profil-card" id="tujuan">
        <div class="card-heading">
            <i class="fas fa-bullseye green"></i>
            <h2>Tujuan Sekolah</h2>
        </div>
        <ul class="num-list">
            <li><div class="num-badge green">1</div><span>Meningkatnya karakter yang cerdas emotional, spiritual, dan intelektual pada peserta didik.</span></li>
            <li><div class="num-badge green">2</div><span>Meningkatnya Ilmu Pengetahuan, Teknologi Informasi, Olahraga, Seni dan Kebudayaan.</span></li>
            <li><div class="num-badge green">3</div><span>Terwujudnya peserta didik berwawasan luas berbasis IPTEK serta berwawasan internasional tanpa meninggalkan akar budaya bangsa.</span></li>
            <li><div class="num-badge green">4</div><span>Terwujudnya kesadaran diri untuk menjaga kelestarian lingkungan dengan konsep 5R (Reduce, Reuse, Recycle, Replace, Replant).</span></li>
        </ul>
    </div>

    <!-- KEUNGGULAN -->
    <div class="profil-card" id="keunggulan">
        <div class="card-heading">
            <i class="fas fa-star gold"></i>
            <h2>Keunggulan & Filosofi</h2>
        </div>
        <div class="two-col">
            <div class="item-row"><i class="fas fa-check-circle"></i><span>Tenaga pendidik terpilih, bermotivasi tinggi, mandiri, kritis, dan memahami perkembangan anak.</span></div>
            <div class="item-row"><i class="fas fa-check-circle"></i><span>Program students exchange ke Jerman dan Finlandia untuk wawasan global.</span></div>
            <div class="item-row"><i class="fas fa-check-circle"></i><span>Pengembangan kecerdasan emotional, intelektual, spiritual, sosial, bahasa dan fisik secara holistik.</span></div>
            <div class="item-row"><i class="fas fa-check-circle"></i><span>Konseling akademis dan pembinaan berkala bagi siswa dan orang tua.</span></div>
            <div class="item-row"><i class="fas fa-check-circle"></i><span>Program peduli lingkungan: apotik hidup dan eco-enzyme.</span></div>
            <div class="item-row"><i class="fas fa-check-circle"></i><span>Persiapan intensif untuk kejuaraan olimpiade akademik dan non-akademik.</span></div>
        </div>
        <div style="margin-top:16px; background:#fffbeb; border:1px solid #fde68a; border-radius:10px; padding:14px 16px;">
            <p style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:#92610a;margin:0 0 6px;">Filosofi YARI SCHOOL</p>
            <p style="font-size:.875rem;color:#374151;line-height:1.75;margin:0;">
                Mengembangkan kecerdasan emotional, intelektual, spiritual, sosial, bahasa dan fisik sesuai minat, bakat, serta kebutuhan masing-masing anak didik dalam suasana yang hangat, penuh kasih sayang, dan kepedulian.
            </p>
        </div>
    </div>

    <!-- FASILITAS -->
    <div class="profil-card" id="fasilitas">
        <div class="card-heading">
            <i class="fas fa-building"></i>
            <h2>Fasilitas Sekolah</h2>
        </div>
        <div class="two-col">
            <div class="item-row"><i class="fas fa-snowflake"></i><span>Ruang belajar dilengkapi AC</span></div>
            <div class="item-row"><i class="fas fa-tv"></i><span>Media belajar memakai Proyektor</span></div>
            <div class="item-row"><i class="fas fa-book"></i><span>Perpustakaan dengan buku dalam & luar negeri</span></div>
            <div class="item-row"><i class="fas fa-desktop"></i><span>Labor komputer dengan akses internet</span></div>
            <div class="item-row"><i class="fas fa-flask"></i><span>Labor Kimia</span></div>
            <div class="item-row"><i class="fas fa-atom"></i><span>Labor Fisika</span></div>
            <div class="item-row"><i class="fas fa-dna"></i><span>Labor Biologi</span></div>
            <div class="item-row"><i class="fas fa-utensils"></i><span>Ruang Makan</span></div>
            <div class="item-row"><i class="fas fa-medkit"></i><span>Ruang UKS</span></div>
        </div>
    </div>

    <!-- KURIKULUM -->
    <div class="profil-card" id="kurikulum">
        <div class="card-heading">
            <i class="fas fa-graduation-cap green"></i>
            <h2>Kurikulum</h2>
        </div>
        <p style="font-size:.875rem;color:#6b7280;margin:0 0 14px;">Kurikulum Nasional yang diperkaya dengan:</p>
        <ul class="check-list">
            <li><i class="fas fa-check-circle"></i><span>Pengantar berbahasa Inggris.</span></li>
            <li><i class="fas fa-check-circle"></i><span>Problem solving.</span></li>
            <li><i class="fas fa-check-circle"></i><span>Character building dan pembinaan moral berpedoman langsung pada Kitab Suci.</span></li>
            <li><i class="fas fa-check-circle"></i><span>Pembelajaran berbasis ICT.</span></li>
            <li><i class="fas fa-check-circle"></i><span>Program pertukaran pelajar dengan Dr. Wilhelm-Andre Gymnasium, Chemnitz, Jerman dan Eno School, Finland.</span></li>
            <li><i class="fas fa-check-circle"></i><span>Menggali potensi leadership dan entrepreneurship.</span></li>
            <li><i class="fas fa-check-circle"></i><span>Kegiatan peduli sosial: donasi, butik ikhlas, posyandu, dll.</span></li>
            <li><i class="fas fa-check-circle"></i><span>Program peduli lingkungan: apotik hidup dan eco-enzyme.</span></li>
            <li><i class="fas fa-check-circle"></i><span>Persiapan untuk mengikuti kejuaraan olimpiade.</span></li>
            <li><i class="fas fa-check-circle"></i><span>Outing dan outbond.</span></li>
        </ul>
    </div>

    <!-- EKSKUL -->
    <div class="profil-card" id="ekskul">
        <div class="card-heading">
            <i class="fas fa-star red"></i>
            <h2>Ekstrakurikuler</h2>
        </div>
        <div class="tag-wrap">
            <div class="pill"><i class="fas fa-quran"></i> Al-Qur'an</div>
            <div class="pill"><i class="fas fa-futbol"></i> Futsal</div>
            <div class="pill"><i class="fas fa-swimmer"></i> Swimming</div>
            <div class="pill"><i class="fas fa-campground"></i> Pramuka</div>
        </div>
    </div>

    <!-- PARTNER -->
    <div class="profil-card" id="partner">
        <div class="card-heading">
            <i class="fas fa-globe"></i>
            <h2>Mitra Sekolah</h2>
        </div>
        <div class="partner-grid">
            <div class="partner-card">
                <div class="flag">🇩🇪</div>
                <h3>Dr. Wilhelm-Andre Gymnasium</h3>
                <p>Chemnitz, Jerman — program pertukaran pelajar untuk meningkatkan kemampuan bahasa Jerman dan wawasan Eropa.</p>
            </div>
            <div class="partner-card">
                <div class="flag">🇫🇮</div>
                <h3>Eno School</h3>
                <p>Finland — kolaborasi program lingkungan dan pertukaran pelajar untuk memperluas wawasan internasional siswa.</p>
            </div>
        </div>
    </div>

    <!-- KONTAK -->
    <div class="profil-card" id="kontak">
        <div class="card-heading">
            <i class="fas fa-address-book"></i>
            <h2>Kontak</h2>
        </div>
        <div class="two-col">
            <div class="id-row"><i class="fas fa-map-marker-alt"></i>
                <div><div class="id-label">Alamat</div><div class="id-val">Jl. Batang Kandis No. 3-5, Padang Baru, Sumatera Barat</div></div>
            </div>
            <div class="id-row"><i class="fab fa-whatsapp" style="color:#25d366;"></i>
                <div><div class="id-label">WhatsApp</div><div class="id-val">Ms. Meri: +62 852-6302-7614<br>Ms. Nisa: +62 812-6172-2968</div></div>
            </div>
        </div>
    </div>

</div><!-- end profil-wrap -->

<script>
const sections = document.querySelectorAll('.profil-card[id]');
const navLinks  = document.querySelectorAll('.profil-nav a');
window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(s => { if (window.scrollY >= s.offsetTop - 110) current = s.id; });
    navLinks.forEach(a => a.classList.toggle('active', a.getAttribute('href') === '#' + current));
});
</script>
</body>
</html>