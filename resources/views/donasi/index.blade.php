@extends('layouts.app')

@php
  $campaignList  = $campaigns ?? [];
  $categoryList  = $categories ?? [];
  $totalCampaign = count($campaignList);
  $totalRaised   = collect($campaignList)->sum('raised');
  $totalDonors   = collect($campaignList)->sum('donors');
  $totalTarget   = collect($campaignList)->sum('target');

  $formatRupiah = function (int $n) {
      if ($n >= 1000000000) return 'Rp ' . number_format($n / 1000000000, 1, ',', '.') . ' M';
      if ($n >= 1000000)    return 'Rp ' . number_format($n / 1000000, 0, ',', '.') . ' jt';
      return 'Rp ' . number_format($n, 0, ',', '.');
  };

  $heroCampaign = collect($campaignList)->sortByDesc(fn ($c) => ($c['urgent'] ? 1 : 0) * 1000000 + $c['raised'])->first();
@endphp

@section('content')

{{-- ═══════════════ HEADER & PENCARIAN ═══════════════ --}}
<section class="relative pt-20 sm:pt-28 pb-8 sm:pb-12 overflow-hidden bg-gradient-to-b from-paper-warm via-paper to-paper">
  <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[350px] sm:w-[700px] h-[280px] sm:h-[420px] bg-gradient-to-tr from-primary-200/40 via-sun-200/30 to-forest-200/30 blur-3xl rounded-full pointer-events-none -z-10"></div>

  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="text-center max-w-3xl mx-auto">
      <div class="inline-flex items-center gap-1.5 sm:gap-2 px-3.5 py-1.5 rounded-full bg-surface border border-line/80 shadow-warm-sm mb-4">
        <span class="w-2 h-2 rounded-full bg-primary-500 animate-pulse"></span>
        <span class="text-[10px] sm:text-xs font-bold text-ink uppercase tracking-widest">Jelajahi Galang Dana</span>
      </div>
      <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-ink leading-[1.15]">
        Pilih Kebaikan <br class="sm:hidden"/>
        <span class="italic text-accent-primary underline decoration-sun-300 decoration-wavy decoration-2">yang Ingin Kamu Tumbuhkan</span>
      </h1>
      <p class="mt-4 sm:mt-5 text-sm sm:text-lg text-ink-muted leading-relaxed max-w-2xl mx-auto px-2">
        {{ $totalCampaign }} penggalangan dana aktif untuk anak-anak Indonesia. Setiap rupiah dilaporkan dengan bukti, setiap kampanye diverifikasi tim kami.
      </p>
    </div>

    {{-- Search Bar --}}
    <div class="mt-7 sm:mt-9 max-w-2xl mx-auto">
      <div class="relative">
        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-ink-light pointer-events-none">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </div>
        <input type="search" id="campaign-search" autocomplete="off"
               placeholder="Cari kampanye, lokasi, atau nama anak…"
               class="input-premium !pl-12 !pr-12 !py-4 !rounded-full !border-line shadow-warm text-base" />
        <button type="button" id="search-clear"
                class="hidden absolute right-4 top-1/2 -translate-y-1/2 text-ink-light hover:text-ink transition-colors"
                aria-label="Bersihkan pencarian">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>

    {{-- Ringkasan Capaian --}}
    <div class="mt-7 sm:mt-9 grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
 <div class="bento-card p-4 sm:p-5 text-center sm:text-left">
        <span class="block font-serif text-xl sm:text-3xl font-bold text-accent-primary">{{ $totalCampaign }}</span>
        <span class="block text-[10px] sm:text-xs text-ink-muted mt-0.5">Kampanye Aktif</span>
      </div>
 <div class="bento-card p-4 sm:p-5 text-center sm:text-left">
        <span class="block font-serif text-xl sm:text-3xl font-bold text-accent-forest">{{ $formatRupiah($totalRaised) }}</span>
        <span class="block text-[10px] sm:text-xs text-ink-muted mt-0.5">Dana Terkumpul</span>
      </div>
 <div class="bento-card p-4 sm:p-5 text-center sm:text-left">
   <span class="block font-serif text-xl sm:text-3xl font-bold text-sun-600">{{ number_format($totalDonors, 0, ',', '.') }}</span>
   <span class="block text-[10px] sm:text-xs text-ink-muted mt-0.5">Donatur Berbagi</span>
 </div>
 <div class="bento-card p-4 sm:p-5 text-center sm:text-left">
        <span class="block font-serif text-xl sm:text-3xl font-bold text-ink">{{ $formatRupiah($totalTarget) }}</span>
        <span class="block text-[10px] sm:text-xs text-ink-muted mt-0.5">Total Target</span>
      </div>
    </div>
  </div>
