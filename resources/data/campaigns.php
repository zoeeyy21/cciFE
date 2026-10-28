<?php

/*
|--------------------------------------------------------------------------
| DATA KAMPANYE GALANG DANA
|--------------------------------------------------------------------------
| File ini adalah sumber data untuk halaman:
|   - /donasi          (halaman jelajah kampanye)
|   - /donasi/{slug}    (halaman detail kampanye & form donasi)
|   - /donasi/form      (dropdown pilihan peruntukan dana)
|
| Struktur tiap kampanye:
|   'slug'         (wajib)  Alamat URL, huruf kecil tanpa spasi, contoh: 'bantu-operasi-dede'
|   'title'        (wajib)  Judul kampanye
|   'summary'      (wajib)  Ringkasan 2-3 kalimat (tampil di kartu & jadi kutipan di detail)
|   'category'     (wajib)  Salah satu dari: 'pendidikan', 'kesehatan', 'pemberdayaan', 'bencana'
|   'organization' (wajib)  Nama pengelola/penggalang, contoh: 'Tim Medis Pelita Bahagia'
|   'location'     (wajib)  Lokasi, contoh: 'Sumba Barat, NTT'
|   'raised'       (wajib)  Dana terkumpul dalam angka rupiah TANPA titik, contoh: 178500000
|   'target'       (wajib)  Target dana dalam angka rupiah TANPA titik, contoh: 200000000
|   'donors'       (wajib)  Jumlah donatur (angka), contoh: 2890
|   'days_left'    (wajib)  Sisa hari (angka), contoh: 3
|   'urgent'       (wajib)  true = tampil badge "Mendesak" & diprioritaskan. false = biasa
|   'verified'     (wajib)  true = tampil badge "Terverifikasi"
|   'story'        (wajib)  Array paragraf untuk "Cerita Lengkap" di halaman detail
|   'image'        (opsional) Path gambar di storage
*/

