<?php
session_start();

// Proses autentikasi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Misalkan ini adalah autentikasi sederhana (gunakan database di lingkungan nyata)
    if ($username == 'admin' && $password == 'password123') {
        // Jika login berhasil
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit();
    } else {
        // Jika login gagal
        $_SESSION['error'] = 'Username atau password salah!';
        header('Location: index.php');
        exit();
    }
}
