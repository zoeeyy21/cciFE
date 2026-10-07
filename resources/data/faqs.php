<?php

/*
|--------------------------------------------------------------------------
| DATA FAQ (Pertanyaan Yang Sering Diajukan)
|--------------------------------------------------------------------------
| File ini adalah sumber data untuk halaman:
|   - /kontak  (accordion FAQ)
|
| Struktur tiap item:
|   'q' (wajib) Pertanyaan
|   'a' (wajib) Jawaban — boleh HTML sederhana, contoh: '<strong>Ya.</strong> Bisa.'
|
| Urutan tampil mengikuti urutan di file ini.
*/

return [

    [
        'q' => 'Apakah saya bisa berdonasi tanpa membuat akun?',
        'a' => '<strong>Bisa.</strong> Cukup isi nama (boleh anonim), nomor WhatsApp, dan email untuk pengiriman bukti donasi. Tidak perlu registrasi.',
    ],
    [
        'q' => 'Bagaimana cara saya tahu donasi benar-benar tersalurkan?',
        'a' => 'Setiap penyaluran dilaporkan melalui halaman <a href="/kegiatan"><strong>Kegiatan</strong></a> lengkap dengan dokumentasi foto dan rincian pengeluaran. Donatur juga menerima laporan berkala melalui email.',
    ],
    [
        'q' => 'Berapa nominal minimal untuk berdonasi?',
        'a' => 'Donasi minimal <strong>Rp 10.000</strong>. Tidak ada nominal maksimal. Anda juga bisa memilih donasi rutin bulanan untuk dampak yang berkelanjutan.',
    ],
    [
        'q' => 'Apakah ada potongan biaya administrasi dari donasi saya?',
        'a' => '<strong>Tidak ada.</strong> 100% dana donasi disalurkan langsung untuk kebutuhan program dan penerima manfaat. Biaya operasional yayasan ditanggung dari dana patnership korporat.',
    ],
    [
        'q' => 'Metode pembayaran apa saja yang tersedia?',
        'a' => 'Kami menerima <strong>QRIS</strong> (Gopay, OVO, DANA), <strong>Virtual Account</strong> BCA, Mandiri, dan BRI. Konfirmasi pembayaran otomatis dikirim via WhatsApp dan email.',
    ],
    [
        'q' => 'Bisakah saya menyumbang barang atau menjadi relawan?',
        'a' => 'Sangat bisa. Untuk donasi barang atau pendaftaran relawan, silakan hubungi kami melalui halaman <a href="/kontak"><strong>Kontak</strong></a> atau chat langsung ke WhatsApp tim kami.',
    ],
    [
        'q' => 'Apakah donasi saya dapat pajak (keringanan pajak)?',
        'a' => 'Ya. Kami adalah yayasan berbadan hukum Kemenkumham, sehingga donasi Anda dapat dimasukkan sebagai pengurang penghasilan bruto dalam SPT Tahunan sesuai peraturan perpajakan yang berlaku.',
    ],
    [
        'q' => 'Bagaimana jika saya ingin berhenti dari donasi rutin bulanan?',
        'a' => 'Anda bisa berhenti kapan saja melalui WhatsApp tim donatur. Tidak ada penalti atau denda — donasi rutin sepenuhnya atas kemauan Anda.',
    ],

];
