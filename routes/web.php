<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

View::share('site', cciSite());

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES — Yayasan Pelita Bahagia Anak Nusantara
|--------------------------------------------------------------------------
| Scope: tampilan (resources) + rute saja. Bagian backend (controllers,
| models, migrations, seeders, integrasi payment) dikerjakan terpisah.
|
| ══════════════════════════════════════════════════════════════════════════
|  ISI DATA DI SINI (TIDAK PERLU UBAH KODE VIEW):
|    resources/data/site.php        -> identitas, alamat, kontak, statistik,
|                                     kutipan beranda, kisah yayasan, medsos
|    resources/data/programs.php    -> program
|    resources/data/activities.php  -> kegiatan / berita
|    resources/data/galleries.php   -> galeri foto
|    resources/data/campaigns.php   -> kampanye galang dana
|    resources/data/faqs.php        -> FAQ halaman kontak
|  Setiap file berisi petunjuk lengkap struktur datanya di bagian atas.
|  Selama file masih mengembalikan [ ] (kosong), halaman menampilkan
|  status kosong yang rapi — bukan error.
| ══════════════════════════════════════════════════════════════════════════
|
| Halaman donasi:
|   GET  /donasi           -> jelajah kampanye
|   GET  /donasi/form      -> formulir donasi mandiri
|   GET  /donasi/{slug}    -> detail kampanye + form donasi inline
|   POST /donasi           -> submit donasi (handler sementara)
|
| Gambar: file fisik diletakkan di storage/app/public/<folder>/
|         lalu ditulis path-nya (mis. 'programs/foto.jpg') pada file data.
|         Jalankan `php artisan storage:link` sekali agar dapat diakses.
*/

/** Muat file data; jika belum ada atau isinya kosong, kembalikan array kosong. */
function cciData(string $name): array
{
    $path = resource_path("data/{$name}.php");

    if (! is_file($path)) {
        return [];
    }

    $data = require $path;

    return is_array($data) ? $data : [];
}

/** Profil & identitas yayasan (alamat, kontak, statistik, medsos). */
function cciSite(): array
{
    $defaults = [
        'name' => 'Yayasan Pelita Bahagia Anak Nusantara',
        'short_name' => 'Pelita Bahagia',
        'tagline' => '',
        'description' => '',
        'legal_number' => '',
        'address' => '',
        'email' => '',
        'email_partner' => '',
        'email_volunteer' => '',
        'phone' => '',
        'whatsapp' => '',
        'maps_url' => '',
        'stats' => [
            'children' => 0, 'children_note' => '',
            'programs' => 0, 'programs_note' => '',
            'villages' => 0, 'founded_year' => 0, 'volunteers' => 0,
        ],
        'social' => ['instagram' => '', 'facebook' => '', 'youtube' => '', 'tiktok' => ''],
        'quote' => ['text' => '', 'author' => '', 'role' => ''],
        'story' => ['heading' => '', 'paragraph_1' => '', 'paragraph_2' => ''],
        'mission' => ['badge' => '', 'quote' => '', 'body' => ''],
    ];

    $site = array_replace_recursive($defaults, cciData('site'));

    // Bersihkan tautan WhatsApp menjadi digit saja untuk wa.me
    $site['whatsapp_link'] = $site['whatsapp']
        ? 'https://wa.me/' . preg_replace('/\D/', '', $site['whatsapp'])
        : '';

    return $site;
}

/** Kategori kampanye beserta labelnya. */
function cciCampaignCategories(): array
{
    return [
        'pendidikan'    => 'Pendidikan',
        'kesehatan'     => 'Kesehatan & Gizi',
        'pemberdayaan'  => 'Pemberdayaan',
        'bencana'       => 'Tanggap Bencana',
    ];
}

/** Normalisasi satu data kampanye agar aman dipakai view walau beberapa field kosong. */
function cciCampaign(array $c): array
{
    $categories = cciCampaignCategories();

    return array_merge([
        'slug'         => '',
        'title'        => '',
        'summary'      => '',
        'category'     => 'pendidikan',
        'organization' => '',
        'location'     => '',
        'raised'       => 0,
        'target'       => 0,
        'donors'       => 0,
        'days_left'    => 0,
        'urgent'       => false,
        'verified'     => false,
        'story'        => [],
        'image'        => null,
    ], $c, [
        'raised'    => (int) ($c['raised'] ?? 0),
        'target'    => (int) ($c['target'] ?? 0),
        'donors'    => (int) ($c['donors'] ?? 0),
        'days_left' => (int) ($c['days_left'] ?? 0),
        'urgent'    => (bool) ($c['urgent'] ?? false),
        'verified'  => (bool) ($c['verified'] ?? false),
        'story'     => is_array($c['story'] ?? null) ? $c['story'] : [],
        'category'  => array_key_exists($c['category'] ?? '', $categories) ? $c['category'] : 'pendidikan',
    ]);
}

