<main class="container mt-0 mx-auto text-center py-1 d-flex flex-grow-1 justify-content-center align-items-center"
    style="display: flex; justify-content: center; align-items: center; padding: 1rem;">
    <div class="bg-transparent text-white py-3 px-4 rounded-lg position-relative mx-4 mt-0"
        style="background-color: transparent; color: white; padding: 1.5rem; border-radius: 1rem; margin: 0 1rem;">
        <div class="d-flex flex-column align-items-center"
            style="display: flex; flex-direction: column; align-items: center;">
            <!-- Gambar di atas H1 -->
            <img src="assets/img/Edelweis logo.png" style="width: 10rem; margin-top: 0;">

            <!-- Judul dan deskripsi -->
            <div style="margin-top: 0.5rem; width: 100%; border-top: 3px solid #333;"></div>
            <p class="display-6 font-weight-bold mb-3"
                style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1rem; font-family: 'Brush Script MT', cursive;">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. <br> Deleniti, quaerat officia illum culpa
                fugit numquam
                consequatur mollitia veniam <br> tempore placeat recusandae dolores, molestias <br> aut aliquam ipsa
                enim. Architecto, obcaecati excepturi.
            </p>

            <!-- Tombol navigasi ke Visi & Misi dan Sejarah -->
            <div style="display: flex; justify-content: space-between; width: 200px; margin: 20px auto;">
                <button onclick="scrollToSection('visi-misi')"
                    style="padding: 10px; font-size: 16px; background-color: green; color: white; border: none; border-radius: 50px; cursor: pointer;">
                    Visi & Misi
                </button>
                <button onclick="scrollToSection('sejarah')"
                    style="padding: 10px; font-size: 16px; background-color: green; color: white; border: none; border-radius: 50px; cursor: pointer;">
                    Sejarah
                </button>
            </div>
        </div>
    </div>
</main>

<!-- Bagian Visi & Misi -->
<section id="visi-misi" class="content-section" style="padding: 20px; margin-top: 20px;">
    <h2 style="text-align: center;">Visi & Misi</h2>
    <div style="display: flex; gap: 20px;">
        <div class="text-center"
            style="flex: 1; background-color: rgba(255, 255, 255, 0.1); padding: 20px; border-radius: 10px;">
            <h3>Visi</h3>
            <p>Memberikan pemahaman anggota tentang keorganisasian.
                Membina pribadi anggota untuk mengenal alam serta memupuk jiwa cinta tanah air.
                Mengembangkan potensi kreatif keilmuan dan budaya mahasiswa.
                Melakukan konservasi lingkungan dan sumber daya alam.
                Memperjuangkan kelestarian alam dan social masyarakat.</p>
        </div>
        <div class="text-center"
            style="flex: 1; background-color: rgba(255, 255, 255, 0.1); padding: 20px; border-radius: 10px;">
            <h3>Misi</h3>
            <p>UKM-PA Eddwcis berfungsi sebagai wadah pembinaan Mahasiswa berwatak

                kreatif, dinamis, cinta kepada Tuhan, berbakti kepada Almamater, serta ikut bertanggung
                jawab atas terlaksananya Tri Dharma Perguruan Tinggi.</p>
        </div>
    </div>
</section>

<!-- Bagian Sejarah -->
<section id="sejarah" class="content-section" style="padding: 20px; margin-top: 20px; text-align: center;">
    <h2 style="text-align: center;">Sejarah</h2>

    <div class="d-flex flex-column align-items-center"
        style="display: flex; flex-direction: column; align-items: center;">
        <!-- Judul -->
        <h2 class="font-weight-bold mb-3" style="text-transform: uppercase; font-family: 'Times New Roman', serif;">
            DUA PULUH SATU JULI “98”
        </h2>

        <!-- Konten paragraf -->
        <p style="text-indent: 0; line-height: 1.8;">
            Dua puluh satu Juli 1998,<br>
            Kami, Mapala <i>Edelweis</i> lahir sebagai<br>
            Kelompok Pecinta Alam<br>
            di bawah bendera Politeknik Negeri Lhokseumawe.
        </p>

        <p style="text-indent: 0; line-height: 1.8;">
            Kami mengharapkan keberadaan kami diakui<br>
            sebagai kelompok Pecinta Alam yang memiliki<br>
            rasa tanggung jawab yang besar untuk menjaga<br>
            dan melestarikan kelestarian alam di Aceh khususnya,<br>
            dan di Bumi Pertiwi umumnya.
        </p>

        <p style="text-indent: 0; line-height: 1.8;">
            Teramat jauh jalan kami lalui,<br>
            begitu besar tantangan yang kami hadapi, tetapi<br>
            tetap semua itu sebagai tanggung jawab<br>
            yang harus kami emban.
        </p>

        <p style="text-indent: 0; line-height: 1.8;">
            Kami menyadari bahwa begitu kecilnya<br>
            kami di hadapan Sang Pencipta,<br>
            dan kita semua adalah ciptaan-Nya.<br>
            Maka dari itu, tidak pernah terfikir oleh kami<br>
            untuk menaklukkan alam.
        </p>

        <p style="text-indent: 0; line-height: 1.8;">
            Tebing yang terjal, jurang yang dalam,<br>
            gunung yang tinggi menjulang,<br>
            liang gua yang gelap dan jurang yang liar<br>
            menanti kami.
        </p>

        <p style="text-indent: 0; line-height: 1.8;">
            Semoga Sang Khalik merestui langkah kecil<br>
            yang akan kami ukir di persada ini.
        </p>
    </div>
</section>

<script>
    function scrollToSection(id) {
        const element = document.getElementById(id);
        const offset = -50; // Menyesuaikan offset agar tampilan tepat di bagian yang diinginkan
        const bodyRect = document.body.getBoundingClientRect().top;
        const elementRect = element.getBoundingClientRect().top;
        const elementPosition = elementRect - bodyRect;
        const offsetPosition = elementPosition + offset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }
</script>