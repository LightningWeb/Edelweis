document.addEventListener("DOMContentLoaded", () => {
    const inputFile = document.getElementById("media_kegiatan");
    const cropPreview = document.getElementById("cropPreview");
    const cropContainer = document.getElementById("cropContainer");
    const cropButton = document.getElementById("cropButton");
    const submitButton = document.getElementById("submitButton");
    const form = document.getElementById("formUploadKegiatan");
    let cropper;

    // Ketika file dipilih
    inputFile.addEventListener("change", (event) => {
        const file = event.target.files[0];
        if (file) {
            const url = URL.createObjectURL(file);
            cropPreview.src = url;
            cropContainer.style.display = "block";

            // Hapus instance Cropper sebelumnya
            if (cropper) {
                cropper.destroy();
            }

            // Inisialisasi Cropper.js
            cropper = new Cropper(cropPreview, {
                aspectRatio: 2 / 1, // Rasio crop
                viewMode: 1,       // Mode tampilan crop
                autoCropArea: 1,   // Area crop otomatis
            });

            // Nonaktifkan tombol submit sebelum crop
            submitButton.disabled = true;
        }
    });

    // Ketika tombol crop ditekan
    cropButton.addEventListener("click", () => {
        if (cropper) {
            cropper.getCroppedCanvas().toBlob((blob) => {
                const dataTransfer = new DataTransfer();
                const file = new File([blob], "cropped.jpg", { type: "image/jpeg" });

                // Masukkan file hasil crop ke dalam input file
                dataTransfer.items.add(file);
                inputFile.files = dataTransfer.files;

                // Hapus instance Cropper
                cropper.destroy();
                cropContainer.style.display = "none";

                // Aktifkan tombol submit
                submitButton.disabled = false;
            });
        }
    });
});
