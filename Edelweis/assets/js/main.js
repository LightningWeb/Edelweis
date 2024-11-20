// Inisialisasi tooltip dari Bootstrap
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

// Menampilkan modal input
function showUploadModal() {
    $('#uploadModal').modal('show');
}

// Memuat daftar angkatan dan mengatur klik untuk menampilkan diagram
function loadAngkatan() {
    fetch('proses/get_angkatan.php') // Pastikan proses ini mengembalikan daftar angkatan dalam bentuk JSON
        .then(response => response.json())
        .then(data => {
            const listAngkatan = document.getElementById('list-angkatan');
            listAngkatan.innerHTML = '';
            listAngkatan.style.display = 'block';

            data.forEach(angkatan => {
                const li = document.createElement('li');
                li.className = 'list-group-item';
                li.textContent = angkatan;
                li.style.cursor = 'pointer';
                li.addEventListener('click', () => {
                    loadDiagram(angkatan); // Fungsi untuk memuat diagram berdasarkan angkatan
                });
                listAngkatan.appendChild(li);
            });
        })
        .catch(error => console.error('Error loading angkatan:', error));
}

// Panggil fungsi loadAngkatan saat halaman di-load
document.addEventListener('DOMContentLoaded', loadAngkatan);