/** Semua kampanye yang sudah dinormalisasi. */
function cciCampaigns(): array
{
    return array_map('cciCampaign', cciData('campaigns'));
}

/** Normalisasi satu program → object agar view memakai ->field. */
function cciProgram(array $p): object
{
    return (object) array_merge([
        'name'        => '',
        'slug'        => '',
        'summary'     => '',
        'description' => '',
        'goal'        => '',
        'target'      => '',
        'status'      => '',
        'category'    => '',
        'image'       => null,
    ], $p);
}

/** Normalisasi satu kegiatan → object. */
function cciActivity(array $a): object
{
    return (object) array_merge([
        'title'   => '',
        'slug'    => '',
        'date'    => null,
        'summary' => '',
        'content' => '',
        'cover'   => null,
    ], $a);
}

/** Normalisasi satu foto galeri → object. */
function cciGallery(array $g): object
{
    return (object) array_merge([
        'image'   => null,
        'caption' => '',
    ], $g);
}

/** Semua program, kegiatan, dan galeri dalam bentuk object. */
function cciPrograms(): array
{
    return array_map('cciProgram', cciData('programs'));
}

function cciActivities(): array
{
    return array_map('cciActivity', cciData('activities'));
}

function cciGalleries(): array
{
    return array_map('cciGallery', cciData('galleries'));
}

Route::get('/', fn () => view('home', [
    'programs'   => cciPrograms(),
    'activities' => cciActivities(),
    'galleries'  => cciGalleries(),
    'campaigns'  => cciCampaigns(),
]))->name('home');

Route::get('/tentang', fn () => view('tentang'))->name('tentang');

Route::get('/program', fn () => view('program.index', [
    'programs' => cciPrograms(),
]))->name('program');

Route::get('/program/{slug}', function (string $slug) {
    $program = collect(cciPrograms())->firstWhere('slug', $slug);

    abort_unless($program, 404);

    return view('program.show', ['program' => $program]);
})->name('program.show');

Route::get('/kegiatan', fn () => view('kegiatan.index', [
    'activities' => cciActivities(),
]))->name('kegiatan');

Route::get('/kegiatan/{slug}', function (string $slug) {
    $activity = collect(cciActivities())->firstWhere('slug', $slug);

    abort_unless($activity, 404);

    return view('kegiatan.show', ['activity' => $activity]);
})->name('kegiatan.show');

Route::get('/galeri', fn () => view('galeri', [
    'galleries' => cciGalleries(),
]))->name('galeri');

Route::get('/kontak', fn () => view('kontak', [
    'faqs' => cciData('faqs'),
]))->name('kontak');

/*
 * Donasi — jelajah kampanye.
 * Catatan: '/donasi/form' WAJIB didaftarkan sebelum '/donasi/{slug}',
 * agar tidak tertangkap sebagai slug kampanye.
 */
Route::get('/donasi', fn () => view('donasi.index', [
    'campaigns'  => cciCampaigns(),
    'categories' => cciCampaignCategories(),
]))->name('donasi');

Route::get('/donasi/form', fn () => view('donasi.form', [
    'campaigns' => cciCampaigns(),
]))->name('donasi.form');

Route::post('/donasi', fn () => back()->with('success', 'Terima kasih! Donasi Anda sedang diproses.'))->name('donasi.store');

Route::get('/donasi/{slug}', function (string $slug) {
    $campaigns = cciCampaigns();
    $campaign  = collect($campaigns)->firstWhere('slug', $slug);

    abort_unless($campaign, 404);

    $others = collect($campaigns)
        ->where('slug', '!=', $slug)
        ->sortByDesc(fn ($c) => $c['urgent'])
        ->take(3)
        ->values()
        ->all();

    return view('donasi.show', [
        'campaign'   => $campaign,
        'others'     => $others,
        'categories' => cciCampaignCategories(),
    ]);
})->name('donasi.show');