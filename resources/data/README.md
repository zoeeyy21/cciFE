# Panduan Mengisi Data — CCI (Yayasan Pelita Bahagia Anak Nusantara)

Semua data website ada di **satu folder**: `resources/data/`.
Tidak perlu mengubah kode view apa pun. Selama file masih kosong (`return [];`),
halaman otomatis menampilkan status kosong yang rapi — bukan error.

---

## 1. Daftar File Data

| File | Mengisi halaman |
|---|---|
| `resources/data/site.php` | Nama, alamat, email, WhatsApp, statistik, kutipan beranda, kisah yayasan, medsos |
| `resources/data/programs.php` | `/program` dan `/program/{slug}` + beranda |
| `resources/data/activities.php` | `/kegiatan` dan `/kegiatan/{slug}` + beranda |
| `resources/data/galleries.php` | `/galeri` + beranda |
| `resources/data/campaigns.php` | `/donasi`, `/donasi/{slug}`, dropdown `/donasi/form` |
| `resources/data/faqs.php` | FAQ di `/kontak` |

Setiap file sudah berisi **contoh lengkap dalam komentar** — cukup hapus `//` di depan baris
untuk mengaktifkannya, lalu ganti isinya.

---

## 2. Cara Menulis Data

### Program — `programs.php`

```php
return [
    [
        'name'        => 'Beasiswa Cerdas Pelosok',
        'slug'        => 'beasiswa-cerdas-pelosok',   // alamat URL, unik
        'summary'     => 'Beasiswa SPP, buku, dan seragam untuk 250 anak.',
        'description' => '<p>Uraian panjang. Boleh HTML.</p>',
        'goal'        => '250 Anak Penerima Beasiswa',
        'target'      => 'Anak usia 6-12 tahun dari keluarga pra-sejahtera',
        'status'      => 'Aktif',
        'category'    => 'Pendidikan',
        'image'       => 'programs/beasiswa.jpg',     // opsional
    ],
];
```

### Kegiatan — `activities.php`

```php
return [
    [
        'title'   => 'Penyaluran 300 Paket Belajar',
        'slug'    => 'penyaluran-300-paket-belajar',
        'date'    => '2026-03-12',                    // format YYYY-MM-DD
        'summary' => 'Ringkasan 1-2 kalimat untuk kartu.',
        'content' => '<p>Uraian panjang. Boleh HTML.</p>',
        'cover'   => 'activities/penyaluran.jpg',     // opsional
    ],
];
```

Urutan tampil = urutan di file. Letakkan yang terbaru di paling atas.

### Galeri — `galleries.php`

```php
return [
    [
        'image'   => 'galleries/senyum-anak.jpg',
        'caption' => 'Senyum ceria siswa SD Pulau Harapan',
    ],
];
```

### Kampanye Donasi — `campaigns.php`

```php
return [
    [
        'slug'         => 'bantu-operasi-jantung-dede',
        'title'        => 'Bantu Operasi Jantung Dede Usia 7 Tahun',
        'summary'      => 'Ringkasan 2-3 kalimat.',
        'category'     => 'kesehatan',   // pendidikan | kesehatan | pemberdayaan | bencana
        'organization' => 'Tim Medis Pelita Bahagia',
        'location'     => 'Sumba Barat, NTT',
        'raised'       => 178500000,     // ANGKA murni, tanpa titik/kutip
        'target'       => 200000000,
        'donors'       => 2890,
        'days_left'    => 3,
        'urgent'       => true,          // badge "Mendesak"
        'verified'     => true,          // badge "Terverifikasi"
        'image'        => 'campaigns/dede.jpg',   // opsional
        'story'        => [
            'Paragraf pertama cerita lengkap.',
            'Paragraf kedua.',
        ],
    ],
];
```

Persentase progres dihitung otomatis dari `raised / target`.

### Identitas & Kontak — `site.php`