</section>

{{-- ═══════════════ FILTER & URUTKAN ═══════════════ --}}
<section class="sticky top-16 sm:top-20 z-30 bg-paper/90 backdrop-blur-xl border-y border-line/70 py-3">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="flex flex-col lg:flex-row lg:items-center gap-3 lg:gap-4">

      {{-- Kategori --}}
      <div class="flex-1 min-w-0">
        <div class="flex gap-2 overflow-x-auto pb-1 -mb-1 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
          <button type="button" data-category="all"
                  class="category-chip shrink-0 px-3.5 py-2 rounded-full text-xs font-bold border transition-all min-h-[38px] bg-primary-500 border-primary-500 text-white shadow-warm-sm">
            Semua
            <span class="opacity-70 font-medium">({{ $totalCampaign }})</span>
          </button>
          @foreach($categoryList as $key => $label)
                        @php $count = collect($campaignList)->where('category', $key)->count(); @endphp
                        @if($count > 0)
                        <button type="button" data-category="{{ $key }}"
                                class="category-chip shrink-0 px-3.5 py-2 rounded-full text-xs font-bold border transition-all min-h-[38px] bg-surface border-line text-ink-muted hover:border-line-strong hover:text-ink">
                          {{ $label }}
                          <span class="opacity-60 font-medium">({{ $count }})</span>
                        </button>
                        @endif
                      @endforeach
          <button type="button" data-category="urgent"
                  class="category-chip shrink-0 px-3.5 py-2 rounded-full text-xs font-bold border transition-all min-h-[38px] bg-surface border-tint-primary-line text-accent-primary hover:bg-tint-primary flex items-center gap-1.5">
            <span class="w-1.5 h-1.5 rounded-full bg-primary-500 animate-pulse"></span>
            Mendesak
          </button>
        </div>
      </div>

      {{-- Urutkan --}}
      <div class="flex items-center gap-2 shrink-0">
        <label for="sort-select" class="text-[11px] font-bold uppercase tracking-wider text-ink-muted hidden sm:block">Urutkan</label>
        <select id="sort-select"
                class="px-3.5 py-2.5 rounded-full border border-line bg-surface text-xs font-semibold text-ink outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all min-h-[42px] cursor-pointer">
          <option value="urgent">Paling Mendesak</option>
          <option value="progress">Progres Terdekat</option>
          <option value="raised">Dana Terkumpul</option>
          <option value="donors">Donatur Terbanyak</option>
          <option value="days">Segera Berakhir</option>
        </select>
      </div>

    </div>
  </div>
</section>

{{-- ═══════════════ KAMPANYE UNGGULAN (HERO CARD) ═══════════════ --}}
@if($heroCampaign)
@php
  $heroPercent = min(100, round($heroCampaign['raised'] / max(1, $heroCampaign['target']) * 100, 1));
  $heroSisa    = max(0, $heroCampaign['target'] - $heroCampaign['raised']);
