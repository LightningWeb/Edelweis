<?php 
include "koneksi.php";
$no_anggota = (isset($_POST['no_anggota'])) ? htmlentities($_POST['no_anggota']) : "";

if(!empty($_POST['input_anggota_validate'])){
    $query = mysqli_query($conn, "DELETE FROM anggota WHERE no_anggota='$no_anggota'");
    if($query){
        $message = '<script>alert("Data berhasil dihapus");
                    window.location="../anggota"</script>';
    }else{
        $message = '<script>alert("Data gagal dihapus");
                    window.location="../anggota"</script>';
    }
}echo $message;
?>