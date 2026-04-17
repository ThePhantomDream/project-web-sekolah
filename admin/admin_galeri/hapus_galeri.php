<?php
    session_start(); //Tambahkan ini untuk memulai session

    require_once '../../koneksi.php';

    if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
        header("Location: ../../admin.html");
        exit();
    }

    if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 3. Cari nama file gambar di database sebelum datanya dihapus
    // Ini penting agar kita bisa menghapus file fisiknya dari folder
    $query_select = mysqli_query($conn, "SELECT gambar FROM galeri WHERE id = '$id'");
    $data = mysqli_fetch_assoc($query_select);
    if ($data) {
        $nama_file = $data['gambar'];
        $target_file = "store_galeri/" . $nama_file;

        // 4. Hapus file fisik dari folder store_galeri jika file tersebut ada
        if (file_exists($target_file)) {
            unlink($target_file);
        }
        // 5. Hapus baris data (seluruh kartu) dari database
        $query_delete = mysqli_query($conn, "DELETE FROM galeri WHERE id = '$id'");

        if ($query_delete) {
            // Berhasil: Alihkan kembali ke halaman daftar galeri admin
            echo "<script>
                    alert('Kartu berhasil dihapus selamanya!');
                    window.location.href = 'index.php'; 
                  </script>";
        } else {
            // Gagal menghapus di database
            echo "<script>
                    alert('Gagal menghapus data di database.');
                    window.location.href = 'index.php';
                  </script>";
        }
    } else {
        // ID tidak ditemukan
        echo "<script>
                alert('Data tidak ditemukan.');
                window.location.href = 'index.php';
              </script>";
    }
} else {
    // Jika tidak ada ID yang dikirim
    header("Location: index.php");
}

?>