@endphp
<section class="pt-8 sm:pt-12 bg-paper" id="featured-section">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="flex items-center gap-2 mb-4">
      <span class="w-1.5 h-6 rounded-full bg-primary-500"></span>
      <h2 class="font-serif text-lg sm:text-2xl font-bold text-ink">Paling Butuh Bantuan Sekarang</h2>
    </div>

    <a href="{{ url('/donasi/'.$heroCampaign['slug']) }}"
 class="bento-card group grid grid-cols-1 lg:grid-cols-12 overflow-hidden">
      {{-- Visual --}}
      <div class="lg:col-span-5 relative min-h-[200px] sm:min-h-[260px] bg-gradient-to-br from-primary-500 via-primary-600 to-forest-900 overflow-hidden">
        <div class="absolute -right-10 -top-10 w-44 h-44 rounded-full bg-white/10"></div>
        <div class="absolute -left-8 bottom-4 w-32 h-32 rounded-full bg-sun-400/20"></div>
        <div class="relative h-full flex flex-col justify-between p-6 sm:p-8 text-white">
          <div class="flex flex-wrap items-center gap-2">
            @if($heroCampaign['urgent'])
            <span class="badge-pill bg-red-500 text-white border border-red-400 text-[10px] flex items-center gap-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Mendesak
            </span>
            @endif
            @if($heroCampaign['verified'])
            <span class="badge-pill bg-white/20 backdrop-blur-md text-white border border-white/30 text-[10px] flex items-center gap-1">
              <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812z" clip-rule="evenodd"/></svg>
              Terverifikasi
            </span>
            @endif
          </div>
          <div class="mt-auto">
            <span class="text-[11px] font-semibold uppercase tracking-widest text-white/70">Sisa {{ $heroCampaign['days_left'] }} hari lagi</span>
            <p class="font-serif text-2xl sm:text-3xl font-bold mt-1 leading-tight">Bantu Tutup Kekurangan {{ $formatRupiah($heroSisa) }}</p>
          </div>
        </div>
      </div>

      {{-- Konten --}}
      <div class="lg:col-span-7 p-6 sm:p-8 flex flex-col justify-between">
        <div>
          <div class="flex items-center gap-2 flex-wrap mb-3">
            <span class="badge-pill bg-tint-primary text-accent-primary border border-tint-primary-line text-[10px]">
              {{ $categoryList[$heroCampaign['category']] ?? 'Umum' }}
            </span>
            <span class="text-[11px] text-ink-muted flex items-center gap-1">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
              {{ $heroCampaign['location'] }}
            </span>
          </div>

          <h3 class="font-serif text-xl sm:text-3xl font-bold text-ink leading-snug group-hover:text-accent-primary transition-colors">
            {{ $heroCampaign['title'] }}
          </h3>
          <p class="text-xs sm:text-sm text-ink-muted mt-3 leading-relaxed line-clamp-3">
            {{ $heroCampaign['summary'] }}
          </p>
          <p class="text-[11px] text-ink-light mt-3">Dikelola oleh <span class="font-semibold text-ink-muted">{{ $heroCampaign['organization'] }}</span></p>
        </div>

        <div class="mt-6">
          {{-- Progress --}}
          <div class="w-full h-2.5 rounded-full bg-paper-warm overflow-hidden">
            <div class="h-full rounded-full bg-gradient-to-r from-primary-500 to-primary-600" style="width: {{ $heroPercent }}%"></div>
          </div>
          <div class="flex items-end justify-between mt-3 gap-3 flex-wrap">
            <div>
              <span class="block font-serif text-lg sm:text-2xl font-bold text-ink">{{ $formatRupiah($heroCampaign['raised']) }}</span>
              <span class="block text-[11px] text-ink-muted">terkumpul dari {{ $formatRupiah($heroCampaign['target']) }}</span>
            </div>
            <div class="text-right">
              <span class="block font-serif text-lg sm:text-2xl font-bold text-accent-primary">{{ $heroPercent }}%</span>
              <span class="block text-[11px] text-ink-muted">{{ number_format($heroCampaign['donors'], 0, ',', '.') }} donatur</span>
            </div>
          </div>

          <div class="mt-5 flex items-center gap-3">
            <span class="btn-pill btn-primary text-xs font-bold flex-1 sm:flex-none justify-center">
              Donasi Sekarang
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </span>
            <span class="text-[11px] text-ink-muted hidden sm:block">Bukti penyaluran dilaporkan berkala</span>
          </div>
        </div>
      </div>
    </a>
  </div>
</section>
@endif