return [

    // ── KESEHATAN — paling mendesak ─────────────────────────────────────
    [
        'slug'         => 'bantu-operasi-jantung-dede',
        'title'        => 'Bantu Operasi Jantung Dede Usia 7 Tahun',
        'summary'      => 'Dede menderita kelainan katup jantung sejak lahir. Biaya operasi penuh mencapai Rp 200 juta, sementara ayahnya hanya penjual ikan keliling.',
        'category'     => 'kesehatan',
        'organization' => 'Tim Medis Pelita Bahagia',
        'location'     => 'Sumba Barat, NTT',
        'raised'       => 178500000,
        'target'       => 200000000,
        'donors'       => 2890,
        'days_left'    => 3,
        'urgent'       => true,
        'verified'     => true,
        'image'        => 'campaigns/dede.jpg',
        'story'        => [
            'Dede lahir dengan kondisi kelainan katup jantung bawaan yang membuatnya mudah lelah. Satu dekade berlalu, namun biaya operasi selalu menjadi penghalang. Ayahnya, seorang penjual ikan keliling, tak mampu menanggung biaya operasi yang mencapai Rp 200 juta.',
            'Tim dokter menyatakan operasi harus segera dilakukan bulan ini. Setiap hari yang berlalu, jantungnya bekerja semakin berat untuk memompa darah ke seluruh tubuhnya.',
            'Dana terkumpul akan digunakan untuk biaya operasi, rawat inap, dan pemulihan. Seluruh biaya akan dipertanggungjawabkan secara terbuka dengan bukti kuitansi resmi.',
        ],
    ],

    // ── PROGRAM PENDIDIKAN 1 ──────────────────────────────────────────────
    [
        'slug'         => 'beasiswa-cerdas-pelosok',
        'title'        => 'Beasiswa Cerdas Pelosok untuk 250 Anak NTT',
        'summary'      => 'Beasiswa SPP, buku, dan seragam untuk 250 anak pra-sejahtera di pelosok Nusa Tenggara Timur agar tetap dapat bersekolah.',
        'category'     => 'pendidikan',
        'organization' => 'Tim Pendidikan Pelita Bahagia',
        'location'     => 'Timor Tengah Selatan, NTT',
        'raised'       => 45200000,
        'target'       => 60000000,
        'donors'       => 846,
        'days_left'    => 21,
        'urgent'       => false,
        'verified'     => true,
        'image'        => 'programs/beasiswa-cerdas-pelosok.jpg',
        'story'        => [
            'Di desa-desa pedalaman Nusa Tenggara Timur, ratusan anak berprestasi dari keluarga pra-sejahtera terancam putus sekolah karena keterbatasan biaya perlengkapan dan seragam.',
            'Program Beasiswa Cerdas Pelosok memastikan 250 anak mendapatkan dukungan SPP, paket buku, dan seragam layak selama 1 tahun ajaran penuh.',
            'Laporan penyaluran donasi dan rapor perkembangan belajar anak dikirimkan secara transparan kepada para donatur setiap semester.',
        ],
    ],

    // ── PROGRAM PENDIDIKAN 2 ──────────────────────────────────────────────
    [
        'slug'         => 'ruang-belajar-cerah',
        'title'        => 'Renovasi 12 Ruang Belajar Cerah Pedalaman Sumba',
        'summary'      => 'Renovasi 12 ruang kelas usang di sekolah pedalaman Sumba lengkap dengan penyediaan 300+ sudut buku bacaan berkualitas.',
        'category'     => 'pendidikan',
        'organization' => 'Tim Pendidikan Pelita Bahagia',
        'location'     => 'Sumba Tengah, NTT',
        'raised'       => 38400000,
        'target'       => 50000000,
        'donors'       => 615,
        'days_left'    => 28,
        'urgent'       => false,
        'verified'     => true,
        'image'        => 'programs/ruang-belajar-cerah.jpg',
        'story'        => [
            'Banyak ruang kelas di sekolah pedalaman Sumba dalam kondisi rusak berat — atap seng bocor saat musim hujan, lantai berdebu, dan minim penerangan.',
            'Melalui renovasi Ruang Belajar Cerah, kami memperbaiki fasilitas fisik sekolah agar aman dan menghadirkan pojok baca anak dengan ratusan buku edukatif.',
            'Donasi Anda dialokasikan untuk material bangunan, meja-kursi belajar baru, dan buku bacaan anak.',
        ],
    ],

    // ── PROGRAM KESEHATAN 1 ───────────────────────────────────────────────
    [
        'slug'         => 'piring-bergizi-anti-stunting',
        'title'        => 'Piring Bergizi Anti-Stunting untuk 400 Balita NTT',
        'summary'      => 'Paket makanan bergizi harian dan susu untuk 400 balita di 8 desa endemik stunting Nusa Tenggara Timur.',
        'category'     => 'kesehatan',
        'organization' => 'Tim Gizi Pelita Bahagia',
        'location'     => 'Kabupaten Rote Ndao, NTT',
        'raised'       => 23500000,
        'target'       => 37500000,
        'donors'       => 512,
        'days_left'    => 12,
        'urgent'       => true,
        'verified'     => true,
        'image'        => 'programs/piring-bergizi-anti-stunting.jpg',
        'story'        => [
            'Angka stunting di wilayah pelosok NTT masih memerlukan perhatian serius. Balita kekurangan asupan protein hewani dan zat gizi mikro esensial pada 1.000 hari pertama kehidupan.',
            'Kampanye Piring Bergizi menyalurkan paket makanan bergizi (telur, susu, ikan, dan kacang-kacangan) setiap hari untuk 400 balita yang dipantau langsung oleh kader posyandu.',
            'Penimbangan berat badan dan pengukuran tinggi badan dilakukan berkala untuk memastikan penurunan angka stunting nyata.',
        ],
    ],

    // ── PROGRAM KESEHATAN 2 ───────────────────────────────────────────────
    [
        'slug'         => 'balai-sehat-desa',
        'title'        => 'Operasional Balai Sehat Desa untuk 1.000 Warga Pelosok',
        'summary'      => 'Pemeriksaan medis gratis, USG ibu hamil, dan obat-obatan untuk 1.000 warga desa yang jangkauan puskesmasnya lebih dari 3 jam perjalanan.',
        'category'     => 'kesehatan',
        'organization' => 'Tim Medis Pelita Bahagia',
        'location'     => 'Belu, NTT',
        'raised'       => 11200000,
        'target'       => 45000000,
        'donors'       => 289,
        'days_left'    => 38,
        'urgent'       => false,
        'verified'     => true,
        'image'        => 'programs/balai-sehat-desa.jpg',
        'story'        => [
            'Warga desa pelosok di Kabupaten Belu harus menempuh jalan berbatu terjal berjam-jam hanya untuk memeriksakan demam atau memeriksa kandungan.',
            'Balai Sehat Desa menghadirkan dokter dan perawat relawan langsung ke pintu rumah warga dengan obat-obatan dasar dan alat diagnostik lengkap.',
            'Dukungan Anda membantu penyediaan obat gratis, vitamin anak, dan biaya operasional tim medis lapangan.',
        ],
    ],

    // ── PROGRAM PEMBERDAYAAN ──────────────────────────────────────────────
    [
        'slug'         => 'ibu-tangguh-ekonomi',
        'title'        => 'Modal Usaha Mandiri untuk 120 Ibu Tangguh Sumba',
        'summary'      => 'Pelatihan kewirausahaan, alat jahit, dan modal usaha awal untuk 120 ibu single parent di Sumba Timur agar mandiri menafkahi keluarga.',
        'category'     => 'pemberdayaan',
        'organization' => 'Tim Pemberdayaan Pelita Bahagia',
        'location'     => 'Sumba Timur, NTT',
        'raised'       => 18200000,
        'target'       => 30000000,
        'donors'       => 367,
        'days_left'    => 35,
        'urgent'       => false,
        'verified'     => true,
        'image'        => 'programs/ibu-tangguh-ekonomi.jpg',
        'story'        => [
            'Para ibu tunggal di pedalaman Sumba adalah tulang punggung keluarga yang gigih. Namun ketiadaan modal dan keahlian seringkali menjebak mereka dalam kemiskinan ekstrem.',
            'Melalui program ini, setiap ibu mendapatkan pelatihan menjahit, mesin jahit baru, dan pendampingan pemasaran produk kerajinan tenun serta seragam lokal.',
            'Dengan ekonomi keluarga yang mandiri, anak-anak mereka terjamin pendidikannya dan tidak perlu putus sekolah.',
        ],
    ],

    // ── PROGRAM TANGGAP BENCANA ───────────────────────────────────────────
    [
        'slug'         => 'tanggap-bencana-pelosok',
        'title'        => 'Pos Siaga & Tanggap Bencana Darurat Pelosok NTT',
        'summary'      => 'Stok logistik darurat, tenda evakuasi, dan dapur umum siap pakai untuk wilayah rawan banjir bandang dan longsor.',
        'category'     => 'bencana',
        'organization' => 'Tim Tanggap Bencana Pelita Bahagia',
        'location'     => 'Ende, NTT',
        'raised'       => 9800000,
        'target'       => 50000000,
        'donors'       => 234,
        'days_left'    => 7,
        'urgent'       => true,
        'verified'     => true,
        'image'        => 'programs/tanggap-bencana-pelosok.jpg',
        'story'        => [
            'Banjir bandang dan cuaca ekstrem seringkali memutus akses jembatan antardesa di NTT, menyebabkan ratusan warga mengungsi tanpa makanan hangat dan pakaian kering.',
            'Pos Siaga Bencana menyiapkan buffer stock tenda, selimut, air bersih, dan bahan makanan siap saji yang dapat dimobilisasi dalam 6 jam pertama bencana.',
            'Bantuan disalurkan langsung oleh relawan terlatih bekerja sama dengan BPBD dan masyarakat setempat.',
        ],
    ],

    // ── PROGRAM PEMBERDAYAAN TANI ─────────────────────────────────────────
    [
        'slug'         => 'bibit-harapan-tani-mandiri',
        'title'        => 'Bibit Harapan & Ketahanan Tani Mandiri Sumba',
        'summary'      => 'Pemberian benih jagung unggul tahan kekeringan dan pupuk organik untuk 80 keluarga petani lahan kering Sumba Tengah.',
        'category'     => 'pemberdayaan',
        'organization' => 'Tim Pemberdayaan Pelita Bahagia',
        'location'     => 'Sumba Tengah, NTT',
        'raised'       => 14500000,
        'target'       => 25000000,
        'donors'       => 198,
        'days_left'    => 40,
        'urgent'       => false,
        'verified'     => true,
        'image'        => null,
        'story'        => [
            'Pertanian lahan kering di Sumba sering mengalami gagal panen akibat kemarau panjang. Program ini memberikan bibit jagung bersertifikat tahan cuaca kering dan pelatihan pupuk kompos alami.',
            'Hasil panen diprioritaskan untuk pemenuhan gizi keluarga anak asuh, dan sisanya dijual untuk tabungan biaya sekolah anak.',
        ],
    ],

    // ── ALIAS / KAMPANYE TAMBAHAN ─────────────────────────────────────────
    [
        'slug'         => 'sepatu-baru-200-anak-pelosok',
        'title'        => 'Sepatu Baru untuk 200 Anak Pelosok Sumba',
        'summary'      => 'Dua ratus anak di 4 desa pedalaman Sumba berjalan bermil-mil ke sekolah dengan alas kaki yang sudah hancur. Donasi satu pasang sepatu berarti dunia bagi mereka.',
        'category'     => 'pendidikan',
        'organization' => 'Tim Pendidikan Pelita Bahagia',
        'location'     => 'Sumba Tengah, NTT',
        'raised'       => 45200000,
        'target'       => 60000000,
        'donors'       => 846,
        'days_left'    => 21,
        'urgent'       => false,
        'verified'     => true,
        'image'        => 'campaigns/sepatu-anak.jpg',
        'story'        => [
            'Di desa-desa pedalaman Sumba, banyak anak yang harus berjalan bermil-mil untuk sampai ke sekolah. Sepatu mereka sudah berlubang, solnya tipis menghadapi jalan berbatu.',
            'Program ini menyalurkan sepatu baru yang layak untuk 200 anak, lengkap dengan kaos kaki dan perlengkapan sekolah dasar.',
        ],
    ],

    [
        'slug'         => 'beasiswa-10-anak-juara',
        'title'        => 'Beasiswa 1 Tahun untuk 10 Anak Juara Pelosok',
        'summary'      => 'Sepuluh anak berprestasi dari keluarga miskin terancam putus sekolah. Beasiswa ini menutup SPP, buku, dan seragam mereka selama setahun penuh.',
        'category'     => 'pendidikan',
        'organization' => 'Tim Pendidikan Pelita Bahagia',
        'location'     => 'Timor Tengah Selatan, NTT',
        'raised'       => 67500000,
        'target'       => 90000000,
        'donors'       => 1204,
        'days_left'    => 28,
        'urgent'       => false,
        'verified'     => true,
        'image'        => 'campaigns/beasiswa-juara.jpg',
        'story'        => [
            'Mereka adalah anak-anak berprestasi yang terancam putus sekolah karena biaya. Beasiswa ini menutup biaya pendidikan penuh selama satu tahun.',
        ],
    ],

];
