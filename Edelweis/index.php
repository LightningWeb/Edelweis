<?php
session_start(); // Memulai session
include "main.php"; // Menghubungkan ke template utama yang berisi CSS, JS, navbar, dan footer

// Logika untuk mengaktifkan dropdown jika salah satu item dari item-item pada navbar dropdown aktif
$isDivisiActive = isset($_GET['x']) && in_array($_GET['x'], ['montain', 'climbing', 'rafting', 'ksda']);

$isPengurusActive = isset($_GET['x']) && in_array($_GET['x'], ['daftar_pengurus', 'struktur','upload']);

// Tangkap parameter 'x' dan 'keyword' dari URL jika ada
$page = isset($_GET['x']) ? htmlspecialchars($_GET['x']) : 'home'; // Default ke 'home' jika tidak ada
$keyword = isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '';

// Logika untuk menentukan konten yang dimuat berdasarkan parameter 'x' di URL
switch ($page) {
    case 'home':
        include "home.php";
        break;
    case 'kegiatan':
        // Jika ada keyword, halaman kegiatan akan menggunakan keyword tersebut untuk pencarian
        $keyword = isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : 'kegiatan';
        include "kegiatan.php";
        break;
    case 'montain':
        include "montain.php";
        break;
    case 'climbing':
        include "climbing.php";
        break;
    case 'rafting':
        include "rafting.php";
        break;
    case 'ksda':
        include "ksda.php";
        break;
    case 'anggota':
        // Jika ada keyword, halaman anggota akan menggunakan keyword tersebut untuk pencarian
        $keyword = isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : 'anggota';
        include "anggota.php";
        break;
        case 'daftar_pengurus':
            echo "<p>Memuat halaman daftar pengurus...</p>";
            include "daftar_pengurus.php";
            break;
        
    // case 'daftar_pengurus':
    //     include "daftar_pengurus.php";
    //     break;
    case 'Struktur':
        include "struktur.php";
        break;
    case 'login':
        include "login.php";
        break;
    case 'logout':
        include "proses/logout_proses.php";
        break;
    default:
        echo "<h1>Halaman tidak ditemukan!</h1>";
        break;
}

// Sertakan file template untuk navbar, footer, atau script tambahan lainnya jika diperlukan
?>
