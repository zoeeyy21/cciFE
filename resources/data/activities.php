<?php

/*
|--------------------------------------------------------------------------
| DATA KEGIATAN / BERITA
|--------------------------------------------------------------------------
| File ini adalah sumber data untuk halaman:
|   - Beranda         (section "Kabar & Catatan Lapangan")
|   - /kegiatan        (daftar semua kegiatan)
|   - /kegiatan/{slug} (halaman detail kegiatan)
|
| Struktur tiap kegiatan:
|   'title'   (wajib)  Judul kegiatan, contoh: 'Penyaluran 300 Paket Belajar'
|   'slug'    (wajib)  Alamat URL, huruf kecil tanpa spasi, contoh: 'penyaluran-300-paket-belajar'
|   'date'    (wajib)  Tanggal kegiatan format 'YYYY-MM-DD', contoh: '2026-03-12'
|   'summary' (wajib)  Ringkasan 1-2 kalimat untuk kartu di daftar
|   'content' (opsional) Uraian panjang untuk halaman detail. Boleh HTML.
|   'cover'   (opsional) Path gambar di storage, contoh: 'activities/penyaluran.jpg'
|                        (file fisik disimpan di storage/app/public/activities/penyaluran.jpg)
|
| Catatan: 'slug' harus unik. Urutan tampil mengikuti urutan di file ini —
| letakkan kegiatan terbaru di paling atas.
*/

