<?php
include "koneksi.php";
$nm_anggota = (isset($_POST['nm_anggota'])) ? htmlentities($_POST['nm_anggota']) : "";
$no_anggota = (isset($_POST['no_anggota'])) ? htmlentities($_POST['no_anggota']) : "";
$Jurusan = (isset($_POST['Jurusan'])) ? htmlentities($_POST['Jurusan']) : "";
$gender = (isset($_POST['gender'])) ? htmlentities($_POST['gender']) : "";
$th_masuk_keluar = (isset($_POST['th_masuk_keluar'])) ? htmlentities($_POST['th_masuk_keluar']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";
$no_hp = (isset($_POST['no_hp'])) ? htmlentities($_POST['no_hp']) : "";
$nm_lapangan = (isset($_POST['nm_lapangan'])) ? htmlentities($_POST['nm_lapangan']) : "";
$no_registrasi = (isset($_POST['no_registrasi'])) ? htmlentities($_POST['no_registrasi']) : "";

$divisi = (isset($_POST['divisi'])) ? htmlentities($_POST['divisi']) : "";
$jabatan = (isset($_POST['jabatan'])) ? htmlentities($_POST['jabatan']) : "";
$angkatan = (isset($_POST['angkatan'])) ? htmlentities($_POST['angkatan']) : "";

if (!empty($_POST['edit_anggota_validate'])) {
    // Mengecek apakah nama sudah ada di database
    $select = mysqli_query($conn, "SELECT * FROM anggota WHERE no_anggota = '$no_anggota'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Nama anggota yang dimasukan telah ada")
        window.location="../anggota"</script>';
    } else {
        // Menyimpan data anggota tanpa upload foto
        $query = mysqli_query($conn, "UPDATE anggota SET nm_anggota='$nm_anggota', no_anggota=$no_anggota, jurusan=$jurusan, gender='$gender', th_masuk_keluar=$th_masuk_keluar,  alamat='$alamat', no_hp='$no_hp', nm_lapangan='$nm_lapangan', no_registrasi='$no_registrasi', divisi=$divisi, jabatan=$jabatan, angkatan=$angkatan WHERE no_anggota='$no_anggota'");
        if ($query) {
            $message = '<script>alert("Data berhasil dimasukkan")
            window.location="../anggota"</script>';
        } else {
            $message = '<script>alert("Data gagal dimasukkan")
            window.location="../anggota"</script>';
        }
    }
}
echo $message;
