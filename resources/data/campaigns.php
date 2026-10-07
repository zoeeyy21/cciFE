<?php

/*
|--------------------------------------------------------------------------
| DATA KAMPANYE GALANG DANA
|--------------------------------------------------------------------------
| File ini adalah sumber data untuk halaman:
|   - /donasi          (halaman jelajah kampanye)
|   - /donasi/{slug}    (halaman detail kampanye)
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
|   'image'        (opsional) Path gambar di storage, contoh: 'campaigns/dede.jpg'
|                             (file fisik di storage/app/public/campaigns/dede.jpg)
|                             Jika kosong, kartu memakai gradien warna otomatis sesuai kategori.
|
| Catatan penting:
|   - Angka 'raised', 'target', 'donors', 'days_left' ditulis sebagai angka murni
|     (tanpa tanda kutip, tanpa titik/koma) agar bisa dihitung otomatis.
|   - Persentase progres dihitung otomatis dari raised / target.
|   - 'slug' harus unik — dipakai sebagai alamat halaman detail.
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

    // ── PENDIDIKAN ────────────────────────────────────────────────────────
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
            'Program ini menyalurkan sepatu baru yang layak untuk 200 anak, lengkap dengan kaos kaki dan perlengkapan sekolah dasar. Donasi yang terkumpul diserahkan langsung ke sekolah-sekolah mitra.',
            'Setiap penyaluran didokumentasikan dengan foto dan daftar nama penerima yang dapat diaudit oleh publik.',
        ],
    ],

    // ── KESEHATAN ─────────────────────────────────────────────────────────
    [
        'slug'         => 'beras-pangan-50-keluarga',
        'title'        => 'Pangan Bergizi untuk 50 Keluarga Pra-Sejahtera',
        'summary'      => 'Setengah dari anak-anak di desa binaan kami kekurangan gizi seimbang. Bantu sediakan beras, telur, dan susu untuk 50 keluarga selama 3 bulan.',
        'category'     => 'kesehatan',
        'organization' => 'Tim Gizi Pelita Bahagia',
        'location'     => 'Kabupaten Rote Ndao, NTT',
        'rounded'      => 0,
        'raised'       => 23500000,
        'target'       => 37500000,
        'donors'       => 512,
        'days_left'    => 12,
        'urgent'       => true,
        'verified'     => true,
        'image'        => 'campaigns/pangan-bergizi.jpg',
        'story'        => [
            'Di Kabupaten Rote Ndao, lebih dari setengah anak-anak di desa binaan tidak mendapatkan asupan gizi seimbang. Hal ini berdampak langsung pada kesehatan dan konsentrasi belajar mereka.',
            'Kampanye ini menyediakan paket pangan bergizi — beras, telur, dan susu — untuk 50 keluarga selama 3 bulan penuh, disalurkan melalui posyandu mitra.',
            'Laporan distribusi lengkap dengan foto dan rincian biaya akan dipublikasikan setiap bulan.',
        ],
    ],

    // ── PEMBERDAYAAN ──────────────────────────────────────────────────────
    [
        'slug'         => 'kelas-jahit-ibu-single',
        'title'        => 'Kelas Jahit untuk 30 Ibu Single Parent',
        'summary'      => 'Bantu 30 ibu single parent di Sumba Timur mandiri secara finansial melalui pelatihan menjahit dan mesin jahit modal usaha.',
        'category'     => 'pemberdayaan',
        'organization' => 'Tim Pemberdayaan Pelita Bahagia',
        'location'     => 'Sumba Timur, NTT',
        'raised'       => 18200000,
        'target'       => 30000000,
        'donors'       => 367,
        'days_left'    => 35,
        'urgent'       => false,
        'verified'     => true,
        'image'        => 'campaigns/kelas-jahit.jpg',
        'story'        => [
            'Banyak ibu single parent di Sumba Timur bekerja sebagai buruh tani harian dengan penghasilan tidak menentu. Mereka ingin mandiri, tapi tidak punya keterampilan khusus.',
            'Program ini memberikan pelatihan menjahit intensif selama 3 bulan, diikuti pemberian mesin jahit dan modal usaha awal bagi 30 peserta.',
            'Setelah lulus, peserta memproduksi seragam sekolah dan pakaian adat yang dipasarkan melalui koperasi mitra.',
        ],
    ],

    // ── BENCANA ───────────────────────────────────────────────────────────
    [
        'slug'         => 'sembako-korban-banjir-bandang',
        'title'        => 'Sembako & Selimut untuk Korban Banjir Bandang',
        'summary'      => 'Banjir bandang menerjang 3 desa di Ende. Ratusan kepala keluarga kehilangan rumah dan membutuhkan kebutuhan dasar segera.',
        'category'     => 'bencana',
        'organization' => 'Tim Tanggap Bencana Pelita Bahagia',
        'location'     => 'Ende, NTT',
        'raised'       => 9800000,
        'target'       => 50000000,
        'donors'       => 234,
        'days_left'    => 7,
        'urgent'       => true,
        'verified'     => true,
        'image'        => 'campaigns/banjir-ende.jpg',
        'story'        => [
            'Banjir bandang akibat hujan lebat berturut-turut menerjang 3 desa di Ende. Ratusan kepala keluarga kehilangan rumah, sawi, dan hewan ternak mereka.',
            'Pengungsi menempati balai desa dan sekolah yang disulap jadi posko darurat. Kebutuhan paling mendesak adalah pangan, selimut, dan air bersih.',
            'Tim relawan kami sudah berada di lokasi sejak 48 jam pertama. Donasi disalurkan langsung dalam bentuk kebutuhan dasar, bukan tunai, agar tepat sasaran.',
        ],
    ],

    // ── PENDIDIKAN ────────────────────────────────────────────────────────
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
        'engine'       => null,
        'story'        => [
            'Mereka adalah anak-anak juara kelas, peraih medali olimpiade sains tingkat kabupaten, dan penulis cerpen berbakat. Tapi semua itu terancam berakhir karena biaya sekolah.',
            'Beasiswa ini menutup SPP, buku, seragam, dan transportasi selama satu tahun ajaran penuh untuk 10 anak pilihan dari Timor Tengah Selatan.',
            'Penerima dipilih bersama dinas pendidikan berdasarkan prestasi akademik dan kondisi ekonomi keluarga. Laporan progres akademik dikirim ke donatur tiap semester.',
        ],
    ],

    // ── KESEHATAN ─────────────────────────────────────────────────────────
    [
        'slug'         => 'posyandu-renovasi-5-desa',
        'title'        => 'Renovasi 5 Posyandu di Desa Terpencil',
        'summary'      => 'Lima posyandu di desa terpencil sudah tidak layak untuk pemeriksaan ibu dan anak. Renovasi posyandu = layanan kesehatan lebih baik.',
        'category'     => 'kesehatan',
        'organization' => 'Tim Kesehatan Pelita Bahagia',
        'location'     => 'Belu, NTT',
        'raised'       => 11200000,
        'target'       => 45000000,
        'donors'       => 189,
        'days_left'    => 42,
        'urgent'       => false,
        'verified'     => true,
        'image'        => 'campaigns/posyandu.jpg',
        'story'        => [
            'Posyandu adalah benteng terdepan kesehatan ibu dan anak di desa. Tapi 5 posyandu mitra kami di Belu sudah rusak parah — atap bocor, lantai berlubang, tanpa timbangan yang layak.',
            'Donasi dipakai untuk renovasi bangunan, pengadaan timbangan bayi, dan perlengkapan pemeriksaan kesehatan dasar.',
            'Renovasi dilakukan bersama warga dan diawasi tim teknisi sukarela kami untuk memastikan kualitas bangunan tahan lama.',
        ],
    ],

];