return [

    [
        'title'   => 'Penyaluran 300 Paket Belajar di Pulau Harapan',
        'slug'    => 'penyaluran-300-paket-belajar-pulau-harapan',
        'date'    => '2026-09-28',
        'summary' => 'Relawan menyeberangi laut membawa paket buku tulis, tas, dan sepatu baru untuk anak sekolah pesisir.',
        'content' => '<p>Kegiatan berlangsung sejak pagi hari bersama warga setempat. Tiga ratus paket belajar berisi buku tulis, tas, sepatu, dan perlengkapan sekolah diserahkan langsung kepada siswa SD di Pulau Harapan.</p><p>Untuk mencapai pulau ini, tim relawan harus menyeberang laut selama dua jam menggunakan perahu nelayan. Antusiasme anak-anak saat menerima paket menjadi penyemangat sepanjang perjalanan.</p><p>Program ini didukung penuh oleh donatur melalui kampanye <a href="/donasi/sepatu-baru-200-anak-pelosok">Sepatu Baru untuk 200 Anak Pelosok Sumba</a>. Terima kasih atas kepercayaan Anda.</p>',
        'cover'   => 'activities/penyaluran-pulau-harapan.jpg',
    ],

    [
        'title'   => 'Pemeriksaan Kesehatan Gratis untuk 500 Warga Desa Binaan',
        'slug'    => 'pemeriksaan-kesehatan-gratis-500-warga',
        'date'    => '2026-09-14',
        'summary' => 'Tim dokter relawan memeriksa kesehatan 500 warga desa yang jangkauan puskesmasnya lebih dari tiga jam.',
        'content' => '<p>Satu hari penuh, lima dokter dan delapan perawat relawan melayani pemeriksaan kesehatan gratis untuk 500 warga di dua desa binaan. Layanan meliputi pemeriksaan tekanan darah, gula darah, hingga konsultasi gizi untuk ibu hamil dan balita.</p><p>Warga yang membutuhkan penanganan lebih lanjut langsung dirujuk ke puskesmas terdekat menggunakan ambulans desa yang sudah disiapkan.</p><p>Kegiatan ini bagian dari program <a href="/program/balai-sehat-desa">Balai Sehat Desa</a> yang berfokus pada wilayah dengan akses kesehatan sulit.</p>',
        'cover'   => 'activities/pemeriksaan-kesehatan.jpg',
    ],

    [
        'title'   => 'Wisuda Kelas Jahit Ibu Tangguh Angkatan Pertama',
        'slug'    => 'wisuda-kelas-jahit-ibu-tangguh',
        'date'    => '2026-08-30',
        'summary' => 'Tiga puluh ibu single parent menyelesaikan pelatihan menjahit dan menerima mesin jahit untuk memulai usaha.',
        'content' => '<p>Setelah tiga bulan pelatihan intensif, tiga puluh ibu single parent di Sumba Timur diwisuda sebagai penjahit bersertifikat. Mereka menerima mesin jahit dan modal usaha awal untuk segera memulai produksi.</p><p>"Sekarang saya bisa menjahit seragam sekolah dan menghasilkan uang sendiri. Anak saya tidak perlu malu lagi saat berangkat sekolah," ujar Ibu Maria, salah satu peserta.</p><p>Penyaluran mesin jahit ini didanai dari kampanye <a href="/donasi/kelas-jahit-ibu-single">Kelas Jahit untuk 30 Ibu Single Parent</a>. Pemasaran produk dilakukan melalui koperasi mitra.</p>',
        'cover'   => 'activities/wisuda-jahit.jpg',
    ],

    [
        'title'   => 'Bantuan Darurat Banjir Bandang Ende',
        'slug'    => 'bantuan-darurat-banjir-bandang-ende',
        'date'    => '2026-08-12',
        'summary' => 'Tim tanggap bencana menyalurkan sembako, selimut, dan air bersih untuk pengungsi banjir bandang di Ende.',
        'content' => '<p>Banjir bandang menerjang tiga desa di Ende pada awal Agustus. Tim relawan Pelita Bahagia tiba di lokasi dalam 48 jam pertama dengan membawa kebutuhan dasar untuk ratusan kepala keluarga.</p><p>Bantuan yang disalurkan meliputi beras, mi instan, selimut, dan air mineral. Distribusi dilakukan koordinasi penuh dengan BPBD dan karang taruna setempat agar tidak ada yang tertinggal.</p><p>Donasi untuk korban banjir masih dibuka melalui kampanye <a href="/donasi/sembako-korban-banjir-bandang">Sembako & Selimut untuk Korban Banjir Bandang</a>.</p>',
        'cover'   => 'activities/banjir-ende.jpg',
    ],

    [
        'title'   => 'Peluncuran Program Beasiswa Cerdas Pelosok 2026',
        'slug'    => 'peluncuran-beasiswa-cerdas-pelosok-2026',
        'date'    => '2026-07-20',
        'summary' => 'Seratus lima puluh anak pra-sejahtera resmi menjadi penerima beasiswa penuh tahun ajaran 2026.',
        'content' => '<p>Acara peluncuran digelar di salah satu SMP mitra di Nusa Tenggara Timur. Seratus lima puluh anak dari keluarga pra-sejahtera resmi menerima beasiswa penuh untuk tahun ajaran 2026.</p><p>Setiap penerima beasiswa mendapatkan pembayaran SPP bulanan, perlengkapan sekolah lengkap, dan pendampingan belajar rutin oleh relawan. Pemilihan penerima dilakukan bersama dinas pendidikan dan kepala desa.</p><p>Program <a href="/program/beasiswa-cerdas-pelosok">Beasiswa Cerdas Pelosok</a> menargetkan 250 anak penerima di tahun ini.</p>',
        'cover'   => 'activities/beasiswa-launch.jpg',
    ],

    [
        'title'   => 'Renovasi Ruang Kelas Pertama di Sekolah Dasar Waijelu',
        'slug'    => 'renovasi-ruang-kelas-waijelu',
        'date'    => '2026-06-08',
        'summary' => 'Ruang kelas berusia 40 tahun di SD Waijelu akhirnya direnovasi menjadi ruang belajar yang aman dan nyaman.',
        'content' => '<p>Selama empat dekade, siswa SD Waijelu belajar di ruang kelas dengan atap bocor dan lantai berlubang. Bulan Juni ini, renovasi pertama dari program <a href="/program/ruang-belajar-cerah">Ruang Belajar Cerah</a> resmi selesai.</p><p>Ruang kelas baru kini memiliki atap kokoh, lantai keramik, papan tulis baru, dan sudut baca berisi 300 lebih buku. Serahterima dilakukan langsung kepada pihak sekolah dan menjadi tanggung jawab bersama warga sekitar.</p><p>Sebelas ruang kelas lain di enam desa pedalaman Sumba menyusul hingga akhir tahun.</p>',
        'cover'   => 'activities/renovasi-kelas.jpg',
    ],

];