{{-- ═══════════════ GRID KAMPANYE ═══════════════ --}}
<section class="py-8 sm:py-14 bg-paper">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">

    <div class="flex items-center justify-between mb-5 sm:mb-7 flex-wrap gap-3">
      <h2 class="font-serif text-lg sm:text-2xl font-bold text-ink">Semua Kampanye</h2>
      <span class="text-[11px] sm:text-xs text-ink-muted" id="result-count">{{ $totalCampaign }} kampanye ditemukan</span>
    </div>

    <div id="campaign-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
      @forelse($campaignList as $c)
        @php
          $percent = min(100, round($c['raised'] / max(1, $c['target']) * 100, 1));
          $sisa    = max(0, $c['target'] - $c['raised']);
        @endphp
        <a href="{{ url('/donasi/'.$c['slug']) }}"
           class="campaign-card bento-card group flex flex-col justify-between"
           data-category="{{ $c['category'] }}"
           data-urgent="{{ $c['urgent'] ? '1' : '0' }}"
           data-progress="{{ $percent }}"
           data-raised="{{ $c['raised'] }}"
           data-donors="{{ $c['donors'] }}"
           data-days="{{ $c['days_left'] }}"
           data-search="{{ strtolower($c['title'].' '.$c['location'].' '.$c['organization'].' '.($categoryList[$c['category']] ?? '').' '.$c['summary']) }}">

          {{-- Visual --}}
          @if(!empty($c['image']))
            <div class="h-40 sm:h-44 overflow-hidden relative">
              <img src="{{ asset('storage/'.$c['image']) }}" alt="{{ $c['title'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"/>
              @if($c['urgent'])
                <span class="absolute top-3 left-3 badge-pill bg-red-500 text-white text-[10px] flex items-center gap-1.5">
                  <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Mendesak
                </span>
              @endif
            </div>
          @else
            @php
              $palettes = [
                'pendidikan'   => 'from-primary-500 via-primary-600 to-primary-800',
                'kesehatan'    => 'from-forest-700 via-forest-800 to-forest-950',
                'pemberdayaan' => 'from-sun-400 via-sun-500 to-primary-600',
                'bencana'      => 'from-primary-700 via-primary-800 to-forest-900',
              ];
              $palette = $palettes[$c['category']] ?? 'from-stone-600 to-stone-800';
            @endphp
            <div class="h-40 sm:h-44 bg-gradient-to-br {{ $palette }} relative overflow-hidden">
              <div class="absolute -right-8 -top-8 w-32 h-32 rounded-full bg-white/10"></div>
              <div class="absolute left-1/3 -bottom-10 w-28 h-28 rounded-full bg-white/5"></div>
              <div class="relative h-full flex flex-col justify-between p-5 text-white">
                <div class="flex items-start justify-between gap-2">
                  <span class="badge-pill bg-white/20 backdrop-blur-md text-white border border-white/25 text-[10px]">
                    {{ $categoryList[$c['category']] ?? 'Umum' }}
                  </span>
                  @if($c['urgent'])
                    <span class="badge-pill bg-red-500 text-white text-[10px] flex items-center gap-1.5">
                      <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Mendesak
                    </span>
                  @endif
                </div>
                <div>
                  <span class="block text-[10px] uppercase tracking-widest text-white/70">Sisa Waktu</span>
                  <span class="block font-serif text-2xl font-bold">{{ $c['days_left'] }} hari</span>
                </div>
              </div>
            </div>
          @endif

          {{-- Body --}}
          <div class="p-5 sm:p-6 flex-1 flex flex-col">
            @if(!empty($c['image']))
              <div class="flex items-center gap-2 flex-wrap mb-2.5">
                <span class="badge-pill bg-tint-primary text-accent-primary border border-tint-primary-line text-[10px]">
                  {{ $categoryList[$c['category']] ?? 'Umum' }}
                </span>
                <span class="text-[10px] text-ink-muted flex items-center gap-1">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                  {{ $c['location'] }}
                </span>
              </div>
            @else
              <span class="text-[10px] text-ink-muted flex items-center gap-1 mb-2.5">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                {{ $c['location'] }}
              </span>
            @endif

            <h3 class="font-serif font-bold text-base sm:text-lg text-ink leading-snug group-hover:text-accent-primary transition-colors line-clamp-2">
              {{ $c['title'] }}
            </h3>
            <p class="text-xs text-ink-muted mt-2 leading-relaxed line-clamp-2 flex-1">
              {{ $c['summary'] }}
            </p>

            {{-- Progress --}}
            <div class="mt-4">
              <div class="flex items-center justify-between text-[11px] mb-1.5">
                <span class="font-bold text-ink">{{ $formatRupiah($c['raised']) }}</span>
                <span class="text-ink-muted">{{ $percent }}%</span>
              </div>
              <div class="w-full h-2 rounded-full bg-paper-warm overflow-hidden">
                <div class="h-full rounded-full bg-gradient-to-r from-primary-500 to-primary-600" style="width: {{ $percent }}%"></div>
              </div>
              <div class="flex items-center justify-between text-[10px] text-ink-muted mt-1.5">
                <span>dari {{ $formatRupiah($c['target']) }}</span>
                <span class="font-semibold text-accent-primary">Sisa {{ $formatRupiah($sisa) }}</span>
              </div>
            </div>

            {{-- Meta --}}
            <div class="flex items-center gap-3 mt-4 pt-3.5 border-t border-line-soft text-[10px] text-ink-muted flex-wrap">
              <span class="flex items-center gap-1">
                <svg class="w-3.5 h-3.5 text-accent-forest" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/></svg>
                {{ number_format($c['donors'], 0, ',', '.') }} donatur
              </span>
              @if($c['verified'])
              <span class="flex items-center gap-1 text-accent-forest font-semibold">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812z" clip-rule="evenodd"/></svg>
                Terverifikasi
              </span>
              @endif
              <span class="flex items-center gap-1 ml-auto font-semibold text-accent-primary group-hover:underline">
                Donasi
                <svg class="w-3 h-3 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
              </span>
            </div>
          </div>
        </a>
      @empty
        <div class="col-span-full p-8 sm:p-16 text-center rounded-3xl bg-surface border-2 border-dashed border-line">
          <div class="w-16 h-16 rounded-2xl bg-paper-warm border border-line flex items-center justify-center mx-auto text-ink-light">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
          </div>
          <p class="font-serif text-lg sm:text-xl font-bold text-ink mt-4">Belum ada kampanye galang dana</p>
          <p class="text-xs sm:text-sm text-ink-muted mt-2 max-w-md mx-auto leading-relaxed">
            Data kampanye belum diisi. Tambahkan kampanye pada file
            <code class="px-1.5 py-0.5 rounded bg-paper-warm border border-line text-[11px] font-mono text-accent-primary">resources/data/campaigns.php</code>
            lalu halaman ini otomatis menampilkan kartu kampanye, filter, dan progresnya.
          </p>
        </div>
      @endforelse
    </div>

    {{-- Empty State --}}
    <div id="empty-state" class="hidden py-16 sm:py-20 text-center">
      <div class="w-16 h-16 rounded-3xl bg-paper-warm border border-line flex items-center justify-center mx-auto text-ink-light">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
      </div>
      <p class="font-serif text-lg font-bold text-ink mt-4">Kampanye tidak ditemukan</p>
      <p class="text-xs sm:text-sm text-ink-muted mt-1">Coba kata kunci lain atau pilih kategori berbeda.</p>
      <button type="button" id="reset-filter" class="btn-pill btn-outline text-xs mt-5">Tampilkan Semua Kampanye</button>
    </div>

  </div>
