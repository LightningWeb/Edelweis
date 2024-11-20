<?php
// Sertakan file koneksi
include 'proses/koneksi.php';

// Query untuk mengambil semua data pengurus
$query = "SELECT * FROM pengurus";
$result = $conn->query($query);
?>


<div class="container">
    <!-- Wrapper Row -->
    <div class="row">
        <!-- Sidebar -->
        <div class="col-sm-1 d-flex flex-column align-items-center justify-content-center position-fixed"
            style="height: 100vh; left: 0; top: 0;">
            <!-- Uppload -->
            <div class="mb-3">
                <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                    data-bs-content="Upload Pengurus">
                    <button class="btn btn-secondary" type="button" data-bs-toggle="modal"
                        data-bs-target="#uploadPengurusModal">
                        <i class="bi bi-person-plus-fill fs-5"></i>
                    </button>
                </span>
            </div>

            <!-- Daftar Pengurus -->
            <div class="mb-3">
                <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                    data-bs-content="Daftar Angkatan">
                    <button class="btn btn-secondary" type="button" data-bs-toggle="modal"
                        data-bs-target="#angkatanModal">
                        <i class="bi bi-person-lines-fill fs-5"></i>
                    </button>
                </span>
            </div>

            <!-- Struktur Pengurus -->
            <div class="mb-3">
                <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                    data-bs-content="Struktur Pengurus">
                    <button class="btn btn-secondary" type="button" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bi bi-person-vcard fs-5"></i>
                    </button>
                </span>
            </div>
        </div>

        <!-- Content -->
        <div class="col-sm-11 offset-sm-1">
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-center fs-3 text-bold" style="font-family: 'Lora', serif;">
                        PENGURUS & STRUKTUR SETIAP ANGKATAN
                    </div>
                    <div class="mt-2 w-100 border-top border-secondary border-3"></div>

                    <!-- Tabel data pengurus di dalam card baru -->
                    <div class="card mt-3" style="width: 90%; margin: 0 auto;">
                        <div class="card-header">Daftar Pengurus</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="pengurusTable" class="table table-hover table-striped"
                                    style="width: 100%; border-collapse: collapse;">
                                    <thead
                                        style="text-align: center; background-color: #f8f9fa; font-weight: bold; padding: 0.5rem;">
                                        <tr style="text-align: center;">
                                            <th scope="col">No</th>
                                            <th scope="col">Foto</th>
                                            <th scope="col">No.Anggota</th>
                                            <th scope="col">Nama Pengurus</th>
                                            <th scope="col">Jabatan</th>
                                            <th scope="col">Divisi</th>
                                            <th scope="col">Angkatan</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center: padding: 0.5rem; vertical-align: middle;">
                                        <?php
                                        if ($result && $result->num_rows > 0) {
                                            $no = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <tr class="text-nowrap" style="text-align: center;">
                                                    <th scope="row" style="padding: 0.5rem; vertical-align: middle;">
                                                        <?php echo $no++; ?>
                                                    </th>
                                                    <td style="padding: 0.5rem; vertical-align: middle; ">
                                                        <img src="../assets/img/<?php echo htmlentities($row['foto']); ?>"
                                                            alt="Foto Pengurus" width="50"
                                                            style="display: block; margin: 0 auto; max-height: 50px;">
                                                    </td>
                                                    <td> <?php echo htmlentities($row['no_anggota']); ?> </td>
                                                    <td> <?php echo htmlentities($row['nm_pengurus']); ?> </td>
                                                    <td> <?php echo htmlentities($row['jabatan']); ?> </td>
                                                    <td> <?php echo htmlentities($row['divisi']); ?> </td>
                                                    <td> <?php echo htmlentities($row['angkatan']); ?> </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='7' style='padding: 0.5rem; text-align: center;'>Tidak ada data pengurus yang ditemukan.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        // Tutup koneksi database
        $conn->close();
        ?>
    </div>
</div>
</div>


<!-- Modal upload pengurus -->
<div class="modal fade" id="uploadPengurusModal" tabindex="-1" aria-labelledby="uploadPengurusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="uploadPengurusLabel">Upload Data Pengurus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadPengurusForm" action="proses/tambah_pengurus.php" method="POST"
                    enctype="multipart/form-data">
                    <!-- Nomor Anggota -->
                    <div class="form-floating mb-3 text-dark">
                        <input type="text" class="form-control" id="noAnggota" placeholder="Nomor Anggota"
                            name="no_anggota" maxlength="50" required>
                        <label for="noAnggota">Nomor Anggota</label>
                    </div>

                    <!-- Foto Pengurus -->
                    <div class="form-floating mb-3 text-dark">
                        <input type="file" class="form-control" id="foto" name="foto" required>
                        <label for="foto">Foto Pengurus</label>
                    </div>

                    <!-- Nama Pengurus -->
                    <div class="form-floating mb-3 text-dark">
                        <input type="text" class="form-control" id="nmPengurus" placeholder="Nama Pengurus"
                            name="nm_pengurus" maxlength="255" required>
                        <label for="nmPengurus">Nama Pengurus</label>
                    </div>

                    <!-- Jabatan -->
                    <div class="form-floating mb-3 text-dark">
                        <input type="text" class="form-control" id="jabatan" placeholder="Jabatan" name="jabatan"
                            maxlength="50" required>
                        <label for="jabatan">Jabatan</label>
                    </div>

                    <!-- Divisi -->
                    <div class="form-floating mb-3">
                        <select class="form-control" id="divisi" name="divisi" required>
                            <option value="">Pilih Divisi</option>
                            <option value="KSDA">KSDA</option>
                            <option value="Rafting">Rafting</option>
                            <option value="Monteneering">Monteneering</option>
                            <option value="Climbing">Climbing</option>
                        </select>
                        <label for="divisi">Divisi</label>
                    </div>

                    <!-- Kegiatan -->
                    <div class="form-floating mb-3 text-dark">
                        <input type="text" class="form-control" id="kegiatan" placeholder="Kegiatan" name="kegiatan"
                            maxlength="255" required>
                        <label for="kegiatan">Kegiatan</label>
                    </div>

                    <!-- Angkatan -->
                    <div class="form-floating mb-3 text-dark">
                        <input type="text" class="form-control" id="angkatan" placeholder="Angkatan" name="angkatan"
                            maxlength="50" required>
                        <label for="angkatan">Angkatan</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="uploadPengurusForm" class="btn btn-primary"
                    name="input_pengurus_validate">Upload</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Daftar Angkatan -->
<div class="modal fade" id="angkatanModal" tabindex="-1" aria-labelledby="angkatanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="angkatanModalLabel">Daftar Angkatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <!-- Loop 27 angkatan -->
                    <!-- Misalkan nama angkatan diisi Angkatan 1 hingga Angkatan 27 -->
                    <!-- Tambahkan link sesuai kebutuhan -->
                    <li class="list-group-item"><a href="#angkatan1">Angkatan 1</a></li>
                    <li class="list-group-item"><a href="#angkatan2">Angkatan 2</a></li>
                    <li class="list-group-item"><a href="#angkatan3">Angkatan 3</a></li>
                    <!-- Lanjutkan sampai angkatan ke-27 -->
                    <li class="list-group-item"><a href="#angkatan27">Angkatan 27</a></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>



<!-- Sidebar JS -->
<script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>

<script>
    // Function to toggle content sections
    function showSection(sectionId) {
        const sections = document.querySelectorAll('.content-section');
        sections.forEach(section => {
            section.style.display = 'none';
        });
        document.getElementById(sectionId).style.display = 'block';
    }

    // Sidebar buttons to show respective sections
    document.querySelector('.upload-btn').addEventListener('click', () => showSection('uploadSection'));
    document.querySelector('.daftar-btn').addEventListener('click', () => showSection('daftarSection'));
    document.querySelector('.struktur-btn').addEventListener('click', () => showSection('strukturSection'));
</script>