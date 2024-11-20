<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formUploadKegiatan" action="proses/tambah_kegiatan.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="uploadModalLabel">Upload Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating text-dark mb-3">
                        <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                            placeholder="Nama Kegiatan" required>
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan"
                            placeholder="Tanggal Kegiatan" required>
                        <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="divisi" name="divisi" required>
                            <option value="" disabled selected>Pilih divisi</option>
                            <option value="KSDA">KSDA</option>
                            <option value="RAFTING">Rafting</option>
                            <option value="CLIMBING">Climbing</option>
                            <option value="MOUNTAIN">Mountain</option>
                        </select>
                        <label for="divisi">Divisi</label>
                    </div>
                    <div class="form-floating text-dark mb-3">
                        <input type="text" class="form-control" id="no_anggota" name="no_anggota"
                            placeholder="No Anggota" required>
                        <label for="no_anggota">No Anggota</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" id="media_kegiatan" name="media_kegiatan" accept="image/*" required>
                        <label for="media_kegiatan">Media Kegiatan (Foto)</label>
                    </div>
                    <!-- Cropper Preview -->
                    <div id="cropContainer" style="display: none; text-align: center;">
                        <img id="cropPreview" style="max-width: 100%; max-height: 300px;" />
                        <button type="button" id="cropButton" class="btn btn-primary mt-2">Crop Gambar</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submitButton" class="btn btn-primary" disabled>Upload</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
