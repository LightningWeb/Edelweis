<?php
session_start();
session_destroy(); // Hapus semua session
header('Location: index.php'); // Arahkan ke halaman utama
exit();
