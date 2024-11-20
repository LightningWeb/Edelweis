<div class="col-md-9 p-3">
    <h4>Struktur Organisasi</h4>
    <div id="struktur-diagram" class="d-flex flex-wrap">
        <!-- Diagram akan di-render di sini melalui JavaScript -->
    </div>
</div>


<script>
    function loadDiagram() {
        fetch('proses/get_pengurus.php')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('struktur-diagram');
                container.innerHTML = '';

                // Membuat struktur hirarki sesuai dengan data yang diterima
                const groupedData = groupByDivision(data);

                // Iterasi melalui setiap divisi dan buat box untuk masing-masing
                Object.keys(groupedData).forEach(division => {
                    const divisionContainer = document.createElement('div');
                    divisionContainer.className = 'division-container mb-4';
                    divisionContainer.style.border = '2px solid #4b5320'; // Hijau army
                    divisionContainer.style.padding = '10px';
                    divisionContainer.style.borderRadius = '8px';
                    divisionContainer.style.backgroundColor = '#6B8E23'; // Hijau army yang lebih muda
                    divisionContainer.style.color = '#fff';

                    const divisionTitle = document.createElement('h5');
                    divisionTitle.textContent = division;
                    divisionTitle.style.textAlign = 'center';
                    divisionContainer.appendChild(divisionTitle);

                    // Buat kontainer untuk pengurus dalam divisi ini
                    const membersContainer = document.createElement('div');
                    membersContainer.className = 'd-flex flex-wrap justify-content-center';

                    // Iterasi melalui anggota dan buat box
                    groupedData[division].forEach(item => {
                        const card = document.createElement('div');
                        card.className = 'card m-2';
                        card.style.width = '180px';
                        card.style.border = 'none';
                        card.style.backgroundColor = '#8F9779';
                        card.style.color = '#fff';

                        card.innerHTML = `
                        <img src="${item.foto}" class="card-img-top" alt="${item.nm_pengurus}" style="height: 150px; object-fit: cover; border-radius: 8px;">
                        <div class="card-body">
                            <h6 class="card-title">${item.nm_pengurus}</h6>
                            <p class="card-text">Jabatan: ${item.jabatan}</p>
                            <p class="card-text">Angkatan: ${item.angkatan}</p>
                        </div>
                    `;
                        membersContainer.appendChild(card);
                    });

                    divisionContainer.appendChild(membersContainer);
                    container.appendChild(divisionContainer);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    // Helper function untuk mengelompokkan data berdasarkan divisi
    function groupByDivision(data) {
        return data.reduce((acc, item) => {
            acc[item.divisi] = acc[item.divisi] || [];
            acc[item.divisi].push(item);
            return acc;
        }, {});
    }

    // Load data saat halaman di-load
    document.addEventListener('DOMContentLoaded', loadDiagram);
</script>