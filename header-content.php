<?php
$base = '/project-web-sekolah/';
?>
<link rel="stylesheet" href="<?php echo $base; ?>style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- ── TOP BAR ── -->
<header class="top-bar">
    <div class="container">
        <div class="top-bar-info">
            <span><i class="fas fa-envelope"></i> smayari587@gmail.com</span>
            <span><i class="fas fa-phone"></i> +62-852-6302-7614</span>
            <span><i class="fas fa-map-marker-alt"></i> Jl. Batang Kandis 3-5, Alai Parak Kopi, Padang Baru Timur, Kota Padang</span>
        </div>
    </div>
</header>

<!-- ── NAVBAR ── -->
<nav class="navbar">
    <div class="container">
        <!-- Logo -->
        <div class="navbar-logo" style="display:flex;align-items:center;gap:12px;">
            <a href="/project-web-sekolah/index.php" style="position:static;display:flex;align-items:center;">
                <img src="<?php echo $base; ?>Yari_Logo.jpg" alt="Logo" style="height:44px;display:block;border-radius:6px;">
            </a>
            <div style="display:flex;flex-direction:column;line-height:1.2;">
                <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1rem;color:#001a3a;letter-spacing:-.2px;">SMA YARI SCHOOL</span>
                <span style="font-family:'Plus Jakarta Sans',sans-serif;font-size:.68rem;font-weight:500;color:#6b7280;letter-spacing:.04em;text-transform:uppercase;">Padang, Sumatera Barat</span>
            </div>
        </div>

        <!-- Links -->
        <ul class="navbar-links" style="display:flex;align-items:center;margin:0;padding:0;list-style:none;gap:4px;">
            <li><a href="/project-web-sekolah/index.php" class="nav-link">Beranda</a></li>
            <li><a href="/project-web-sekolah/profil.php" class="nav-link">Profil</a></li>

            <!-- Dropdown -->
            <li id="dir-li" style="position:relative;">
                <a href="#" id="dir-toggle" class="nav-link dir-toggle-btn">
                    Direktori
                    <svg id="dir-arrow" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transition:transform .2s;"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </a>
                <ul id="dir-menu">
                    <li><a href="/project-web-sekolah/direktori/direktori_guru.php"><i class="fas fa-chalkboard-teacher"></i><span>Guru</span></a></li>
                    <li><a href="/project-web-sekolah/direktori/direktori_tendik.php"><i class="fas fa-users-cog"></i><span>Tenaga Kependidikan</span></a></li>
                    <li><a href="/project-web-sekolah/direktori/direktori_siswa.php"><i class="fas fa-user-graduate"></i><span>Siswa Aktif</span></a></li>
                    <li><a href="/project-web-sekolah/direktori/direktori_alumni.php"><i class="fas fa-award"></i><span>Alumni</span></a></li>
                </ul>
            </li>

            <li><a href="/project-web-sekolah/galeri.php" class="nav-link">Galeri</a></li>
            <li><a href="/project-web-sekolah/pengumuman.php" class="nav-link">Pengumuman</a></li>
            <li><a href="/project-web-sekolah/admin/admin.html" class="nav-link">Admin</a></li>
        </ul>
    </div>
</nav>

<style>
/* ── Reset posisi absolut dari style.css ── */
.navbar {
    border-bottom: 1px solid #eef0f5 !important;
    box-shadow: 0 2px 16px rgba(0,26,58,.07) !important;
}
.navbar .container {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    padding: 10px 0 !important;
    position: relative;
}
.navbar-logo a { position: static !important; top: auto !important; left: auto !important; }
.navbar-logo h3 { position: static !important; top: auto !important; left: auto !important; }

/* ── Nav links ── */
.nav-link {
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    font-size: .875rem !important;
    font-weight: 500 !important;
    color: #4b5563 !important;
    text-decoration: none !important;
    padding: 8px 14px !important;
    border-radius: 8px !important;
    display: flex !important;
    align-items: center !important;
    gap: 5px !important;
    transition: background .18s, color .18s !important;
    border-bottom: none !important;
    white-space: nowrap;
}
.nav-link:hover {
    background: #f0f5ff !important;
    color: #004d99 !important;
    border-bottom: none !important;
}
.nav-link.active {
    background: #004d99 !important;
    color: #fff !important;
    font-weight: 600 !important;
    border-bottom: none !important;
}
.dir-toggle-btn.active {
    background: #004d99 !important;
    color: #fff !important;
}

/* ── Dropdown menu ── */
#dir-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    list-style: none;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 8px 32px rgba(0,26,58,.14), 0 0 0 1px rgba(0,0,0,.05);
    min-width: 230px;
    z-index: 1001;
    padding: 14px 6px 6px; /* padding-top jadi jembatan hover */
    margin: 0;
}
/* No arrow tip - clean */
#dir-menu li { list-style: none; }
#dir-menu li + li { border-top: 1px solid #f3f4f6; }
#dir-menu li a {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    padding: 10px 14px !important;
    color: #1f2937 !important;
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    font-size: .875rem !important;
    font-weight: 500 !important;
    text-decoration: none !important;
    border-radius: 8px !important;
    transition: background .15s, color .15s !important;
    border-bottom: none !important;
    white-space: nowrap;
}
#dir-menu li a:hover {
    background: #f0f5ff !important;
    color: #004d99 !important;
}
#dir-menu li a i {
    width: 30px; height: 30px;
    border-radius: 8px;
    background: #f0f5ff;
    color: #004d99;
    display: flex; align-items: center; justify-content: center;
    font-size: .8rem; flex-shrink: 0;
}

/* ── Top bar styling ── */
.top-bar {
    background: #001a3a !important;
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    font-size: .78rem !important;
    color: rgba(255,255,255,.65) !important;
    padding: 7px 0 !important;
}
.top-bar .container {
    max-width: 1200px; margin: 0 auto; padding: 0 1.5rem;
    display: flex; justify-content: center;
}
.top-bar-info { display: flex; gap: 2rem; flex-wrap: wrap; }
.top-bar-info span { display: flex; align-items: center; gap: 6px; }
.top-bar-info i { color: #ffd700; font-size: .75rem; }
</style>

<script>
(function() {
    var li     = document.getElementById('dir-li');
    var menu   = document.getElementById('dir-menu');
    var toggle = document.getElementById('dir-toggle');
    var arrow  = document.getElementById('dir-arrow');
    if (!li || !menu) return;

    li.addEventListener('mouseenter', function() {
        menu.style.display = 'block';
        if (arrow) arrow.style.transform = 'rotate(180deg)';
    });
    li.addEventListener('mouseleave', function() {
        menu.style.display = 'none';
        if (arrow) arrow.style.transform = 'rotate(0deg)';
    });

    // Aktifkan link sesuai halaman
    document.querySelectorAll('.nav-link').forEach(function(a) {
        var href = a.getAttribute('href');
        if (href && href !== '#' && window.location.pathname === href.replace('/project-web-sekolah','')) {
            a.classList.add('active');
        }
    });
    if (window.location.pathname.indexOf('/direktori/') !== -1 && toggle) {
        toggle.classList.add('active');
    }
})();
</script>