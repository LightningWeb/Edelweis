<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edelweis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="assets/js/main.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="assets/js/Cropper.js" defer></script>
    


    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/kegiatan.css">


</head>

<body
    style="background-image: url('assets/img/montDate.jpg'); background-size: cover; background-position: center; color: white;">

    <!-- Awal Navbar -->
    <?php include "navbar.php"; ?>
    <!-- Akhir Navbar -->

    <!-- Konten -->
    <!-- Akhir konten -->

    <!-- Awal Footer -->
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top fixed-bottom" style="background: rgba(0, 0, 0, 0.6); /* Semi-transparent black background */
           padding: 20px;
           color: #f8f9fa;
           box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);">
        <div class="col-md-4 d-flex align-items-center me-4">
            <a href="home.php" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                <img src="assets/img/Edelweis logo.png" width="50">
            </a>
            <div class="d-flex flex-column align-items-start">
                <span class="navigation"
                    style="font-family: 'Courgette', cursive; font-weight: 400; font-style: normal; color: white; margin-top: 0;">
                    UKM-PA <span class="font-edelweis">Edelweis</span> <br>
                    &copy; Since 1998, <span class="font-edelweis">Edelweis</span>
                </span>
            </div>
        </div>

        <ul class="nav col-md-4 me-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-body-secondary" href="https://www.instagram.com/ukmpa_edelweis.pnl/">
                    <i class="bi bi-instagram fs-3" style="color: #ff6f61;"></i></a></li>
            <li class="ms-3"><a class="text-body-secondary"
                    href="https://www.tiktok.com/@edelweis_2107?_t=8pUVZu4SvhP&_r=1">
                    <i class="bi bi-tiktok fs-3" style="color: #f8f9fa;"></i></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><i class="bi bi-facebook fs-3"
                        style="color: #3b5998;"></i></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#">yt</a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#">yt</a></li>
        </ul>
    </footer>
    <!-- Akhir Footer -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <!-- Side pengurus & Tooltip -->
    <script>
        // Inisialisasi tooltip dari Bootstrap
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        // Menampilkan modal input
        function showUploadModal() {
            $('#uploadModal').modal('show');
        }

        // Menampilkan atau menyembunyikan daftar angkatan
        function toggleAngkatanList() {
            const listAngkatan = document.getElementById('list-angkatan');
            if (listAngkatan.style.display === 'none' || listAngkatan.style.display === '') {
                listAngkatan.style.display = 'block';
                loadAngkatan(); // Memuat daftar angkatan saat ditampilkan
            } else {
                listAngkatan.style.display = 'none';
            }
        }

        // Memuat daftar angkatan dan mengatur klik untuk menampilkan diagram
        function loadAngkatan() {
            fetch('proses/get_angkatan.php')
                .then(response => response.json())
                .then(data => {
                    const listAngkatan = document.getElementById('list-angkatan');
                    listAngkatan.innerHTML = '';

                    data.forEach(angkatan => {
                        const li = document.createElement('li');
                        li.className = 'list-group-item';
                        li.textContent = angkatan;
                        li.style.cursor = 'pointer';

                        li.onclick = () => loadDiagram(angkatan);
                        listAngkatan.appendChild(li);
                    });
                })
                .catch(error => console.error('Error fetching angkatan:', error));
        }

        // Memuat diagram pengurus berdasarkan angkatan
        function loadDiagram(angkatan) {
            fetch(`proses/get_pengurus.php?angkatan=${angkatan}`)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('struktur-diagram');
                    container.innerHTML = '';

                    data.forEach(item => {
                        const card = document.createElement('div');
                        card.className = 'card m-2';
                        card.style.width = '200px';

                        card.innerHTML = `
                            <img src="${item.foto}" class="card-img-top" alt="${item.nm_pengurus}">
                            <div class="card-body">
                                <h5 class="card-title">${item.nm_pengurus}</h5>
                                <p class="card-text">Jabatan: ${item.jabatan}</p>
                                <p class="card-text">Divisi: ${item.divisi}</p>
                                <p class="card-text">Angkatan: ${item.angkatan}</p>
                            </div>
                        `;
                        container.appendChild(card);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Mengirim data form pengurus
        document.getElementById('form-pengurus').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('proses/simpan_pengurus.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    loadDiagram(data.angkatan); // Refresh diagram untuk angkatan terbaru
                    $('#uploadModal').modal('hide');
                })
                .catch(error => console.error('Error saving data:', error));
        });
    </script>

    <script>
        $(document).ready(function () {
            // Ketika modal dibuka, muat konten dari login.php
            $('#loginModal').on('show.bs.modal', function (e) {
                $('#loginModalContent').load('login.php');
            });
        });
    </script>
    <script>
        window.addEventListener('scroll', function () {
            const navbar = document.getElementById('mainNavbar');
            const navLinks = navbar.querySelectorAll('.nav-link'); // Target all nav-link elements

            if (window.scrollY > 50) {
                navbar.style.backgroundColor = 'white'; // Gray background
                navbar.style.boxShadow = '0 4px 10px rgba(0, 0, 0, 0.5)'; // Increase shadow
                navLinks.forEach(link => link.style.color = 'white'); // Set text to white
            } else {
                navbar.style.backgroundColor = 'transparent'; // Revert to transparent
                navbar.style.boxShadow = '0 2px 5px rgba(0, 0, 0, 0.3)'; // Original shadow
                navLinks.forEach(link => link.style.color = 'black'); // Set text back to dark
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });
        });
    </script>

    <script src="assets/js/organizationChart.js"></script>




</body>

</html>