<?php

/*
|--------------------------------------------------------------------------
| PROFIL & IDENTITAS YAYASAN
|--------------------------------------------------------------------------
| File ini adalah sumber data untuk elemen yang muncul di SELURUH halaman:
|   - Nama yayasan, tagline, deskripsi singkat (footer & meta)
|   - Alamat sekretariat, email, nomor WhatsApp (footer & halaman kontak)
|   - Nomor legalitas (SK Kemenkumham)
|   - Statistik dampak di beranda & halaman tentang
|   - Akun media sosial
|
| Setiap nilai yang dibiarkan string kosong '' akan otomatis disembunyikan
| dari tampilan — tidak muncul sebagai teks kosong atau tautan rusak.
|
| Cukup ubah nilai di dalam tanda kutip. Jangan ubah nama kuncinya
| (bagian di sebelah kiri tanda =>).
*/

return [

    // ── IDENTITAS ─────────────────────────────────────────────────────────
    'name'        => 'Yayasan Pelita Bahagia Anak Nusantara',
    'short_name'  => 'Pelita Bahagia',
    'tagline'     => 'Pendidikan Anak & Kepedulian Sosial',
    'description' => 'Membangun generasi peduli, tangguh & berdaya melalui pendidikan anak dan kepedulian sosial seperti pendampingan anak yatim serta aksi kepedulian masyarakat.',
    'legal_number' => '',

    // ── SEKRETARIAT ───────────────────────────────────────────────────────
    'address'      => 'Jl. Pasanggrahan Raya No.1, Cipadung Kulon, Kec. Panyileukan, Kota Bandung, Jawa Barat 40614',
    'email'        => 'pba.nusantara@gmail.com',
    'email_partner' => '',
    'email_volunteer' => '',
    'phone'        => '0821-1518-1505',
    'whatsapp'     => '0821-1518-1505',
    'maps_url'     => 'https://maps.app.goo.gl/n8waSrRJreFtENK36',

    // ── STATISTIK DAMPAK (angka saja, tanpa tanda kutip) ──────────────────
    'stats' => [
        'children'            => 1250,  // jumlah anak terbantu
        'children_note'       => 'Mendapatkan bantuan pendidikan dan kepedulian sosial',
        'programs'            => 6,     // jumlah program aktif
        'programs_completed'  => 28,    // jumlah program yang telah terlaksana
        'programs_note'       => 'Pendidikan anak, nutrisi sehat, dan aksi sosial',
        'packages_distributed'=> '3.500+', // paket perlengkapan sekolah & bantuan sosial
        'founded_year'        => 2021,   // contoh: 2018
        'volunteers'          => 180,   // jumlah relawan
    ],

    // ── MEDIA SOSIAL (kosongkan '' jika tidak ada) ────────────────────────
    'social' => [
        'instagram' => 'https://www.instagram.com/pelitabahagia',
        'facebook'  => '',
        'youtube'   => 'https://www.youtube.com/@YayasanPelitaBahagia',
        'tiktok'    => 'https://www.tiktok.com/@yayasanpelita',
    ],

    // ── STATISTIK MEDIA SOSIAL ─────────────────────────────────────────────
    'social_stats' => [
        'instagram_handle'    => '@pelitabahagia',
        'instagram_followers' => '1.174',
        'instagram_posts'     => '408',
        'youtube_handle'      => '@YayasanPelitaBahagia',
        'tiktok_handle'       => '@yayasanpelita',
    ],

    // ── KUTIPAN / TESTIMONI BERANDA ───────────────────────────────────────
    // Kosongkan 'text' untuk menyembunyikan blok ini dari beranda.
    'quote' => [
        'text'   => '',
        'author' => '',
        'role'   => '',
    ],

    // ── KISAH YAYASAN (halaman Tentang) ───────────────────────────────────
        'story' => [
            'lead'        => 'Yayasan Pelita Bahagia Anak Nusantara lahir dari sebuah keyakinan sederhana bahwa setiap anak, tanpa memandang latar belakangnya, berhak bermimpi dan meraih cita-cita yang gemilang.',
            'heading'     => 'Berawal dari Sebuah Ruang Belajar Bambu di Tahun 2021',
            'paragraph_1' => 'Pelita Bahagia bermula dari sebuah ruang belajar bambu di desa pedalaman tahun 2021. Saat itu, sekelompok relawan mengajar membaca dan berhitung kepada 30 anak yang putus sekolah akibat keterbatasan sarana belajar.',
            'paragraph_2' => 'Dari ruang bambu itu, gerakan kecil ini tumbuh menjadi yayasan berbadan hukum yang kini menjangkau ribuan anak di berbagai pelosok nusantara. Kami percaya bahwa setiap anak, siapapun dan dimanapun dilahirkan, berhak bermimpi dan mengenyam pendidikan yang layak.',
        ],

        // ── MISI UTAMA (kartu besar di hero beranda) ──────────────────────────
        'mission' => [
            'badge' => 'Misi Utama 2026',
            'quote' => 'Ketika satu anak terdidik, satu generasi terselamatkan.',
            'body'  => 'Tahun ini kami menargetkan 2.500 anak terbantu melalui beasiswa, fasilitas penunjang belajar, nutrisi sehat, dan berbagai aksi kepedulian sosial di pelosok nusantara.',
        ],
    ];
