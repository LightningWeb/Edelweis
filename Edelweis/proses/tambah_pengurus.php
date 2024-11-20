<?php
include "koneksi.php";

$no_anggota = isset($_POST['no_anggota']) ? htmlentities($_POST['no_anggota']) : "";
$nm_pengurus = isset($_POST['nm_pengurus']) ? htmlentities($_POST['nm_pengurus']) : "";
$jabatan = isset($_POST['jabatan']) ? htmlentities($_POST['jabatan']) : "";
$divisi = isset($_POST['divisi']) ? htmlentities($_POST['divisi']) : "";
$kegiatan = isset($_POST['kegiatan']) ? htmlentities($_POST['kegiatan']) : "";
$angkatan = isset($_POST['angkatan']) ? htmlentities($_POST['angkatan']) : "";

$kode_rand = rand(10000, 99999) . "-";
$target_dir = "../assets/img/";
$target_file = $target_dir . $kode_rand . basename($_FILES["foto"]["name"]);
$imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$statusUpload = 1; // Status upload awal
$message = ""; // Untuk menyimpan pesan error atau informasi

if ($_SERVER["REQUEST_METHOD"] === "POST") {  // Ganti pengecekan method POST
    // Cek apakah file yang diupload adalah gambar
    $cek = getimagesize($_FILES['foto']['tmp_name']);
    if ($cek === false) {
        $message = "Ini bukan file gambar.";
        $statusUpload = 0;
    } elseif (file_exists($target_file)) {
        $message = "Maaf, file yang dimasukkan sudah ada.";
        $statusUpload = 0;
    } elseif ($_FILES['foto']['size'] > 5000000) {  // Cek ukuran file (maksimal 5MB)
        $message = 'File foto yang diupload terlalu besar.';
        $statusUpload = 0;
    } elseif (!in_array($imageType, array("jpg", "jpeg", "png", "gif"))) {  // Cek format file
        $message = "Maaf, hanya format JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
        $statusUpload = 0;
    }

    if ($statusUpload == 0) {
        echo '<script>alert("' . $message . ' Gambar tidak dapat diupload."); window.location="../pengurus";</script>';
    } else {
        // Cek apakah nama pengurus sudah ada
        $select = mysqli_prepare($conn, "SELECT * FROM pengurus WHERE nm_pengurus = ?");
        mysqli_stmt_bind_param($select, "s", $nm_pengurus);
        mysqli_stmt_execute($select);
        mysqli_stmt_store_result($select);

        if (mysqli_stmt_num_rows($select) > 0) {
            echo '<script>alert("Nama pengurus yang dimasukkan sudah ada."); window.location="../pengurus";</script>';
        } else {
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                // Persiapkan query untuk memasukkan data
                $query = mysqli_prepare($conn, "INSERT INTO pengurus (foto, nm_pengurus, no_anggota, jabatan, divisi, kegiatan, angkatan)
                                                 VALUES (?, ?, ?, ?, ?, ?, ?)");
                $foto = $kode_rand . $_FILES["foto"]["name"];
                mysqli_stmt_bind_param($query, "sssssss", $foto, $nm_pengurus, $no_anggota, $jabatan, $divisi, $kegiatan, $angkatan);

                if (mysqli_stmt_execute($query)) {
                    echo '<script>alert("Data berhasil dimasukkan."); window.location="../pengurus";</script>';
                } else {
                    echo '<script>alert("Data gagal dimasukkan: ' . mysqli_error($conn) . '"); window.location="../pengurus";</script>';
                }
            } else {
                echo '<script>alert("Maaf, terjadi kesalahan. File tidak dapat diupload."); window.location="../pengurus";</script>';
            }
        }
        mysqli_stmt_close($select);
    }
}
?>
