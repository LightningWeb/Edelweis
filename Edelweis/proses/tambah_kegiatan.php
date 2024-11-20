<?php
// Koneksi ke database
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama_kegiatan = mysqli_real_escape_string($conn, $_POST['nama_kegiatan']);
    $tanggal_kegiatan = mysqli_real_escape_string($conn, $_POST['tanggal_kegiatan']);
    $divisi = mysqli_real_escape_string($conn, $_POST['divisi']);
    $no_anggota = mysqli_real_escape_string($conn, $_POST['no_anggota']);
    $instagram_url = mysqli_real_escape_string($conn, $_POST['instagram_url']);
    $tiktok_url = mysqli_real_escape_string($conn, $_POST['tiktok_url']);
    $youtube_url = mysqli_real_escape_string($conn, $_POST['youtube_url']);
    $facebook_url = mysqli_real_escape_string($conn, $_POST['facebook_url']);
    $twitter_url = mysqli_real_escape_string($conn, $_POST['twitter_url']);

    // Daftar nilai divisi yang valid
    $allowed_divisi = ['KSDA', 'RAFTING', 'CLIMBING', 'MONTAIN'];

    // Periksa apakah nilai divisi valid
    if (!in_array($divisi, $allowed_divisi)) {
        echo "Divisi tidak valid. Pilih salah satu dari: " . implode(", ", $allowed_divisi);
        exit(); // Hentikan eksekusi jika divisi tidak valid
    }

    // Konfigurasi upload file
    $target_dir = "../assets/media/"; // Folder penyimpanan file
    $media_kegiatan = isset($_FILES['media_kegiatan']['name']) ? basename($_FILES['media_kegiatan']['name']) : '';
    $unique_file_name = uniqid() . "_" . $media_kegiatan; // Nama file dengan ID unik
    $target_file = $target_dir . $unique_file_name;

    $uploadOk = 1;

    if (!empty($_FILES['media_kegiatan']['tmp_name'])) {
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Batasi tipe file (foto dan video)
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov'];
        if (!in_array($fileType, $allowed_types)) {
            echo "Hanya file gambar atau video yang diperbolehkan.";
            $uploadOk = 0;
        }

        // Periksa ukuran file (maksimum 50MB)
        if ($_FILES["media_kegiatan"]["size"] > 52428800) {
            echo "Ukuran file terlalu besar (maksimum 50MB).";
            $uploadOk = 0;
        }

        if ($uploadOk === 1) {
            // Pindahkan file ke folder tujuan
            if (move_uploaded_file($_FILES["media_kegiatan"]["tmp_name"], $target_file)) {
                // Simpan data ke database
                $sql = "
                    INSERT INTO kegiatan (
                        nama_kegiatan, 
                        tanggal_kegiatan, 
                        divisi, 
                        no_anggota, 
                        media_kegiatan, 
                        instagram_url, 
                        tiktok_url, 
                        youtube_url, 
                        facebook_url, 
                        twitter_url
                    ) VALUES (
                        '$nama_kegiatan', 
                        '$tanggal_kegiatan', 
                        '$divisi', 
                        '$no_anggota', 
                        '$unique_file_name', 
                        '$instagram_url', 
                        '$tiktok_url', 
                        '$youtube_url', 
                        '$facebook_url', 
                        '$twitter_url'
                    )
                ";

                if (mysqli_query($conn, $sql)) {
                    // Redirect ke halaman kegiatan
                    header("Location: ../kegiatan.php?success=1");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Terjadi kesalahan saat mengupload file.";
            }
        }
    } else {
        echo "File media tidak ditemukan.";
    }

    // Tutup koneksi
    mysqli_close($conn);
} else {
    echo "Akses tidak diizinkan.";
}
?>