```php
'name'       => 'Yayasan Pelita Bahagia Anak Nusantara',
'short_name' => 'Pelita Bahagia',
'tagline'    => 'Cahaya Kebaikan untuk Anak Indonesia',
'address'    => 'Jl. Contoh No. 1, Jakarta Selatan 12430',
'email'      => 'halo@contoh.org',
'phone'      => '+62 812-3456-7890',   // untuk tampilan
'whatsapp'   => '628123456789',        // angka saja untuk tautan wa.me
'legal_number' => 'AHU-0012345.AH.01.04.Tahun 2019',

'stats' => [
    'children'     => 500,
    'children_note' => 'Tersebar di 14 titik pelosok negeri',
    'programs'     => 12,
    'programs_note' => 'Pendidikan & gizi sehat anak',
    'villages'     => 14,
    'founded_year' => 2018,
],

'quote' => [
    'text'   => 'Melihat binar mata anak-anak adalah alasan kami terus bergerak.',
    'author' => 'Nama Anda',
    'role'   => 'Ketua Relawan',
],

'mission' => [
    'badge' => 'Misi Utama 2026',    // kosong -> 'Misi Utama'
    'quote' => 'Ketika satu anak terdidik, satu generasi terselamatkan.',
    'body'  => 'Penjelasan singkat di bawah kutipan (opsional).',
],

'story' => [
    'heading'     => 'Berawal dari Sebuah Ruang Belajar Bambu',
    'paragraph_1' => 'Paragraf pertama kisah yayasan.',
    'paragraph_2' => 'Paragraf kedua (opsional).',
],

'social' => [
    'instagram' => 'https://instagram.com/akun',
    'facebook'  => '',
    'youtube'   => '',
    'tiktok'    => '',
],
```

Catatan tampilan beranda:

- `mission.quote` mengisi kartu besar gelap di hero (ada fallback bila kosong).
- `stats.children`, `stats.programs`, `stats.villages` tampil sebagai daftar angka
  di panel **"Dampak Nyata Kami"** (bukan kartu terpisah). Angka `0` tampil sebagai `—`.
- `stats.founded_year` muncul di baris "Total Penyaluran" pada kartu Misi Utama.

Field yang dikosongkan (`''` atau `0`) otomatis disembunyikan — tidak muncul sebagai
teks kosong atau tautan rusak.

### FAQ — `faqs.php`

```php
return [
    [
        'q' => 'Apakah bisa berdonasi tanpa membuat akun?',
        'a' => 'Bisa. Cukup isi nama, WhatsApp, dan email.',
    ],
];
```

---

## 3. Menambahkan Gambar

1. Taruh file gambar di folder yang sesuai di dalam `storage/app/public/`:

   | Folder | Dipakai untuk field |
   |---|---|
   | `storage/app/public/programs/` | `'image'` pada programs.php |
   | `storage/app/public/activities/` | `'cover'` pada activities.php |
   | `storage/app/public/galleries/` | `'image'` pada galleries.php |
   | `storage/app/public/campaigns/` | `'image'` pada campaigns.php |

2. Tulis **hanya path relatifnya** di file data, contoh: `'programs/beasiswa.jpg'`.
   Jangan tulis `storage/...` atau URL lengkap.

3. Gambar tidak wajib. Jika kosong, kartu memakai gradien warna otomatis
   (khusus kampanye, warnanya mengikuti kategori) — tampilan tetap rapi.

> Tautan `public/storage` sudah dibuat (`php artisan storage:link`).
> Jika proyek dipindah ke komputer lain, jalankan perintah itu sekali lagi.

---

## 4. Setelah Mengubah Data

```bash
# Jika menggunakan server dev, perubahan langsung terlihat (refresh browser).
# Jika data tampak tidak berubah (server production / cache), bersihkan cache view:
php artisan view:clear
php artisan config:clear
```

---

## 5. Yang BELUM Tersambung (Backend)

Saat ini seluruh data murni dari file PHP di `resources/data/`.
Yang masih menunggu backend:

| Fitur | Status sekarang | Rencana |
|---|---|---|
| Simpan donasi | `POST /donasi` hanya tampilkan pesan terima kasih | Simpan ke tabel `donations` |
| Pembayaran | Belum ada integrasi | Midtrans / Xendit / Tripay |
| Hitung `raised` & `donors` | Manual dari file data | Hitung otomatis dari tabel donasi |
| Upload gambar | File manual ke `storage/` | Form upload di admin panel |
| Halaman admin | Belum ada | Panel CRUD untuk semua entitas |

Titik integrasi ada di `routes/web.php` — semua helper data (`cciData()`, `cciCampaigns()`,
`cciPrograms()`, dll.) bisa diganti untuk membaca dari database tanpa mengubah view.