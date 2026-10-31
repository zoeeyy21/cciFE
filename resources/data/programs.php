<?php

/*
|--------------------------------------------------------------------------|
| DATA PROGRAM                                                             |
|--------------------------------------------------------------------------|
| Struktur tiap program:
|   'name'        (wajib)   Nama program
|   'slug'        (wajib)   Slug URL unik
|   'summary'     (wajib)   Ringkasan singkat untuk kartu
|   'description' (opsional)Uraian panjang format HTML
|   'goal'        (opsional)Target capaian untuk halaman detail
|   'target'      (opsional)Sasaran penerima manfaat
|   'status'      (wajib)   'Aktif' atau 'Non-Aktif' (Selesai)
|   'category'    (wajib)   Pendidikan, Kesehatan, Pemberdayaan, Tanggap Bencana, dll.
|   'period'      (wajib)   Periode pelaksanaan (mis. 'Periode 2026', '2025–2026')
|   'image'       (opsional)File gambar di storage/app/public/programs/
*/

return [

    // ── Pendidikan ─────────────────────────────────────────────────────
    [
        'name'        => 'Tebar Paket Sekolah Anak Nusantara',
        'slug'        => 'tebar-paket-sekolah',
        'summary'     => 'Bantuan paket tas sekolah, buku pelajaran, dan fasilitas pendukung belajar bagi anak-anak nusantara.',
        'description' => '<p>Program <strong>Tebar Paket Sekolah</strong> diinisiasi oleh Yayasan Pelita Bahagia Anak Nusantara dalam momentum Hari Sumpah Pemuda. Melalui gerakan "Menyalakan Pelita untuk Pendidikan Anak Nusantara", bantuan disalurkan berupa tas sekolah baru, buku pelajaran, buku tulis, dan fasilitas penunjang belajar bagi anak-anak di pelosok nusantara.</p><p>Sedekah mulai dari Rp 28.000 membuka kesempatan bagi masyarakat luas untuk bersama-sama meringankan beban keluarga pra-sejahtera dan memastikan anak-anak Indonesia dapat bersekolah dengan penuh semangat dan rasa bangga.</p>',
        'goal'        => '500 Paket Sekolah Terdistribusi',
        'target'      => 'Anak-anak sekolah dasar dan madrasah di pelosok nusantara',
        'status'      => 'Aktif',
        'category'    => 'Pendidikan',
        'period'      => 'Periode 2026',
        'image'       => 'programs/tebar-paket-sekolah.jpg',
    ],

    [
        'name'        => 'Beasiswa Cerdas Pelosok',
        'slug'        => 'beasiswa-cerdas-pelosok',
        'summary'     => 'Beasiswa SPP, buku, dan seragam untuk 250 anak pra-sejahtera di Nusa Tenggara Timur.',
        'description' => '<p>Beasiswa Cerdas Pelosok adalah program beasiswa penuh satu tahun ajaran bagi anak-anak usia SD hingga SMP dari keluarga pra-sejahtera di wilayah Nusa Tenggara Timur. Setiap penerima beasiswa mendapatkan pembayaran SPP bulanan, perlengkapan sekolah lengkap, dan pendampingan belajar rutin oleh relawan.</p><p>Program ini dijalankan bekerja sama dengan dinas pendidikan setempat dan kepala desa untuk memastikan bantuan tepat sasaran. Laporan penyaluran disusun setiap kuartel dan dipublikasikan di halaman Kegiatan.</p>',
        'goal'        => '250 Anak Penerima Beasiswa',
        'target'      => 'Anak usia 6–15 tahun dari keluarga pra-sejahtera',
        'status'      => 'Aktif',
        'category'    => 'Pendidikan',
        'period'      => 'Periode 2026',
        'image'       => 'programs/beasiswa-cerdas-pelosok.jpg',
    ],

    [
        'name'        => 'Ruang Belajar Cerah',
        'slug'        => 'ruang-belajar-cerah',
        'summary'     => 'Renovasi 12 ruang kelas usang di sekolah pedalaman Sumba lengkap dengan sudut buku bacaan.',
        'description' => '<p>Banyak ruang kelas di sekolah pedalaman Sumba dalam kondisi rusak berat — atap bocor, lantai berlubang, dan tanpa listrik. Melalui program Ruang Belaja Cerah, kami merenovasi ruang kelas agar aman dan nyaman, sekaligus menyediakan sudut baca berisi 300 lebih buku.</p><p>Setiap ruang yang selesai direnovasi diserahterimakan langsung kepada pihak sekolah dan menjadi tanggung jawab bersama warga sekitar.</p>',
        'goal'        => '12 Ruang Kelas Direnovasi',
        'target'      => 'Sekolah dasar di 6 desa pedalaman Sumba',
        'status'      => 'Aktif',
        'category'    => 'Pendidikan',
        'period'      => '2025–2026',
        'image'       => 'programs/ruang-belajar-cerah.jpg',
    ],

    // ── Kesehatan ──────────────────────────────────────────────────────
    [
        'name'        => 'Piring Bergizi Anti-Stunting',
        'slug'        => 'piring-bergizi-anti-stunting',
        'summary'     => 'Paket makanan bergizi harian untuk 400 balita di 8 desa endemik stunting NTT.',
        'description' => '<p>Program Piring Bergizi menyalurkan paket makanan harian berisi telur, susu, ikan kering, dan sayuran lokal kepada 400 balita usia 6–24 bulan di 8 desa dengan angka stunting tertinggi. Pendampingan dilakukan oleh kader posyandu yang sudah dilatih gizi seimbang.</p><p>Timbangan rutin dan pencatatan pertumbuhan dilakukan setiap dua minggu untuk memantau efektivitas intervensi.</p>',
        'goal'        => '400 Balita Terpantau Tumbuh Kembangnya',
        'target'      => 'Balita usia 6–24 bulan di 8 desa prioritas',
        'status'      => 'Aktif',
        'category'    => 'Kesehatan',
        'period'      => 'Periode 2026',
        'image'       => 'programs/piring-bergizi-anti-stunting.jpg',
    ],

    [
        'name'        => 'Balai Sehat Desa',
        'slug'        => 'balai-sehat-desa',
        'summary'     => 'Pemeriksaan medis gratis dan obat untuk 1.000 warga desa yang jangkauan puskesmasnya lebih dari 3 jam.',
        'description' => '<p>Tim dokter dan perawat relawan mendatangi desa-desa terpencil untuk memberikan pemeriksaan kesehatan gratis, pembagian obat, dan edukasi sanitasi. Setiap kunjungan diikuti pemeriksaan rutin anak-anak dan ibu hamil.</p><p>Program ini bekerjasama dengan Puskesmas terdekat untuk rujukan kasus yang membutuhkan penanganan lebih lanjut.</p>',
        'goal'        => '1.000 Warga Terlayani Medis',
        'target'      => 'Warga desa terpencil di Kabupaten Sumba Barat',
        'status'      => 'Aktif',
        'category'    => 'Kesehatan',
        'period'      => '2025–2026',
        'image'       => 'programs/balai-sehat-desa.jpg',
    ],

    // ── Pemberdayaan ───────────────────────────────────────────────────
    [
        'name'        => 'Ibu Tangguh Ekonomi',
        'slug'        => 'ibu-tangguh-ekonomi',
        'summary'     => 'Pelatihan kewirausahaan dan modal usaha untuk 120 ibu tunggal di Sumba Timur.',
        'description' => '<p>Program Ibu Tangguh memberikan pelatihan kewirausahaan, manajemen keuangan keluarga, dan modal usaha awal bagi 120 ibu tunggal. Hasilnya, para ibu mampu membangun usaha kecil berkelanjutan untuk menopang biaya sekolah anak-anaknya.</p><p>Setiap peserta didampingi selama 12 bulan oleh mentor bisnis relawan.</p>',
        'goal'        => '120 Ibu Memiliki Usaha Mandiri',
        'target'      => 'Ibu tunggal kepala keluarga di Sumba Timur',
        'status'      => 'Aktif',
        'category'    => 'Pemberdayaan',
        'period'      => 'Periode 2026',
        'image'       => 'programs/ibu-tangguh-ekonomi.jpg',
    ],

    [
        'name'        => 'Tanggap Bencana Pelosok',
        'slug'        => 'tanggap-bencana-pelosok',
        'summary'     => 'Logistik darurat, tenda, dan dapur umum siap pakai untuk wilayah rawan banjir dan gempa.',
        'description' => '<p>Program Tanggap Bencana menyediakan stok logistik darurat berupa tenda, tikar, perlengkapan dapur umum, dan air bersih di titik-titik pengungsian strategis. Tim relawan dilatih evakuasi dan distribusi cepat dalam 24 jam pertama setelah bencana.</p><p>Posko siaga dijalankan bersama BPBD dan karang taruna setempat.</p>',
        'goal'        => 'Pos Siaga di 10 Titik Pengungsian',
        'target'      => 'Wilayah rawan banjir dan gempa di NTT',
        'status'      => 'Aktif',
        'category'    => 'Tanggap Bencana',
        'period'      => 'Siaga 2026',
        'image'       => 'programs/tanggap-bencana-pelosok.jpg',
    ],

    [
        'name'        => 'Bibit Harapan Tani Mandiri',
        'slug'        => 'bibit-harapan-tani-mandiri',
        'summary'     => 'Pemberian bibit jagung unggul dan pupuk organik bagi 80 kepala keluarga petani lahan kering Sumba.',
        'description' => '<p>Mendukung ketahanan pangan keluarga anak asuh melalui penyediaan benih bersertifikat dan instalasi penampungan air hujan untuk sistem irigasi tetes skala rumah tangga.</p>',
        'goal'        => '80 Keluarga Petani Berdaya',
        'target'      => 'Petani subsisten di wilayah Sumba Tengah',
        'status'      => 'Aktif',
        'category'    => 'Pemberdayaan',
        'period'      => 'Periode 2026',
        'image'       => null,
    ],

    // ── Program Selesai / Non-Aktif ─────────────────────────────────────
    [
        'name'        => 'Akses Air Bersih & Sanitasi Desa',
        'slug'        => 'akses-air-bersih-sanitasi-desa',
        'summary'     => 'Pembangunan 4 sumur bor dan fasilitas MCK komunal higienis di desa pesisir rawan kekeringan.',
        'description' => '<p>Program ini berhasil diselesaikan pada akhir tahun 2025 dan kini dikelola mandiri secara berkelanjutan oleh himpunan pemuda desa setempat.</p>',
        'goal'        => '4 Titik Sumur Bor Tuntas',
        'target'      => '600 Warga desa pesisir NTT',
        'status'      => 'Non-Aktif',
        'category'    => 'Infrastruktur',
        'period'      => 'Periode 2024–2025',
        'image'       => null,
    ],

    [
        'name'        => 'Literasi Digital Guru Pedalaman',
        'slug'        => 'literasi-digital-guru-pedalaman',
        'summary'     => 'Pelatihan komputer dasar dan media ajar interaktif untuk 45 guru honorer di sekolah pelosok.',
        'description' => '<p>Seluruh sesi pelatihan modul 1 s.d. 4 telah selesai dilaksanakan dengan tingkat kelulusan sertifikasi 100%.</p>',
        'goal'        => '45 Guru Honorer Bersertifikat',
        'target'      => 'Guru SD dan SMP di wilayah perbatasan',
        'status'      => 'Non-Aktif',
        'category'    => 'Pendidikan',
        'period'      => 'Periode 2025',
        'image'       => null,
    ],

    [
        'name'        => 'Pos Gizi Balita Pesisir 2025',
        'slug'        => 'pos-gizi-balita-pesisir-2025',
        'summary'     => 'Intervensi nutrisi darurat 100 hari untuk 120 anak balita di kepulauan terluar Flores.',
        'description' => '<p>Periode intervensi 100 hari selesai dengan hasil penurunan angka wasting sebesar 84% pada kelompok sasaran.</p>',
        'goal'        => '120 Balita Lolos Wasting',
        'target'      => 'Balita kepulauan Flores Timur',
        'status'      => 'Non-Aktif',
        'category'    => 'Kesehatan',
        'period'      => 'Periode 2025',
        'image'       => null,
    ],

];
