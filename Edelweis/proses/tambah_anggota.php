<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Import database connection
include "koneksi.php";

// Sanitize input data
$nm_anggota = isset($_POST['nm_anggota']) ? htmlentities(trim($_POST['nm_anggota'])) : "";
$no_anggota = isset($_POST['no_anggota']) ? htmlentities(trim($_POST['no_anggota'])) : "";
$jurusan = isset($_POST['jurusan']) ? htmlentities(trim($_POST['jurusan'])) : "";
$gender = isset($_POST['gender']) ? htmlentities(trim($_POST['gender'])) : "";
$th_masuk_keluar = isset($_POST['th_masuk_keluar']) ? htmlentities(trim($_POST['th_masuk_keluar'])) : "";
$alamat = isset($_POST['alamat']) ? htmlentities(trim($_POST['alamat'])) : "";
$no_hp = isset($_POST['no_hp']) ? htmlentities(trim($_POST['no_hp'])) : "";
$nm_lapangan = isset($_POST['nm_lapangan']) ? htmlentities(trim($_POST['nm_lapangan'])) : "";
$no_registrasi = isset($_POST['no_registrasi']) ? htmlentities(trim($_POST['no_registrasi'])) : "";
$divisi = isset($_POST['divisi']) ? htmlentities(trim($_POST['divisi'])) : "";
$jabatan = isset($_POST['jabatan']) ? htmlentities(trim($_POST['jabatan'])) : "";
$angkatan = isset($_POST['angkatan']) ? htmlentities(trim($_POST['angkatan'])) : "";

// Define valid ENUM options
$divisi_options = ['KSDA', 'RAFTING', 'MOUNTAIN', 'CLIMBING'];
$jurusan_options = ['TIK','TeknikMesin','TeknikElektro','TeknikSipil','Bisnis','TeknikKimia'];
$gender_options = ['Pria', 'Wanita'];

// Form validation
if (!empty($_POST['input_anggota_validate'])) {

    // Check if all required fields are filled
    if (empty($nm_anggota) || empty($no_anggota) || empty($jurusan) || empty($gender) || empty($th_masuk_keluar) || empty($alamat) || empty($no_hp) || empty($nm_lapangan) || empty($no_registrasi) || empty($divisi) || empty($jabatan) || empty($angkatan)) {
        die('<script>alert("Semua field wajib diisi!"); window.location="../anggota";</script>');
    }

    // Validate ENUM values
    if (!in_array($divisi, $divisi_options)) {
        die('<script>alert("Divisi tidak valid! Pilih salah satu dari: KSDA, RAFTING, MOUNTAIN, CLIMBING."); window.location="../anggota";</script>');
    }

    if (!in_array($jurusan, $jurusan_options)) {
        die('<script>alert("Jurusan tidak valid! Pilih salah satu dari: TIK, TeknikMesin, TeknikElektro, TeknikSipil, Bisnis, TeknikKimia."); window.location="../anggota";</script>');
    }

    if (!in_array($gender, $gender_options)) {
        die('<script>alert("Gender tidak valid! Pilih salah satu dari: Pria, Wanita."); window.location="../anggota";</script>');
    }

    // Check if the member number already exists in the database
    $stmt = $conn->prepare("SELECT * FROM anggota WHERE no_anggota = ?");
    $stmt->bind_param("s", $no_anggota);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die('<script>alert("Nomor anggota sudah ada di database."); window.location="../anggota";</script>');
    }

    // Insert data into the database using prepared statements
    $query = "INSERT INTO anggota (nm_anggota, no_anggota, jurusan, gender, th_masuk_keluar, alamat, no_hp, nm_lapangan, no_registrasi, divisi, jabatan, angkatan)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($insert_stmt = $conn->prepare($query)) {
        $insert_stmt->bind_param("ssssssssssss", $nm_anggota, $no_anggota, $jurusan, $gender, $th_masuk_keluar, $alamat, $no_hp, $nm_lapangan, $no_registrasi, $divisi, $jabatan, $angkatan);

        if ($insert_stmt->execute()) {
            echo '<script>alert("Data berhasil dimasukkan!"); window.location="../anggota";</script>';
        } else {
            echo '<script>alert("Terjadi kesalahan saat memasukkan data."); window.location="../anggota";</script>';
        }
    } else {
        die('<script>alert("Terjadi kesalahan saat mempersiapkan query."); window.location="../anggota";</script>');
    }

    // Close statements
    $stmt->close();
    $insert_stmt->close();
}

// Close the database connection
$conn->close();
?>