</section>

{{-- ═══════════════ CARA KERJA / TRUST ═══════════════ --}}
<section class="py-14 sm:py-20 bg-surface border-y border-line/60">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-14">
      <span class="badge-pill bg-tint-forest text-accent-forest border border-tint-forest-line text-[10px] sm:text-xs">Alur Donasi</span>
      <h2 class="font-serif text-2xl sm:text-4xl font-bold text-ink mt-2 sm:mt-3">Bagaimana Donasimu Bekerja</h2>
      <p class="text-xs sm:text-sm text-ink-muted mt-2.5">Empat langkah sederhana, seluruhnya dapat dipantau dan dipertanggungjawabkan.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
      @foreach([
        ['n' => '01', 't' => 'Pilih Kampanye', 'd' => 'Telusuri kampanye yang diverifikasi tim kami dan pilih yang paling menyentuh hatimu.', 'c' => 'primary'],
        ['n' => '02', 't' => 'Tentukan Nominal', 'd' => 'Donasi nominal apa pun, sekali atau rutin bulanan. Tidak ada potongan biaya platform.', 'c' => 'forest'],
        ['n' => '03', 't' => 'Bayar dengan Aman', 'd' => 'QRIS, virtual account bank, maupun e-wallet. Transaksi dienkripsi dan otomatis terkonfirmasi.', 'c' => 'sun'],
        ['n' => '04', 't' => 'Pantau Laporan', 'd' => 'Terima laporan penyaluran berkala lengkap dengan dokumentasi visual dan bukti pengeluaran.', 'c' => 'ink'],
      ] as $step)
      <div class="p-6 sm:p-7 rounded-3xl bg-paper-warm border border-line/70 hover:shadow-warm transition-all duration-300">
        <div class="w-10 h-10 rounded-2xl flex items-center justify-center font-bold text-xs mb-4
          @if($step['c']==='primary') bg-primary-100 text-accent-primary
          @elseif($step['c']==='forest') bg-tint-forest-2 text-accent-forest
          @elseif($step['c']==='sun') bg-sun-100 text-accent-sun
          @else bg-line text-ink @endif">
          {{ $step['n'] }}
        </div>
        <h3 class="font-serif font-bold text-base sm:text-lg text-ink">{{ $step['t'] }}</h3>
        <p class="text-xs text-ink-muted mt-2 leading-relaxed">{{ $step['d'] }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ═══════════════ CTA ═══════════════ --}}
