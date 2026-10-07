@extends('layouts.app')

@section('content')

{{-- Header --}}
<section class="pt-28 pb-16 bg-gradient-to-b from-paper-warm to-paper text-center">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <span class="badge-pill bg-tint-primary text-accent-primary border border-tint-primary-line">Kisah & Visi Kami</span>
    <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold text-ink mt-4 tracking-tight">
      Mendedikasikan Hati untuk <br/>
      <span class="italic text-accent-primary">Senyum Anak Indonesia</span>
    </h1>
    <p class="mt-5 text-base sm:text-lg text-ink-muted leading-relaxed max-w-2xl mx-auto">
      {{ $site['name'] }} lahir dari sebuah keyakinan sederhana: bahwa setiap anak, tanpa memandang latar belakangnya, berhak bermimpi dan meraih cita-cita.
    </p>
  </div>
</section>

{{-- Manifesto / Cerita Pendiri --}}
<section class="py-16 bg-surface border-y border-line/60">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
      
      <div class="lg:col-span-6 space-y-6">
        <span class="text-xs font-bold text-accent-primary uppercase tracking-widest">Perjalanan Awal</span>
        <h2 class="font-serif text-3xl sm:text-4xl font-bold text-ink leading-tight">
          {{ $site['story']['heading'] ?: 'Kisah yayasan belum diisi' }}
        </h2>
        <p class="text-ink-muted text-sm sm:text-base leading-relaxed">
          {{ $site['story']['paragraph_1'] ?: 'Ceritakan latar belakang berdirinya yayasan pada file resources/data/site.php (bagian story).' }}
        </p>
        @if($site['story']['paragraph_2'])
          <p class="text-ink-muted text-sm sm:text-base leading-relaxed">
            {{ $site['story']['paragraph_2'] }}
          </p>
        @endif
        <div class="pt-2 flex items-center gap-6">
          <div>
            <span class="block font-serif text-3xl font-bold text-accent-primary">{{ $site['stats']['children'] ?: '—' }}</span>
            <span class="text-xs text-ink-muted">Anak Terbantu</span>
          </div>
          <div class="w-px h-10 bg-line"></div>
          <div>
            <span class="block font-serif text-3xl font-bold text-accent-forest">{{ $site['stats']['villages'] ?: '—' }}</span>
            <span class="text-xs text-ink-muted">Desa Binaan</span>
          </div>
          <div class="w-px h-10 bg-line"></div>
          <div>
            <span class="block font-serif text-3xl font-bold text-sun-600">100%</span>
            <span class="text-xs text-ink-muted">Transparansi Dana</span>
          </div>
        </div>
      </div>

      <div class="lg:col-span-6">
        <div class="bento-card p-8 bg-gradient-to-br from-forest-900 to-forest-950 text-white relative overflow-hidden">
          <div class="absolute -top-10 -right-10 w-48 h-48 rounded-full bg-forest-700/40 blur-2xl"></div>
          <div class="relative z-10 space-y-6">
            <span class="badge-pill bg-forest-800 text-sun-300 border border-forest-700">Visi & Misi</span>
            
            <div>
              <h3 class="font-serif font-bold text-2xl text-sun-300">Visi Utama</h3>
              <p class="text-sm text-forest-100/90 mt-2 leading-relaxed">
                Menjadi episentrum kebaikan dan perlindungan anak nomor satu di Indonesia yang mewujudkan generasi penerus berdaya saing, berakhlak mulia, dan sehat paripurna.
              </p>
            </div>

            <div class="pt-4 border-t border-forest-800/80">
              <h3 class="font-serif font-bold text-xl text-sun-300">Misi Gerakan</h3>
              <ul class="mt-3 space-y-2.5 text-xs text-forest-100/90">
                <li class="flex items-start gap-2">
                  <span class="text-sun-400 font-bold">&check;</span>
                  <span>Menyediakan akses beasiswa dan fasilitas pendidikan merata hingga pelosok desa.</span>
                </li>
                <li class="flex items-start gap-2">
                  <span class="text-sun-400 font-bold">&check;</span>
                  <span>Mencegah stunting dan malnutrisi lewat intervensi makanan bergizi dan air bersih.</span>
                </li>
                <li class="flex items-start gap-2">
                  <span class="text-sun-400 font-bold">&check;</span>
                  <span>Membangun ekosistem keluarga mandiri melalui edukasi vokasi orang tua asuh.</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- Bento Nilai-Nilai Utama --}}
<section class="py-20 bg-paper">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="text-center max-w-2xl mx-auto mb-14">
      <span class="badge-pill bg-tint-sun text-accent-sun border border-tint-sun-line">Prinsip Yayasan</span>
      <h2 class="font-serif text-3xl sm:text-4xl font-bold text-ink mt-3">4 Nilai Yang Menuntun Kami</h2>
      <p class="text-sm text-ink-muted mt-2">Prinsip fundamental dalam setiap tetes keringat dan rupiah yang kami kelola.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      {{-- Nilai 1 --}}
 <div class="bento-card p-6">
        <div class="w-12 h-12 rounded-2xl bg-primary-100 text-accent-primary flex items-center justify-center font-bold text-xl mb-5">
          ♥
        </div>
        <h3 class="font-serif font-bold text-lg text-ink">Kasih & Empati</h3>
        <p class="text-xs text-ink-muted mt-2 leading-relaxed">
          Menempatkan kebutuhan emosional dan martabat anak sebagai prioritas tertinggi dalam setiap program perlindungan.
        </p>
      </div>

      {{-- Nilai 2 --}}
 <div class="bento-card p-6">
        <div class="w-12 h-12 rounded-2xl bg-tint-forest-2 text-accent-forest flex items-center justify-center font-bold text-xl mb-5">
          ⚖
        </div>
        <h3 class="font-serif font-bold text-lg text-ink">Akuntabilitas Penuh</h3>
        <p class="text-xs text-ink-muted mt-2 leading-relaxed">
          Setiap donasi dilaporkan secara terbuka dengan audit keuangan berkala dan dokumentasi visual langsung dari lapangan.
        </p>
      </div>

      {{-- Nilai 3 --}}
 <div class="bento-card p-6">
        <div class="w-12 h-12 rounded-2xl bg-sun-100 text-accent-sun flex items-center justify-center font-bold text-xl mb-5">
          ⚡
        </div>
        <h3 class="font-serif font-bold text-lg text-ink">Dampak Berkelanjutan</h3>
        <p class="text-xs text-ink-muted mt-2 leading-relaxed">
          Bukan bantuan ketergantungan, melainkan pendampingan kapasitas agar keluarga mampu mandiri dalam jangka panjang.
        </p>
      </div>

      {{-- Nilai 4 --}}
 <div class="bento-card p-6">
        <div class="w-12 h-12 rounded-2xl bg-block text-ink flex items-center justify-center font-bold text-xl mb-5">
          🤝
        </div>
        <h3 class="font-serif font-bold text-lg text-ink">Kolaborasi Bersama</h3>
        <p class="text-xs text-ink-muted mt-2 leading-relaxed">
          Menggandeng masyarakat lokal, relawan mahasiswa, tenaga kesehatan, dan mitra korporat demi melipatgandakan manfaat.
        </p>
      </div>
    </div>
  </div>
</section>

@endsection
