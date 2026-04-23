<?php
    session_start();
    require_once '../../koneksi.php';

    // 1. PROTEKSI LOGIN
    if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
        header("Location: ../../admin.html");
        exit();
    }

    // 2. LOGIKA TAMBAH
    // Note: Pastikan name di tombol submit modal Anda adalah 'simpan' atau 'submit'
    if (isset($_POST['simpan']) || isset($_POST['submit'])) {
        $judul = mysqli_real_escape_string($conn, $_POST['judul']);
        $isi = mysqli_real_escape_string($conn, $_POST['isi']);
        $kategori = mysqli_real_escape_string($conn, $_POST['kategori']); // Tambahkan ini
        
        // Menggunakan tanggal dari input form, atau current time jika kosong
        $tanggal = !empty($_POST['tanggal']) ? $_POST['tanggal'] : date('Y-m-d');

        // Pastikan kolom di tabel 'pengumuman' Anda sudah ada: judul, isi, kategori, tanggal
        $query = "INSERT INTO pengumuman (judul, isi, kategori, tanggal) 
                  VALUES ('$judul', '$isi', '$kategori', '$tanggal')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Pengumuman berhasil ditambahkan!'); window.location='index.php';</script>";
        } else {
            // Menampilkan error mysqli untuk memudahkan debugging saat development
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        header("Location: index.php");
        exit();
    }
?>