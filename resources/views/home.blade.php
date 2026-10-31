@extends('layouts.app')

@section('content')

{{-- 1. HERO SECTION: Dramatic Split-Screen Bento Hero --}}
<section class="relative pt-20 pb-12 sm:pt-28 sm:pb-20 overflow-hidden bg-gradient-to-b from-paper-warm via-paper-warm/90 to-paper-warm">
  {{-- Background Accent Glows --}}
  <div class="absolute -top-12 left-1/2 -translate-x-1/2 w-[400px] sm:w-[850px] h-[350px] sm:h-[600px] bg-gradient-to-tr from-primary-300/30 via-sun-300/25 to-forest-300/25 blur-3xl rounded-full pointer-events-none -z-10"></div>

  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    
    {{-- Main Grid: Hero Split Layout --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-stretch">
      
      {{-- Hero Left Block: Main Headline & Core Narrative (7 Cols) --}}
      <div class="lg:col-span-7 flex flex-col justify-between space-y-6 sm:space-y-8">
        <div>
          <h1 class="font-serif text-3xl sm:text-5xl md:text-6xl font-bold text-ink leading-[1.12] tracking-tight">
            Yayasan Pelita Bahagia <br/>
            <span class="italic text-accent-primary underline decoration-sun-400 decoration-wavy decoration-2">Anak Nusantara.</span>
          </h1>
          <p class="mt-4 sm:mt-6 text-sm sm:text-lg text-ink-muted leading-relaxed max-w-xl">
            Membangun generasi peduli, tangguh, dan berdaya melalui fokus utama pada <strong class="text-ink font-semibold">pendidikan anak</strong> serta <strong class="text-ink font-semibold">kepedulian sosial</strong> seperti pendampingan anak yatim &amp; dhuafa dan berbagai aksi kepedulian masyarakat.
          </p>
        </div>

        {{-- Action Buttons & Trust Markers --}}
        <div class="space-y-4 pt-2">
          <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <a href="{{ url('/donasi') }}" class="btn-pill btn-primary text-sm shadow-warm-lg flex items-center justify-center gap-2">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
              </svg>
              <span>Salurkan Donasi Sekarang</span>
            </a>
            <a href="{{ url('/program') }}" class="btn-pill btn-outline text-sm flex items-center justify-center gap-1.5">
              <span>Lihat Program </span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>
            </a>
          </div>

          <div class="flex items-center gap-4 text-xs text-ink-muted pt-2 flex-wrap">
            <span class="flex items-center gap-1.5">
              <svg class="w-4 h-4 text-forest-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
              100% Transparan
            </span>
            <span class="flex items-center gap-1.5">
              <svg class="w-4 h-4 text-forest-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
              Terdaftar Kemenkumham
            </span>
          </div>
        </div>
      </div>

      {{-- Hero Right Block: Visual Focus Hero Bento Card (5 Cols) --}}
      <div class="lg:col-span-5 flex flex-col gap-4">

        {{-- Card 1: Dark Forest Mission Focus Container --}}
        <div class="bento-card p-6 sm:p-8 bg-gradient-to-br from-forest-900 via-forest-950 to-forest-900 text-white flex-1 flex flex-col justify-between relative overflow-hidden">
          <div class="absolute -right-10 -top-10 w-48 h-48 rounded-full bg-forest-700/40 blur-2xl pointer-events-none"></div>
          <div class="absolute -left-10 bottom-0 w-40 h-40 rounded-full bg-sun-400/10 blur-2xl pointer-events-none"></div>

          <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
              <span class="badge-pill bg-forest-800/90 text-sun-300 border border-forest-700 text-[10px] sm:text-xs">
                {{ $site['mission']['badge'] ?: 'Misi Utama 2026' }}
              </span>
              <span class="text-xs text-forest-200/70 font-mono">
                {{ $site['stats']['founded_year'] ? 'Est. ' . $site['stats']['founded_year'] : 'Yayasan Resmi' }}
              </span>
            </div>

            <h2 class="font-serif text-lg sm:text-2xl font-bold leading-snug text-white">
              "{{ $site['mission']['quote'] ?: 'Ketika satu anak terdidik, satu generasi terselamatkan.' }}"
            </h2>

            @if($site['mission']['body'])
              <p class="text-xs text-forest-200/80 mt-3 leading-relaxed">
                {{ $site['mission']['body'] }}
              </p>
            @endif
          </div>

          <div class="relative z-10 pt-6 border-t border-forest-800/80 mt-6">
            <div class="grid grid-cols-3 gap-2 text-center">
              <div class="p-2.5 rounded-2xl bg-forest-900/60 border border-forest-800/60">
                <span class="block font-serif font-bold text-lg sm:text-xl text-sun-300 leading-none">
                  {{ number_format($site['stats']['children'] ?: 1250, 0, ',', '.') }}+
                </span>
                <span class="block text-[10px] text-forest-200 uppercase tracking-wider mt-1 font-medium">Anak Terbantu</span>
              </div>

              <div class="p-2.5 rounded-2xl bg-forest-900/60 border border-forest-800/60">
                <span class="block font-serif font-bold text-lg sm:text-xl text-sun-300 leading-none">
                  {{ $site['stats']['programs_completed'] ?: '28+' }}
                </span>
                <span class="block text-[10px] text-forest-200 uppercase tracking-wider mt-1 font-medium">Program Terlaksana</span>
              </div>

              <div class="p-2.5 rounded-2xl bg-forest-900/60 border border-forest-800/60">
                <span class="block font-serif font-bold text-lg sm:text-xl text-sun-300 leading-none">
                  {{ $site['stats']['packages_distributed'] ?: '3.500+' }}
                </span>
                <span class="block text-[10px] text-forest-200 uppercase tracking-wider mt-1 font-medium">Paket Bantuan</span>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
</section>

{{-- 2. TIGA PILAR UTAMA AKSI (Background: Surface / White) --}}
<section class="py-16 sm:py-24 bg-surface border-y border-line/60">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="flex items-center justify-center text-center mb-10 sm:mb-14">
      <div>
        <h2 class="font-serif text-2xl sm:text-4xl font-bold text-ink tracking-tight">3 Pilar Utama Perubahan</h2>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      {{-- Pilar 1 --}}
      <div class="p-6 sm:p-8 rounded-3xl bg-paper-warm/80 border border-line/70 hover:shadow-warm transition-all duration-300">
        <div class="w-12 h-12 rounded-2xl bg-primary-100 text-accent-primary flex items-center justify-center mb-6">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
          </svg>
        </div>
        <h3 class="font-serif font-bold text-lg sm:text-xl text-ink">1. Pendidikan Berkualitas</h3>
        <p class="mt-2.5 text-xs sm:text-sm text-ink-muted leading-relaxed">
          Beasiswa sekolah, pembagian seragam & alat tulis, renovasi ruang kelas pedalaman, serta pendampingan belajar gratis.
        </p>
      </div>

      {{-- Pilar 2 --}}
      <div class="p-6 sm:p-8 rounded-3xl bg-paper-warm/80 border border-line/70 hover:shadow-warm transition-all duration-300">
        <div class="w-12 h-12 rounded-2xl bg-tint-forest-2 text-accent-forest flex items-center justify-center mb-6">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
          </svg>
        </div>
        <h3 class="font-serif font-bold text-lg sm:text-xl text-ink">2. Nutrisi & Kesehatan</h3>
        <p class="mt-2.5 text-xs sm:text-sm text-ink-muted leading-relaxed">
          Penyaluran paket makanan bergizi tinggi pencegah stunting, pemeriksaan medis gratis, dan edukasi sanitasi bersih.
        </p>
      </div>

      {{-- Pilar 3 --}}
      <div class="p-6 sm:p-8 rounded-3xl bg-paper-warm/80 border border-line/70 hover:shadow-warm transition-all duration-300">
        <div class="w-12 h-12 rounded-2xl bg-sun-100 text-accent-sun flex items-center justify-center mb-6">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </div>
        <h3 class="font-serif font-bold text-lg sm:text-xl text-ink">3. Pemberdayaan Keluarga</h3>
        <p class="mt-2.5 text-xs sm:text-sm text-ink-muted leading-relaxed">
          Pelatihan keterampilan ekonomi bagi ibu tunggal dan orang tua asuh agar sanggup menopang kemandirian buah hatinya.
        </p>
      </div>
    </div>
  </div>
</section>

{{-- 3. PROGRAM YANG SEDANG BERJALAN (Background: Paper Warm) --}}
<section id="home-programs-section" class="py-16 sm:py-24 bg-paper-warm/70 border-b border-line/60">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="flex items-center justify-between mb-10 sm:mb-12 flex-wrap gap-4">
      <div>
        <h2 class="font-serif text-2xl sm:text-4xl font-bold text-ink tracking-tight">Program Yang Sedang Berjalan</h2>
      </div>
      <a href="{{ url('/program') }}" class="btn-pill btn-outline !py-2 sm:!py-2.5 !px-4 text-xs font-bold">
        Lihat Semua Program &rarr;
      </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="home-programs-grid">
      @forelse($programs ?? [] as $prog)
        <div class="home-program-card bento-card flex flex-col justify-between">
          <div>
            @if($prog->image)
              <div class="h-44 sm:h-48 overflow-hidden">
                <img src="{{ asset('storage/'.$prog->image) }}" alt="{{ $prog->name }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"/>
              </div>
            @else
              <div class="h-44 sm:h-48 bg-gradient-to-tr from-forest-800 to-forest-900 flex items-center justify-center p-4">
                <img src="{{ asset('images/logo-icon.png') }}" alt="Pelita Bahagia" class="w-12 h-12 object-contain drop-shadow" />
              </div>
            @endif
            <div class="p-5 sm:p-6">
              <span class="text-[10px] font-bold uppercase tracking-wider text-accent-primary bg-tint-primary px-2.5 py-1 rounded-full">{{ $prog->status ?? 'Aktif' }}</span>
              <h3 class="font-serif font-bold text-lg sm:text-xl text-ink mt-2.5">
                <a href="{{ url('/program/'.$prog->slug) }}" class="hover:text-accent-primary transition-colors">
                  {{ $prog->name }}
                </a>
              </h3>
              <p class="text-xs sm:text-sm text-ink-muted mt-2 line-clamp-2 leading-relaxed">
                {{ $prog->summary }}
              </p>
            </div>
          </div>
          @php
            $isAktif = strtolower($prog->status ?? 'aktif') === 'aktif';
          @endphp
          <div class="px-5 sm:px-6 pb-5 sm:pb-6 pt-2 border-t border-line-soft flex items-center justify-between">
            <a href="{{ url('/program/'.$prog->slug) }}" class="text-xs font-bold text-ink hover:text-accent-primary">
              Detail &rarr;
            </a>
            @if($isAktif)
              <a href="{{ url('/donasi/'.$prog->slug) }}" class="btn-pill btn-primary !py-1.5 !px-3.5 !text-xs">
                Dukung
              </a>
            @else
              <button type="button" disabled class="btn-pill !py-1.5 !px-3.5 !text-xs font-semibold bg-line text-ink-muted/50 border border-line cursor-not-allowed opacity-60" title="Program telah selesai / non-aktif">
                Dukung
              </button>
            @endif
          </div>
        </div>
      @empty
        <div class="col-span-full p-8 sm:p-12 text-center rounded-3xl bg-surface border-2 border-dashed border-line shadow-warm-sm">
          <div class="w-14 h-14 rounded-2xl bg-paper-warm border border-line flex items-center justify-center mx-auto text-ink-light">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
          </div>
          <p class="font-serif text-base sm:text-lg font-bold text-ink mt-4">Program akan segera hadir</p>
          <p class="text-xs sm:text-sm text-ink-muted mt-1.5 max-w-sm mx-auto leading-relaxed">
            Data program belum diisi. Isi file <code class="px-1.5 py-0.5 rounded bg-paper-warm border border-line text-[11px] font-mono text-accent-primary">resources/data/programs.php</code> untuk mulai menampilkan program.
          </p>
        </div>
      @endforelse
    </div>

    {{-- Navigasi Pagination Program --}}
    <div id="home-program-pagination" class="mt-10 sm:mt-12 flex items-center justify-center gap-2 flex-wrap"></div>
  </div>
</section>

{{-- 4. KABAR & CATATAN LAPANGAN (Background: Surface / White) --}}
<section id="home-activities-section" class="py-16 sm:py-24 bg-surface border-b border-line/60">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="flex items-center justify-between mb-10 sm:mb-12 flex-wrap gap-4">
      <div>
        <h2 class="font-serif text-2xl sm:text-4xl font-bold text-ink tracking-tight">Kegiatan</h2>
      </div>
      <a href="{{ url('/kegiatan') }}" class="btn-pill btn-outline !py-2 sm:!py-2.5 !px-4 text-xs font-bold">
        Semua Kegiatan &rarr;
      </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="home-activities-grid">
      @forelse($activities ?? [] as $act)
        <a href="{{ url('/kegiatan/'.$act->slug) }}" class="home-activity-card bento-card group flex flex-col justify-between">
          <div>
            @if($act->cover)
              <div class="h-44 sm:h-48 overflow-hidden">
                <img src="{{ asset('storage/'.$act->cover) }}" alt="{{ $act->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"/>
              </div>
            @else
              <div class="h-44 sm:h-48 bg-paper-warm flex items-center justify-center text-ink-light">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
              </div>
            @endif
            <div class="p-5 sm:p-6">
              <div class="mb-2">
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-tint-primary text-accent-primary border border-tint-primary-line">
                  {{ $act->program_name ?: 'Program Aksi' }}
                </span>
              </div>
              <h3 class="font-serif font-bold text-base sm:text-lg text-ink group-hover:text-accent-primary transition-colors line-clamp-2">
                {{ $act->title }}
              </h3>
              <div class="flex items-center gap-2 text-[11px] text-ink-muted mt-2 pt-2 border-t border-line-soft">
                <span>{{ \Carbon\Carbon::parse($act->date)->format('d M Y') }}</span>
                @if(!empty($act->location))
                  <span>•</span>
                  <span>{{ $act->location }}</span>
                @endif
              </div>
              <p class="text-xs text-ink-muted mt-2 line-clamp-2 leading-relaxed">
                {{ $act->summary }}
              </p>
            </div>
          </div>
          <div class="px-5 sm:px-6 pb-5 sm:pb-6 pt-2 text-xs font-bold text-accent-primary group-hover:underline">
            Baca Selengkapnya &rarr;
          </div>
        </a>
      @empty
        <div class="col-span-full p-8 sm:p-12 text-center rounded-3xl bg-paper-warm/80 border-2 border-dashed border-line">
          <div class="w-14 h-14 rounded-2xl bg-surface border border-line flex items-center justify-center mx-auto text-ink-light">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          </div>
          <p class="font-serif text-base sm:text-lg font-bold text-ink mt-4">Belum ada kegiatan</p>
          <p class="text-xs sm:text-sm text-ink-muted mt-1.5 max-w-sm mx-auto leading-relaxed">
            Data kegiatan belum diisi. Isi file <code class="px-1.5 py-0.5 rounded bg-surface border border-line text-[11px] font-mono text-accent-primary">resources/data/activities.php</code> untuk mulai menampilkan berita.
          </p>
        </div>
      @endforelse
    </div>

    {{-- Navigasi Pagination Kegiatan --}}
    <div id="home-activity-pagination" class="mt-10 sm:mt-12 flex items-center justify-center gap-2 flex-wrap"></div>
  </div>
</section>

{{-- 5. GRAND CLOSING CTA BANNER --}}
<section class="py-16 sm:py-24 bg-forest-950 text-white relative">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center relative z-10">
    <h2 class="font-serif text-2xl sm:text-4xl md:text-5xl font-bold leading-tight text-white tracking-tight">
      Jadilah Pelita di Tengah Kegelapan Mereka Hari Ini
    </h2>
    <p class="text-forest-200/80 text-xs sm:text-base mt-3 sm:mt-4 max-w-xl mx-auto leading-relaxed px-2">
      Sekecil apapun kontribusi Anda, itu adalah jembatan mimpi dan masa depan bagi ratusan anak di pelosok negeri.
    </p>
    <div class="mt-6 sm:mt-8 flex items-center justify-center gap-3 flex-col sm:flex-row w-full max-w-md mx-auto sm:max-w-none">
      <a href="{{ url('/donasi') }}" class="btn-pill btn-sun font-bold text-sm shadow-warm-lg w-full sm:w-auto">
        Salurkan Donasi Anda &rarr;
      </a>
      <a href="{{ url('/kontak') }}" class="btn-pill btn-outline-white text-sm w-full sm:w-auto">
        Hubungi Tim Kami
      </a>
    </div>
  </div>
</section>

{{-- Script Controller Pagination Beranda (3 item per halaman / 1 baris) --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
  function initHomePagination({ cardSelector, paginationId, sectionId, perPage = 3 }) {
    const cards = Array.from(document.querySelectorAll(cardSelector));
    const paginationContainer = document.getElementById(paginationId);
    const section = document.getElementById(sectionId);

    if (!cards.length || !paginationContainer) return;

    let currentPage = 1;
    const totalPages = Math.ceil(cards.length / perPage);

    function render(scrollUp = false) {
      const startIndex = (currentPage - 1) * perPage;
      const endIndex = startIndex + perPage;

      cards.forEach((card, index) => {
        if (index >= startIndex && index < endIndex) {
          card.classList.remove('hidden');
        } else {
          card.classList.add('hidden');
        }
      });

      renderButtons();

      if (scrollUp && section) {
        section.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    }

    function renderButtons() {
      paginationContainer.innerHTML = '';
      if (totalPages <= 1) return;

      // Tombol Previous
      const prevBtn = document.createElement('button');
      prevBtn.type = 'button';
      prevBtn.className = `btn-pill !py-2 !px-3.5 !text-xs font-bold transition-all flex items-center gap-1 ${
        currentPage === 1 
          ? 'opacity-40 cursor-not-allowed bg-paper-warm border border-line text-ink-muted' 
          : 'bg-surface border border-line text-ink hover:bg-paper-warm hover:text-accent-primary'
      }`;
      prevBtn.innerHTML = `&larr; <span class="hidden sm:inline">Sebelumnya</span>`;
      prevBtn.disabled = (currentPage === 1);
      prevBtn.addEventListener('click', function () {
        if (currentPage > 1) {
          currentPage--;
          render(true);
        }
      });
      paginationContainer.appendChild(prevBtn);

      // Nomor Halaman [1] [2] [3]...
      for (let i = 1; i <= totalPages; i++) {
        const pageBtn = document.createElement('button');
        pageBtn.type = 'button';
        const isActive = (i === currentPage);
        pageBtn.className = `w-9 h-9 rounded-full text-xs font-bold flex items-center justify-center transition-all ${
          isActive 
            ? 'bg-primary-500 text-white shadow-warm' 
            : 'bg-surface border border-line text-ink hover:bg-paper-warm hover:text-accent-primary'
        }`;
        pageBtn.textContent = i;
        pageBtn.addEventListener('click', function () {
          if (currentPage !== i) {
            currentPage = i;
            render(true);
          }
        });
        paginationContainer.appendChild(pageBtn);
      }

      // Tombol Next
      const nextBtn = document.createElement('button');
      nextBtn.type = 'button';
      nextBtn.className = `btn-pill !py-2 !px-3.5 !text-xs font-bold transition-all flex items-center gap-1 ${
        currentPage === totalPages 
          ? 'opacity-40 cursor-not-allowed bg-paper-warm border border-line text-ink-muted' 
          : 'bg-surface border border-line text-ink hover:bg-paper-warm hover:text-accent-primary'
      }`;
      nextBtn.innerHTML = `<span class="hidden sm:inline">Selanjutnya</span> &rarr;`;
      nextBtn.disabled = (currentPage === totalPages);
      nextBtn.addEventListener('click', function () {
        if (currentPage < totalPages) {
          currentPage++;
          render(true);
        }
      });
      paginationContainer.appendChild(nextBtn);
    }

    render(false);
  }

  // Aktifkan Pagination Program (4 item / 1 baris di desktop)
  initHomePagination({
    cardSelector: '.home-program-card',
    paginationId: 'home-program-pagination',
    sectionId: 'home-programs-section',
    perPage: 4
  });

  // Aktifkan Pagination Kegiatan (4 item / 1 baris di desktop)
  initHomePagination({
    cardSelector: '.home-activity-card',
    paginationId: 'home-activity-pagination',
    sectionId: 'home-activities-section',
    perPage: 4
  });
});
</script>

@endsection