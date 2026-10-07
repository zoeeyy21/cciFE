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
    'tagline'     => 'Cahaya Kebaikan untuk Anak Indonesia',
    'description' => 'Yayasan sosial yang bergerak di bidang pendidikan, gizi, dan perlindungan anak di wilayah pelosok Indonesia.',
    'legal_number' => 'AHU-0012345.AH.01.04.Tahun 2021',

    // ── SEKRETARIAT ───────────────────────────────────────────────────────
    'address'      => 'Jl. Pelita Harapan No. 42, Cilandak, Jakarta Selatan 12430',
    'email'        => 'halo@pelitabahagia.org',
    'email_partner' => 'kemitraan@pelitabahagia.org',
    'email_volunteer' => 'relawan@pelitabahagia.org',
    'phone'        => '+62 812-3456-7890',
    'whatsapp'     => '6281234567890',
    'maps_url'     => 'https://maps.app.goo.gl/pelitabahagia',

    // ── STATISTIK DAMPAK (angka saja, tanpa tanda kutip) ──────────────────
    'stats' => [
        'children'     => 1250,  // jumlah anak asuh
        'children_note' => 'Tersebar di 24 titik pelosok Nusa Tenggara Timur',
        'programs'     => 6,   // jumlah program rutin
        'programs_note' => 'Pendidikan, gizi sehat, dan pemberdayaan keluarga',
        'villages'     => 24,   // jumlah desa binaan
        'founded_year' => 2021,   // contoh: 2018
        'volunteers'   => 180,   // jumlah relawan
    ],

    // ── MEDIA SOSIAL (kosongkan '' jika tidak ada) ────────────────────────
    'social' => [
        'instagram' => 'https://instagram.com/pelitabahagia',
        'facebook'  => 'https://facebook.com/pelitabahagia',
        'youtube'   => 'https://youtube.com/@pelitabahagia',
        'tiktok'    => 'https://tiktok.com/@pelitabahagia',
    ],

    // ── KUTIPAN / TESTIMONI BERANDA ───────────────────────────────────────
    // Kosongkan 'text' untuk menyembunyikan blok ini dari beranda.
    'quote' => [
        'text'   => 'Melihat binar mata anak-anak memegang buku baru adalah alasan kami terus bergerak. Setiap donasi adalah pelita yang tidak akan pernah padam.',
        'author' => 'Rizky Amanda',
        'role'   => 'Ketua Relawan Yayasan Pelita Bahagia',
    ],

    // ── KISAH YAYASAN (halaman Tentang) ───────────────────────────────────
        'story' => [
            'heading'     => 'Berawal dari Sebuah Ruang Belajar Bambu di Tahun 2021',
            'paragraph_1' => 'Pelita Bahagia bermula dari sebuah ruang belajar bambu di desa pedalaman Sumba tahun 2021. Saat itu, sekelompok relawan mengajar membaca dan berhitung kepada 30 anak yang putus sekolah akibat jarak sekolah terlalu jauh.',
            'paragraph_2' => 'Dari ruang bambu itu, gerakan kecil ini tumbuh menjadi yayasan berbadan hukum yang kini menjangkau ribuan anak di 24 desa pelosok Nusa Tenggara Timur. Kami percaya bahwa setiap anak, siapapun dan dimanapun dilahirkan, berhak bermimpi dan meraih masa depan.',
        ],

        // ── MISI UTAMA (kartu besar di hero beranda) ──────────────────────────
        'mission' => [
            'badge' => 'Misi Utama 2026',
            'quote' => 'Ketika satu anak terdidik, satu generasi terselamatkan.',
            'body'  => 'Tahun ini kami menargetkan 2.500 anak terbantu melalui beasiswa, intervensi gizi, dan pemberdayaan keluarga di 24 desa binaan.',
        ],
    ];
