<?php
include "connect.php";

$no_anggota = isset($_POST['no_anggota']) ? htmlentities($_POST['no_anggota']) : "";
$nm_pengurus = isset($_POST['nm_pengurus']) ? htmlentities($_POST['nm_pengurus']) : "";
$jabatan = isset($_POST['jabatan']) ? htmlentities($_POST['jabatan']) : "";
$divisi = isset($_POST['divisi']) ? htmlentities($_POST['divisi']) : "";
$kegiatan = isset($_POST['kegiatan']) ? htmlentities($_POST['kegiatan']) : "";
$angkatan = isset($_POST['angkatan']) ? htmlentities($_POST['angkatan']) : "";

$kode_rand = rand(10000, 99999) . "-";
$target_dir = "../assets/img/" . $kode_rand;
$target_file = $target_dir . basename($_FILES["foto"]["name"]);
$imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$message = ""; // Untuk menyimpan pesan
$statusUpload = 1; // Status upload awal

if (!empty($_POST['input_pengurus_validate'])) {
    // Cek apakah file yang diupload adalah gambar
    $cek = getimagesize($_FILES['foto']['tmp_name']);
    if ($cek === false) {
        $message = "Ini bukan file gambar.";
        $statusUpload = 0;
    } else {
        // Cek apakah file sudah ada
        if (file_exists($target_file)) {
            $message = "Maaf, file yang dimasukkan sudah ada.";
            $statusUpload = 0;
        } else {
            // Cek ukuran file (maksimal 500KB)
            if ($_FILES['foto']['size'] > 5000000) {
                $message = 'File foto yang diupload terlalu besar.';
                $statusUpload = 0;
            } else {
                // Cek format file
                if (!in_array($imageType, ["jpg", "jpeg", "png", "gif"])) {
                    $message = "Maaf, hanya format JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
                    $statusUpload = 0;
                }
            }
        }
    }

    // Jika ada masalah dengan upload
    if ($statusUpload == 0) {
        echo '<script>alert("' . $message . ' Gambar tidak dapat diupload."); window.location="../pengurus";</script>';
    } else {
        // Cek apakah nama menu sudah ada
        $select = mysqli_query($conn, "SELECT * FROM pengurus WHERE nm_pengurus = '$nm_pengurus'");
        if (mysqli_num_rows($select) > 0) {
            echo '<script>alert("Nama menu yang dimasukkan sudah ada."); window.location="../pengurus";</script>';
        } else {
            // Jika tidak ada masalah, simpan gambar dan masukkan data ke database
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                $query = mysqli_query($conn, "INSERT INTO pengurus (foto, nm_pengurus, no_anggota, jabatan, divisi, kegiatan, angkatan)
                    VALUES ('" . $kode_rand . $_FILES["foto"]["name"] . "', '$nm_pengurus', '$no_anggota', '$jabatan', '$divisi', '$kegiatan', '$angkatan')");
                
                if ($query) {
                    echo '<script>alert("Data berhasil dimasukkan."); window.location="../pengurus";</script>';
                } else {
                    echo '<script>alert("Data gagal dimasukkan."); window.location="../pengurus";</script>';
                }
            } else {
                echo '<script>alert("Maaf, terjadi kesalahan. File tidak dapat diupload."); window.location="../pengurus";</script>';
            }
        }
    }
}
?>
