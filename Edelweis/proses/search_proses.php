<?php
session_start();

include 'koneksi.php'; // Ensure this is your database connection file

// Get the keyword from the search form in the navbar
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// Check if a keyword is entered
if (empty($keyword)) {
    // If no keyword, redirect to the home page or default page
    header("Location: ../home.php");
    exit();
}

// Prepare SQL queries to search for members, activities, and administrators
$sql_anggota = $conn->prepare("SELECT * FROM anggota WHERE no_anggota LIKE ? OR nm_anggota LIKE ? OR jurusan LIKE ? OR gender LIKE ? OR alamat LIKE ?");
$sql_kegiatan = $conn->prepare("SELECT * FROM kegiatan WHERE nama_kegiatan LIKE ? OR divisi LIKE ? OR no_anggota LIKE ?");
$sql_pengurus = $conn->prepare("SELECT * FROM pengurus WHERE no_anggota LIKE ? OR nm_pengurus LIKE ? OR jabatan LIKE ?");

// Bind parameters
$search_term = "%$keyword%";
$sql_anggota->bind_param("sssss", $search_term, $search_term, $search_term, $search_term, $search_term);
$sql_kegiatan->bind_param("sss", $search_term, $search_term, $search_term);
$sql_pengurus->bind_param("sss", $search_term, $search_term, $search_term);

// Execute queries
$sql_anggota->execute();
$result_anggota = $sql_anggota->get_result();

$sql_kegiatan->execute();
$result_kegiatan = $sql_kegiatan->get_result();

$sql_pengurus->execute();
$result_pengurus = $sql_pengurus->get_result();

// Redirect to the appropriate page based on the search results
if ($result_anggota->num_rows > 0) {   
    header("Location: ../index.php?x=anggota&keyword=" . urlencode($keyword));
    exit();
} elseif ($result_kegiatan->num_rows > 0) {
    header("Location: index.php?x=kegiatan&keyword=" . urlencode($keyword));
    exit();
} elseif ($result_pengurus->num_rows > 0) {
    header("Location: index.php?x=pengurus&keyword=" . urlencode($keyword));
    exit();
} else {
    // If no results found
    echo '<script>alert("Tidak ada hasil yang ditemukan untuk \'' . $keyword . '\'. Kembali ke halaman utama."); window.location="../index.php";</script>';
}

// Close connections
$sql_anggota->close();
$sql_kegiatan->close();
$sql_pengurus->close();
$conn->close();
?>
