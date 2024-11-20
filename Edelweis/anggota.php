<?php
include 'proses/koneksi.php'; // Koneksi database

// $query = mysqli_query($conn, "SELECT * FROM tb_user");
// while ($record = mysqli_fetch_array($query)) {
//     $result[] = $record;

// Ambil keyword dari URL jika ada
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// Query berdasarkan kata kunci
if (!empty($keyword)) {
    // Siapkan query pencarian
    $sql = $conn->prepare("
        SELECT * FROM anggota
        WHERE no_anggota LIKE ? 
        OR nm_anggota LIKE ? 
        OR jurusan LIKE ? 
        OR gender LIKE ? 
        OR alamat LIKE ?
    ");
    $search_term = "%$keyword%";
    $sql->bind_param("sssss", $search_term, $search_term, $search_term, $search_term, $search_term);
    $sql->execute();
    $result = $sql->get_result();
} else {
    // Jika tidak ada keyword, tampilkan semua data
    $result = $conn->query("SELECT * FROM anggota");
}
?>




<div class="container">
    <div class="card">
        <h5 class="card-header">Daftar Anggota</h5>
        <div class="card-body">
            <div class="row mb-3">
                <!-- Left-aligned "Tambah Anggota" button -->
                <div class="col d-flex justify-content-start">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahAnggota">
                        Tambah Anggota
                    </button>
                </div>

                <!-- Right-aligned search bar -->
                <div class="col d-flex justify-content-end">
                    <input type="text" id="searchInput" class="form-control"
                        placeholder="Cari anggota yang anda inginkan....." aria-label="Search">
                </div>
            </div>
            <!-- Modal Tambah Anggota -->
            <div class="modal fade" id="modalTambahAnggota" tabindex="-1" aria-labelledby="modalTambahAnggotaLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalTambahAnggotaLabel">Tambah Anggota Baru</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="needs-validation" novalidate action="proses/tambah_anggota.php" method="POST"
                            enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="nm_anggota"
                                                placeholder="nama anggota" name="nm_anggota" required>
                                            <label for="nm_anggota">Nama Lengkap</label>
                                            <div class="invalid-feedback">
                                                Harap isi nama lengkap.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="no_anggota"
                                                placeholder="nomor anggota" name="no_anggota" required>
                                            <label for="no_anggota">Nomor Anggota</label>
                                            <div class="invalid-feedback">
                                                Harap masukkan nomor anggota.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="th_masuk_keluar"
                                                placeholder="tahun masuk keluar" name="th_masuk_keluar" required>
                                            <label for="th_masuk_keluar">Tahun Masuk-Keluar</label>
                                            <div class="invalid-feedback">
                                                Harap masukkan Tahun masuk & keluar anda (misal: 2020-2024).
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="nm_lapangan"
                                                placeholder="nama lapangan" name="nm_lapangan" required>
                                            <label for="nm_lapangan">Nama Lapangan</label>
                                            <div class="invalid-feedback">
                                                Harap masukkan nama lapangan.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="jabatan" placeholder="jabatan"
                                                name="jabatan" required>
                                            <label for="jabatan">Jabatan</label>
                                            <div class="invalid-feedback">
                                                Harap masukkan Jabatan.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="no_hp" placeholder="08xxxxxxx"
                                                name="no_hp" required>
                                            <label for="no_hp">No HP</label>
                                            <div class="invalid-feedback">
                                                Harap masukkan nomor HP.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="angkatan" placeholder="angkatan"
                                                name="angkatan" required>
                                            <label for="angkatan">Angkatan</label>
                                            <div class="invalid-feedback">
                                                Harap masukkan Angkatan.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="no_registrasi"
                                                placeholder="no registrasi" name="no_registrasi" required>
                                            <label for="no_registrasi">No. Registrasi</label>
                                            <div class="invalid-feedback">
                                                Harap masukkan No. Registrasi.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="divisi" required>
                                                <option selected hidden value="">Pilih Jenis Divisi</option>
                                                <option value="KSDA">KSDA</option>
                                                <option value="RAFTING">Rafting</option>
                                                <option value="MOUNTAIN">Monteneering</option>
                                                <option value="CLIMBING">Climbing</option>
                                            </select>
                                            <label for="divisi">Divisi</label>
                                            <div class="invalid-feedback">
                                                Harap pilih divisi yang valid.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="gender" required>
                                                <option selected hidden value="">Pilih Gender</option>
                                                <option value="Pria">Pria</option>
                                                <option value="Wanita">Wanita</option>
                                            </select>
                                            <label for="gender">Gender</label>
                                            <div class="invalid-feedback">
                                                Harap pilih gender yang valid.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="jurusan" required>
                                                <option selected hidden value="">Pilih Jurusan</option>
                                                <option value="TeknikElektro">Teknik Elektro</option>
                                                <option value="TeknikMesin">Teknik Mesin</option>
                                                <option value="TeknikKimia">Teknik Kimia</option>
                                                <option value="TeknikSipil">Teknik Sipil</option>
                                                <option value="Bisnis">Bisnis</option>
                                                <option value="TIK">TIK</option>
                                            </select>
                                            <label for="jurusan">Jurusan</label>
                                            <div class="invalid-feedback">
                                                Harap pilih jurusan yang valid.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg">
                                        <div class="form-floating">
                                            <textarea class="form-control" name="alamat" style="height: 100px;"
                                                required></textarea>
                                            <label for="alamat">Alamat</label>
                                            <div class="invalid-feedback">
                                                Harap masukkan alamat.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="input_anggota_validate"
                                    value="12345">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Akhir Modal Tambah Anggota Baru -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead style="background-color: #f4f4f4; text-align: center; position: sticky; top: 0; z-index: 1;">
                        <tr class="text-nowrap">
                            <th>No Anggota</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Gender</th>
                            <th>Tahun Masuk-Keluar</th>
                            <th>Alamat</th>
                            <th>No.Hp</th>
                            <th>Nama Lapangan</th>
                            <th>Jabatan</th>
                            <th>Divisi</th>
                            <th>No.Registrasi</th>
                            <th>Angkatan</th>
                        </tr>
                    </thead>
                    <tbody class="text-center align-middle">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Periksa apakah keyword ditemukan di salah satu kolom
                                $isHighlighted = !empty($keyword) && (
                                    stripos($row['no_anggota'], $keyword) !== false ||
                                    stripos($row['nm_anggota'], $keyword) !== false ||
                                    stripos($row['jurusan'], $keyword) !== false ||
                                    stripos($row['gender'], $keyword) !== false ||
                                    stripos($row['th_masuk_keluar'], $keyword) !== false ||
                                    stripos($row['alamat'], $keyword) !== false ||
                                    stripos($row['no_hp'], $keyword) !== false ||
                                    stripos($row['nm_lapangan'], $keyword) !== false ||
                                    stripos($row['jabatan'], $keyword) !== false ||
                                    stripos($row['divisi'], $keyword) !== false ||
                                    stripos($row['no_registrasi'], $keyword) !== false ||
                                    stripos($row['angkatan'], $keyword) !== false
                                );

                                // Tambahkan atribut class untuk highlight baris
                                $rowClass = $isHighlighted ? "table-warning" : "";

                                echo "<tr class='$rowClass'>";
                                echo "<td>" . htmlentities($row['no_anggota']) . "</td>";
                                echo "<td>" . htmlentities($row['nm_anggota']) . "</td>";
                                echo "<td>" . htmlentities($row['jurusan']) . "</td>";
                                echo "<td>" . htmlentities($row['gender']) . "</td>";
                                echo "<td>" . htmlentities($row['th_masuk_keluar']) . "</td>";
                                echo "<td>" . htmlentities($row['alamat']) . "</td>";
                                echo "<td>" . htmlentities($row['no_hp']) . "</td>";
                                echo "<td>" . htmlentities($row['nm_lapangan']) . "</td>";
                                echo "<td>" . htmlentities($row['jabatan']) . "</td>";
                                echo "<td>" . htmlentities($row['divisi']) . "</td>";
                                echo "<td>" . htmlentities($row['no_registrasi']) . "</td>";
                                echo "<td>" . htmlentities($row['angkatan']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<div class='alert alert-warning text-center' role='alert'>Tidak ada hasil yang ditemukan.</div>";
                        }
                        ?>
                    </tbody>


                </table>
            </div>


            <?php
            $conn->close();
            ?>
        </div>
    </div>
</div>



<!-- Awal javscript search -->
<script>
    // Fungsi untuk menyaring tabel berdasarkan input "No.Anggota"
    document.getElementById('searchInput').addEventListener('keypress', function (event) {
        // Cek apakah tombol yang ditekan adalah Enter (kode 13)
        if (event.key === 'Enter') {
            event.preventDefault();  // Mencegah perilaku default (misalnya submit form jika ada)
            let input = this.value.toUpperCase();  // Ambil nilai input dan ubah ke huruf besar
            let table = document.getElementById('anggotaTable');  // Ambil elemen tabel
            let tr = table.getElementsByTagName('tr');  // Ambil semua baris di dalam tabel
            let found = false;  // Variabel untuk melacak apakah ada hasil yang ditemukan

            // Loop melalui semua baris tabel dan sembunyikan yang tidak sesuai dengan pencarian
            for (let i = 1; i < tr.length; i++) {  // Mulai dari baris pertama setelah header
                let td = tr[i].getElementsByTagName('td')[8];  // Kolom ke-9 (No.Anggota)
                if (td) {
                    let txtValue = td.textContent || td.innerText;  // Ambil teks dari kolom

                    // Jika ada kecocokan dengan input
                    if (txtValue.toUpperCase().indexOf(input) > -1) {
                        tr[i].style.display = '';  // Tampilkan baris jika cocok
                        tr[i].classList.add('highlight');  // Tambahkan highlight pada baris yang cocok

                        // Scroll otomatis ke baris yang cocok
                        if (!found) {
                            tr[i].scrollIntoView({ behavior: 'smooth', block: 'start' });
                            found = true;  // Tandai bahwa hasil telah ditemukan
                        }
                    } else {
                        tr[i].style.display = 'none';  // Sembunyikan jika tidak cocok
                        tr[i].classList.remove('highlight');  // Hapus highlight dari baris yang tidak cocok
                    }
                }
            }

            // Jika tidak ada hasil yang ditemukan, tampilkan pesan
            if (!found) {
                alert('Anggota dengan nomor yang dicari tidak ditemukan');
            }
        }
    });

    // CSS untuk highlight
    const style = document.createElement('style');
    style.innerHTML = `
        .highlight {
            background-color: #f0f8ff !important;  /* Warna highlight */
            font-weight: bold;  /* Tekankan tulisan */
        }
    `;
    document.head.appendChild(style);
</script>
<!-- Akhir javscript search -->