<section class="py-14 sm:py-20 bg-gradient-to-br from-primary-600 via-primary-700 to-forest-900 text-white relative overflow-hidden">
  <div class="absolute -right-16 top-0 w-64 h-64 rounded-full bg-white/5"></div>
  <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center relative z-10">
    <span class="badge-pill bg-white/20 text-white border border-white/30 mb-3 text-[10px] sm:text-xs">Punya Misi Sosial?</span>
    <h2 class="font-serif text-2xl sm:text-4xl md:text-5xl font-bold leading-tight">
      Galang Dana untuk Sekitarmu di Sini
    </h2>
    <p class="text-primary-100 text-xs sm:text-base mt-3 sm:mt-4 max-w-xl mx-auto leading-relaxed px-2">
      Kami mendampingi dari penyusunan halaman donasi, verifikasi penerima manfaat, hingga pelaporan dana secara terbuka.
    </p>
    <div class="mt-6 sm:mt-8 flex items-center justify-center gap-3 flex-col sm:flex-row w-full max-w-md mx-auto sm:max-w-none">
      <a href="{{ url('/kontak') }}" class="btn-pill btn-sun font-bold text-sm shadow-warm-lg w-full sm:w-auto">Ajukan Galang Dana</a>
      <a href="{{ url('/donasi/form') }}" class="btn-pill btn-outline-white text-sm w-full sm:w-auto">Donasi Tanpa Kampanye</a>
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('campaign-search');
    const searchClear = document.getElementById('search-clear');
    const sortSelect  = document.getElementById('sort-select');
    const grid        = document.getElementById('campaign-grid');
    const emptyState  = document.getElementById('empty-state');
    const resultCount = document.getElementById('result-count');
    const resetFilter = document.getElementById('reset-filter');
    const chips       = document.querySelectorAll('.category-chip');

    let activeCategory = 'all';
    let activeSort     = 'urgent';

    const allCards = () => Array.from(grid.querySelectorAll('.campaign-card'));

    const applyChipStyle = (chip) => {
      const isActive = chip.dataset.category === activeCategory;
      chip.classList.toggle('bg-primary-500', isActive);
      chip.classList.toggle('border-primary-500', isActive);
      chip.classList.toggle('text-white', isActive);
      chip.classList.toggle('shadow-warm-sm', isActive);
      chip.classList.toggle('bg-surface', !isActive);
      chip.classList.toggle('border-line', !isActive);
      chip.classList.toggle('text-ink-muted', !isActive);
    };

    const render = () => {
      const keyword = (searchInput?.value || '').trim().toLowerCase();
      let visible = 0;

      allCards().forEach(card => {
        const matchCategory =
          activeCategory === 'all' ||
          (activeCategory === 'urgent' ? card.dataset.urgent === '1' : card.dataset.category === activeCategory);
        const matchSearch = !keyword || (card.dataset.search || '').includes(keyword);

        const show = matchCategory && matchSearch;
        card.classList.toggle('hidden', !show);
        if (show) visible++;
      });

      // Urutkan kartu terlihat
      const sorted = allCards()
        .filter(c => !c.classList.contains('hidden'))
        .sort((a, b) => {
          if (activeSort === 'progress') return parseFloat(b.dataset.progress) - parseFloat(a.dataset.progress);
          if (activeSort === 'raised')   return parseInt(b.dataset.raised) - parseInt(a.dataset.raised);
          if (activeSort === 'donors')   return parseInt(b.dataset.donors) - parseInt(a.dataset.donors);
          if (activeSort === 'days')     return parseInt(a.dataset.days) - parseInt(b.dataset.days);
          // urgent
          return (parseInt(b.dataset.urgent) - parseInt(a.dataset.urgent)) ||
                 (parseInt(a.dataset.days) - parseInt(b.dataset.days));
        });
      sorted.forEach(c => grid.appendChild(c));

      emptyState.classList.toggle('hidden', visible > 0);
      resultCount.textContent = visible + ' kampanye ditemukan';
      if (searchClear) searchClear.classList.toggle('hidden', !keyword);
    };

    chips.forEach(chip => {
      chip.addEventListener('click', () => {
        activeCategory = chip.dataset.category;
        chips.forEach(applyChipStyle);
        render();
      });
    });

    searchInput?.addEventListener('input', render);
    sortSelect?.addEventListener('change', () => { activeSort = sortSelect.value; render(); });

    searchClear?.addEventListener('click', () => {
      searchInput.value = '';
      render();
      searchInput.focus();
    });

    resetFilter?.addEventListener('click', () => {
      activeCategory = 'all';
      if (searchInput) searchInput.value = '';
      chips.forEach(applyChipStyle);
      render();
    });
  });
</script>

@endsection