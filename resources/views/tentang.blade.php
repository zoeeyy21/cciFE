@extends('layouts.app')

@section('content')

  {{-- Header / Hero Tentang --}}
  <section
    class="relative min-h-[75vh] lg:min-h-[85vh] flex items-center justify-center pt-24 pb-16 sm:pt-32 sm:pb-24 overflow-hidden bg-gradient-to-b from-paper-warm via-paper-warm/90 to-paper text-center">
    {{-- Background Accent Glows --}}
    <div
      class="absolute -top-12 left-1/2 -translate-x-1/2 w-[400px] sm:w-[850px] h-[350px] sm:h-[600px] bg-gradient-to-tr from-primary-300/30 via-sun-300/25 to-forest-300/25 blur-3xl rounded-full pointer-events-none -z-10">
    </div>

    <style>
      .logo-tentang {
        height: 65px; /* Tinggi logo di HP / Mobile */
        width: auto;
      }
      @media (min-width: 640px) {
        .logo-tentang {
          height: 100px; /* Tinggi logo di Tablet */
        }
      }
      @media (min-width: 1024px) {
        .logo-tentang {
          height: 135px; /* Tinggi logo di Laptop / Desktop */
        }
      }
    </style>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 flex flex-col items-center">
      <div class="flex items-center justify-center gap-4 sm:gap-6 md:gap-7">
        <img 
          src="{{ asset('images/logo-pelita.png') }}" 
          alt="Logo {{ $site['name'] }}" 
          class="logo-tentang shrink-0 drop-shadow-sm object-contain"
        />
        <h1
          class="font-serif text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-ink leading-[1.18] tracking-tight text-left">
          Yayasan Pelita Bahagia <br />
          <span class="italic text-accent-primary underline decoration-sun-400 decoration-wavy decoration-2">Anak
            Nusantara.</span>
        </h1>
      </div>
      <p class="mt-5 sm:mt-6 text-sm sm:text-base md:text-lg text-ink-muted leading-relaxed max-w-2xl mx-auto text-center">
        {{ $site['story']['lead'] ?? ($site['name'] . ' lahir dari sebuah keyakinan sederhana: bahwa setiap anak, tanpa memandang latar belakangnya, berhak bermimpi dan meraih cita-cita yang gemilang.') }}
      </p>

      {{-- Quick CTAs --}}
      <div class="mt-8 sm:mt-10 flex items-center justify-center gap-3 sm:gap-4 flex-wrap">
        <a href="#perjalanan-awal" class="btn-pill btn-primary text-xs sm:text-sm font-bold shadow-warm">
          Pelajari Kisah Kami &darr;
        </a>
        <a href="{{ url('/program') }}" class="btn-pill btn-outline text-xs sm:text-sm font-bold">
          Lihat Program Aksi &rarr;
        </a>
      </div>

      {{-- Trust markers --}}
      <div class="flex items-center justify-center gap-6 text-xs text-ink-muted pt-8 sm:pt-10 flex-wrap">
        <span class="flex items-center gap-1.5 font-medium">
          <svg class="w-4 h-4 text-forest-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
              clip-rule="evenodd" />
          </svg>
          Pendidikan Anak
        </span>
        <span class="flex items-center gap-1.5 font-medium">
          <svg class="w-4 h-4 text-forest-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
              clip-rule="evenodd" />
          </svg>
          Kepedulian Sosial
        </span>
        <span class="flex items-center gap-1.5 font-medium">
          <svg class="w-4 h-4 text-forest-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
              clip-rule="evenodd" />
          </svg>
          100% Transparan
        </span>
      </div>
    </div>
  </section>

  {{-- Manifesto / Cerita Pendiri --}}
  <section id="perjalanan-awal" class="py-16 sm:py-20 bg-surface border-y border-line/60 scroll-mt-20 reveal-on-scroll">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

      {{-- Perjalanan Awal --}}
      <div class="max-w-4xl mx-auto text-center space-y-6">
        <span class="inline-block text-xs font-bold text-accent-primary uppercase tracking-widest">Perjalanan Awal</span>
        <h2 class="font-serif text-3xl sm:text-4xl font-bold text-ink leading-tight">
          {{ $site['story']['heading'] ?: 'Kisah yayasan belum diisi' }}
        </h2>
        <p class="text-ink-muted text-sm sm:text-base leading-relaxed max-w-3xl mx-auto">
          {{ $site['story']['paragraph_1'] ?: 'Ceritakan latar belakang berdirinya yayasan pada file resources/data/site.php (bagian story).' }}
        </p>
        @if($site['story']['paragraph_2'])
          <p class="text-ink-muted text-sm sm:text-base leading-relaxed max-w-3xl mx-auto">
            {{ $site['story']['paragraph_2'] }}
          </p>
        @endif
        <div class="pt-4 flex flex-wrap items-center justify-center gap-6 sm:gap-10">
          <div>
            <span
              class="block font-serif text-3xl sm:text-4xl font-bold text-accent-primary">{{ number_format($site['stats']['children'] ?: 1250, 0, ',', '.') }}+</span>
            <span class="text-xs sm:text-sm text-ink-muted">Anak Terbantu</span>
          </div>
          <div class="w-px h-10 bg-line"></div>
          <div>
            <span
              class="block font-serif text-3xl sm:text-4xl font-bold text-accent-forest">{{ $site['stats']['programs_completed'] ?: '28+' }}</span>
            <span class="text-xs sm:text-sm text-ink-muted">Program Terlaksana</span>
          </div>
          <div class="w-px h-10 bg-line"></div>
          <div>
            <span
              class="block font-serif text-3xl sm:text-4xl font-bold text-sun-600">{{ $site['stats']['packages_distributed'] ?: '3.500+' }}</span>
            <span class="text-xs sm:text-sm text-ink-muted">Paket Bantuan Disalurkan</span>
          </div>
        </div>
      </div>

      {{-- Visi & Misi Terpisah di Bawah Perjalanan Awal --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 mt-12 sm:mt-16 items-stretch">
        {{-- Card 1: Visi Utama --}}
        <div
          class="bento-card p-7 sm:p-8 bg-gradient-to-br from-forest-900 to-forest-950 text-white relative overflow-hidden flex flex-col justify-between shadow-warm-lg">
          <div class="absolute -top-10 -right-10 w-48 h-48 rounded-full bg-forest-700/40 blur-2xl pointer-events-none">
          </div>
          <div class="relative z-10 space-y-4">
            <h3 class="font-serif font-bold text-2xl text-sun-300">Visi Utama</h3>
            <p class="text-sm sm:text-base text-forest-100/90 leading-relaxed">
              Menjadi episentrum kebaikan dan perlindungan anak nomor satu di Indonesia yang mewujudkan generasi penerus
              berdaya saing, berakhlak mulia, dan sehat paripurna.
            </p>
          </div>
        </div>

        {{-- Card 2: Misi Gerakan --}}
        <div
          class="bento-card p-7 sm:p-8 bg-gradient-to-br from-forest-900 to-forest-950 text-white relative overflow-hidden flex flex-col justify-between shadow-warm-lg">
          <div class="absolute -bottom-10 -right-10 w-48 h-48 rounded-full bg-forest-700/40 blur-2xl pointer-events-none">
          </div>
          <div class="relative z-10 space-y-4">
            <h3 class="font-serif font-bold text-2xl text-sun-300">Misi Utama</h3>
            <ul class="space-y-3 text-xs sm:text-sm text-forest-100/90">
              <li class="flex items-start gap-2.5">
                <span class="text-sun-400 font-bold shrink-0 mt-0.5">&check;</span>
                <span class="leading-relaxed">Menyediakan akses beasiswa dan fasilitas pendidikan merata hingga pelosok
                  desa.</span>
              </li>
              <li class="flex items-start gap-2.5">
                <span class="text-sun-400 font-bold shrink-0 mt-0.5">&check;</span>
                <span class="leading-relaxed">Mencegah stunting dan malnutrisi lewat intervensi makanan bergizi dan air
                  bersih.</span>
              </li>
              <li class="flex items-start gap-2.5">
                <span class="text-sun-400 font-bold shrink-0 mt-0.5">&check;</span>
                <span class="leading-relaxed">Membangun ekosistem keluarga mandiri melalui edukasi vokasi orang tua
                  asuh.</span>
              </li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </section>

  {{-- Bento Nilai-Nilai Utama --}}
  <section class="py-16 sm:py-24 bg-paper reveal-on-scroll">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16">
        <h2 class="font-serif text-3xl sm:text-4xl font-bold text-ink mt-3">Prinsip yang Menggerakkan Kami</h2>
        <p class="text-sm sm:text-base text-ink-muted mt-3 italic leading-relaxed">
          Setiap langkah berangkat dari kepedulian, dijalankan dengan integritas, dan diarahkan untuk menciptakan
          perubahan yang berarti.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Nilai 1 --}}
        <div class="bento-card p-6 flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-5">
              <span
                class="text-xs font-mono font-bold text-accent-primary bg-primary-100/70 px-2.5 py-1 rounded-xl">01</span>
              <div
                class="w-10 h-10 rounded-2xl bg-primary-100 text-accent-primary flex items-center justify-center font-bold text-lg">
                ♥
              </div>
            </div>
            <h3 class="font-serif font-bold text-lg text-ink">Kasih &amp; Empati</h3>
            <p class="text-xs sm:text-sm text-ink-muted mt-2.5 leading-relaxed">
              Kami percaya setiap anak berhak merasa aman, dihargai, dan didengar. Karena itu, setiap langkah kami berawal
              dari kepedulian terhadap kebutuhan dan kesejahteraan mereka.
            </p>
          </div>
        </div>

        {{-- Nilai 2 --}}
        <div class="bento-card p-6 flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-5">
              <span class="text-xs font-mono font-bold text-forest-700 bg-forest-100/80 px-2.5 py-1 rounded-xl">02</span>
              <div
                class="w-10 h-10 rounded-2xl bg-tint-forest-2 text-accent-forest flex items-center justify-center font-bold text-lg">
                ⚖
              </div>
            </div>
            <h3 class="font-serif font-bold text-lg text-ink">Transparansi &amp; Integritas</h3>
            <p class="text-xs sm:text-sm text-ink-muted mt-2.5 leading-relaxed">
              Setiap amanah adalah tanggung jawab. Kami berkomitmen mengelola setiap donasi secara transparan dan
              melaporkan penggunaannya dengan jujur serta dapat dipertanggungjawabkan.
            </p>
          </div>
        </div>

        {{-- Nilai 3 --}}
        <div class="bento-card p-6 flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-5">
              <span class="text-xs font-mono font-bold text-accent-sun bg-sun-100/80 px-2.5 py-1 rounded-xl">03</span>
              <div
                class="w-10 h-10 rounded-2xl bg-sun-100 text-accent-sun flex items-center justify-center font-bold text-lg">
                ⚡
              </div>
            </div>
            <h3 class="font-serif font-bold text-lg text-ink">Kemandirian &amp; Keberlanjutan</h3>
            <p class="text-xs sm:text-sm text-ink-muted mt-2.5 leading-relaxed">
              Kami tidak hanya hadir untuk membantu hari ini, tetapi juga mendampingi keluarga membangun kemampuan agar
              dapat tumbuh, berdaya, dan mandiri di masa depan.
            </p>
          </div>
        </div>

        {{-- Nilai 4 --}}
        <div class="bento-card p-6 flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-5">
              <span
                class="text-xs font-mono font-bold text-ink-muted bg-paper-warm px-2.5 py-1 rounded-xl border border-line">04</span>
              <div class="w-10 h-10 rounded-2xl bg-block text-ink flex items-center justify-center font-bold text-lg">
                🤝
              </div>
            </div>
            <h3 class="font-serif font-bold text-lg text-ink">Kolaborasi &amp; Kebersamaan</h3>
            <p class="text-xs sm:text-sm text-ink-muted mt-2.5 leading-relaxed">
              Perubahan yang berarti tumbuh dari kerja bersama. Kami merangkul masyarakat lokal, relawan, tenaga
              profesional, dan mitra untuk memperluas manfaat bagi lebih banyak anak dan keluarga.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Struktur Organisasi Yayasan --}}
  @php
    $structImg = trim($site['structure_image'] ?? '');
    $hasStructImg = !empty($structImg);
    $structImgUrl = '';
    if ($hasStructImg) {
      if (str_starts_with($structImg, 'http://') || str_starts_with($structImg, 'https://')) {
        $structImgUrl = $structImg;
      } elseif (file_exists(public_path($structImg))) {
        $structImgUrl = asset($structImg);
      } else {
        $structImgUrl = asset('storage/' . $structImg);
      }
    }
  @endphp
  <section class="py-16 sm:py-24 bg-paper-warm border-t border-line/60 reveal-on-scroll" id="struktur-organisasi">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-14">
        <h2 class="font-serif text-3xl sm:text-4xl font-bold text-ink mt-3">
          {{ $site['structure_title'] ?? 'Struktur Organisasi' }}
        </h2>
        <p class="text-sm sm:text-base text-ink-muted mt-3 leading-relaxed">
          {{ $site['structure_subtitle'] ?? 'Susunan kepengurusan dan tata kelola Yayasan Pelita Bahagia Anak Nusantara yang berdedikasi melayani dan menjalankan amanah.' }}
        </p>
      </div>

      @if($hasStructImg)
        <div class="bento-card p-4 sm:p-8 bg-surface shadow-warm-lg overflow-hidden">
          <div class="relative group flex flex-col items-center justify-center">
            <img src="{{ $structImgUrl }}" alt="{{ $site['structure_title'] ?? 'Bagan Struktur Organisasi' }}"
              class="w-full max-h-[800px] object-contain rounded-2xl mx-auto" loading="lazy" />
          </div>

          <div class="mt-5 pt-4 border-t border-line-soft flex items-center justify-between flex-wrap gap-3">
            <p class="text-xs text-ink-muted font-serif italic">
              {{ $site['structure_caption'] ?? 'Bagan Struktur Kepengurusan & Tata Kelola' }}
            </p>
          </div>
        </div>
      @else
        <div
          class="bento-card p-8 sm:p-12 text-center border-2 border-dashed border-line bg-surface/70 rounded-3xl max-w-4xl mx-auto">
          <div
            class="w-14 h-14 rounded-2xl bg-tint-forest-2 text-accent-forest flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
          </div>
          <h3 class="font-serif font-bold text-xl text-ink">Bagan Struktur Organisasi</h3>
          <p class="text-xs sm:text-sm text-ink-muted mt-2 max-w-md mx-auto leading-relaxed">
            Bagan struktur organisasi dan susunan pengurus yayasan akan segera ditampilkan di sini.
          </p>
          <div
            class="mt-6 inline-flex flex-col sm:flex-row items-center gap-2 p-3 px-4 rounded-2xl bg-paper-warm border border-line text-[11px] text-ink-muted max-w-2xl text-left">
            <span class="font-bold text-ink shrink-0">📁 Cara Memasukkan Gambar:</span>
            <span>Simpan gambar di <code
                class="px-1.5 py-0.5 rounded bg-surface border border-line font-mono text-accent-primary">storage/app/public/structure/</code>
              lalu isi nama file di <code
                class="px-1.5 py-0.5 rounded bg-surface border border-line font-mono text-accent-primary">resources/data/site.php</code>
              pada <code class="text-ink font-semibold">'structure_image'</code>.</span>
          </div>
        </div>
      @endif
    </div>
  </section>

@endsection