<nav id="mainNavbar" class="p-3 mb-3 border-bottom sticky-top"
    style="background-color: transparent; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                <img src="assets/img/Edelweis logo.png" width="50"><span class="font-edelweis">Edelweis</span>
            </a>

            <ul class="nav nav-pills col-12 col-lg-auto me-lg-auto mx-auto mb-2 justify-content-center mb-md-0"
                style="font-family: 'Courgette', cursive; font-weight: 400; font-style: normal;">
                <li class="nav-item">
                    <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'home') ? 'active link-light' : 'link-dark'; ?> "
                        href="home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'kegiatan') ? 'active link-light' : 'link-dark'; ?>"
                        href="kegiatan">Kegiatan</a>
                </li>

                <!-- Dropdown Pengurus -->
                <li class="nav-item dropdown">
                    <?php
                    // Logika untuk mengaktifkan dropdown jika salah satu item dari dropdown aktif
                    $isPengurusActive = isset($_GET['x']) && in_array($_GET['x'], ['daftar_pengurus', 'struktur','upload']);
                    ?>
                    <a class="nav-link ps-2 dropdown-toggle <?php echo $isPengurusActive ? 'active link-light' : 'link-dark'; ?>"
                        href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pengurus
                    </a>
                    <ul class="dropdown-menu mt-3" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="daftar_pengurus">Daftar Pengurus</a></li>
                        <li><a class="dropdown-item" href="struktur">Struktur Pengurus</a></li>
                        <li><a class="dropdown-item" href=".">Upload Data</a></li>
                    </ul>
                </li>
                <!-- End dropdown Pengurus -->

                <!-- Dropdown Divisi -->
                <li class="nav-item dropdown">
                    <?php
                    // Logika untuk mengaktifkan dropdown jika salah satu item dari dropdown aktif
                    $isDivisiActive = isset($_GET['x']) && in_array($_GET['x'], ['montain', 'climbing', 'rafting', 'ksda']);
                    ?>
                    <a class="nav-link ps-2 dropdown-toggle <?php echo $isDivisiActive ? 'active link-light' : 'link-dark'; ?>"
                        href="home" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Divisi
                    </a>
                    <ul class="dropdown-menu mt-3" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="montain">Monteneering</a></li>
                        <li><a class="dropdown-item" href="climbing">Climbing</a></li>
                        <li><a class="dropdown-item" href="rafting">Rafting</a></li>
                        <li><a class="dropdown-item" href="ksda">KSDA</a></li>
                    </ul>
                </li>
                <!-- End dropdown divisi -->
                <li class="nav-item">
                    <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'anggota') ? 'active link-light' : 'link-dark'; ?>"
                        href="anggota">Anggota</a>
                </li>

            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" action="proses/search_proses.php"
                method="get">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search" name="keyword">
            </form>

            <div class="dropdown text-end">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="assets/img/Edelweis logo.png" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small mt-4"
                    style="font-family: 'Courgette', cursive; font-weight: 400; font-style: normal;">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profil</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#loginModal"><i
                                class="bi bi-box-arrow-in-right"></i> Log In</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-left"></i> Log Out</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Modal Login -->
<?php
include "login.php";
?>