<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  {{-- Set tema sebelum paint agar tidak berkedip (FOUC) --}}
  <script>
  (function () {
    try {
      var s = localStorage.getItem('cci-theme');
      var dark = s ? s === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
      if (dark) document.documentElement.classList.add('dark');
    } catch (e) {}
    })();
  </script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
  <meta name="theme-color" content="#fcfbf7" />
  <meta name="description" content="{{ $metaDescription ?? ($site['description'] ?: $site['name'] . ' — Bersama Menerangi Masa Depan & Harapan Anak-Anak Indonesia') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <title>{{ $title ?? $site['name'] }} — Menerangi Masa Depan Anak</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-paper text-ink selection:bg-primary-500 selection:text-white antialiased flex flex-col min-h-screen">

  {{-- Floating Pill Navbar --}}
  <header class="sticky top-2 sm:top-4 z-40 px-3 sm:px-6 pointer-events-none">
    <div class="max-w-6xl mx-auto pointer-events-auto">
    <nav class="glass-nav rounded-full px-3.5 sm:px-6 py-2.5 sm:py-3 flex items-center justify-between shadow-warm transition-all duration-300" id="main-nav">
      {{-- Logo Brand --}}
      <a href="{{ url('/') }}" class="flex items-center gap-2.5 sm:gap-3 group">
        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-serif font-bold text-lg sm:text-xl shadow-md transition-transform duration-300 group-hover:scale-105">
          P
        </div>
        <div class="leading-none">
          <span class="font-serif font-bold text-sm sm:text-base text-ink tracking-tight block">{{ $site['short_name'] }}</span>
              <span class="text-[10px] sm:text-[11px] text-ink-muted font-medium tracking-wider uppercase block">{{ $site['tagline'] ?: 'Anak Nusantara' }}</span>
        </div>
      </a>

      {{-- Desktop Navigation Links --}}
      @php
        $links = [
          ['label' => 'Beranda',  'url' => '/',         'active' => request()->is('/')],
          ['label' => 'Tentang',  'url' => '/tentang',  'active' => request()->is('tentang')],
          ['label' => 'Program',  'url' => '/program',  'active' => request()->is('program*')],
          ['label' => 'Kegiatan', 'url' => '/kegiatan', 'active' => request()->is('kegiatan*')],
          ['label' => 'Galeri',   'url' => '/galeri',   'active' => request()->is('galeri')],
          ['label' => 'Kontak',   'url' => '/kontak',   'active' => request()->is('kontak')],
        ];
      @endphp
      <div class="hidden md:flex items-center gap-1 bg-paper-warm/80 p-1.5 rounded-full border border-line/60">
        @foreach($links as $link)
          <a href="{{ url($link['url']) }}"
             class="px-4 py-1.5 rounded-full text-xs font-semibold tracking-wide transition-all duration-200 {{ $link['active'] ? 'bg-surface text-accent-primary shadow-warm-sm' : 'text-ink-muted hover:text-ink hover:bg-toggle-bg' }}">
            {{ $link['label'] }}
          </a>
        @endforeach
      </div>

      {{-- Right Actions --}}
              <div class="flex items-center gap-1.5 sm:gap-2">
                {{-- Theme Toggle --}}
                <button type="button" id="theme-toggle" aria-label="Ganti mode gelap atau terang"
                        title="Mode gelap / terang"
                        class="theme-toggle w-9 h-9 rounded-full bg-paper-warm border border-line/80 flex items-center justify-center text-ink hover:bg-line transition-colors shrink-0">
                  <svg id="icon-moon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                  </svg>
                  <svg id="icon-sun" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1.5M12 19.5V21M4.22 4.22l1.06 1.06M17.72 17.72l1.06 1.06M3 12h1.5M19.5 12H21M4.22 19.78l1.06-1.06M17.72 6.28l1.06-1.06"/>
                    <circle cx="12" cy="12" r="4" stroke-width="2"/>
                  </svg>
                </button>

                <a href="{{ url('/donasi') }}" class="btn-pill btn-primary !py-2 !px-3.5 sm:!px-5 !text-xs uppercase tracking-wider font-bold shadow-md flex items-center gap-1.5 !min-h-[38px] sm:!min-h-[42px]">
                  <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                  </svg>
                  <span class="hidden sm:inline">Donasi</span>
                </a>

        {{-- Mobile Menu Trigger --}}
        <button id="mobile-toggle" class="md:hidden w-9 h-9 rounded-full bg-paper-warm border border-line/80 flex items-center justify-center text-ink hover:bg-line transition-colors" aria-label="Buka navigasi">
          <svg id="hamburger-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
          <svg id="close-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </nav>

    {{-- Mobile Menu Drawer --}}
    <div id="mobile-drawer" class="hidden md:hidden mt-2 bg-surface/98 backdrop-blur-xl rounded-3xl p-4 sm:p-5 border border-line shadow-warm-lg transition-all duration-300">
      <div class="flex flex-col gap-1">
        @foreach($links as $link)
          <a href="{{ url($link['url']) }}"
             class="px-4 py-3 rounded-2xl text-sm font-semibold transition-colors flex items-center justify-between {{ $link['active'] ? 'bg-tint-primary text-accent-primary' : 'text-ink-muted hover:bg-paper-warm hover:text-ink' }}">
            <span>{{ $link['label'] }}</span>
            <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </a>
        @endforeach
      </div>
      <div class="mt-3 pt-3 border-t border-line-soft flex flex-col gap-2">
                <button type="button" id="theme-toggle-mobile"
                        class="px-4 py-3 rounded-2xl text-sm font-semibold transition-colors flex items-center justify-between text-ink-muted hover:bg-paper-warm hover:text-ink w-full">
                  <span class="flex items-center gap-2">
                    <svg id="icon-moon-mobile" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <svg id="icon-sun-mobile" class="w-4 h-4 hidden text-sun-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1.5M12 19.5V21M4.22 4.22l1.06 1.06M17.72 17.72l1.06 1.06M3 12h1.5M19.5 12H21M4.22 19.78l1.06-1.06M17.72 6.28l1.06-1.06"/>
                      <circle cx="12" cy="12" r="4" stroke-width="2"/>
                    </svg>
                    <span id="theme-label-mobile">Mode Terang</span>
                  </span>
                  <span class="text-[10px] uppercase tracking-widest opacity-60">Tema</span>
                </button>

        <a href="{{ url('/donasi') }}" class="btn-pill btn-primary w-full text-center !py-3.5 text-sm font-bold shadow-md flex items-center justify-center gap-2">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
          </svg>
          Salurkan Donasi Sekarang
        </a>
      </div>
    </div>
    </div>
  </header>

  {{-- Main App Outlet --}}
  <main class="flex-1 pb-16 md:pb-0">
    @yield('content')
  </main>

  {{-- Footer Bento Layout --}}
  <footer class="bg-forest-950 text-forest-100 pt-16 sm:pt-20 pb-24 md:pb-12 border-t border-forest-900 relative overflow-hidden mt-16 sm:mt-20">
    {{-- Ambient Glow Orbs --}}
    <div class="absolute -top-32 left-1/4 w-96 h-96 rounded-full bg-forest-800/20 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-10 w-96 h-96 rounded-full bg-primary-600/10 blur-3xl pointer-events-none"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 sm:gap-10 lg:gap-14 pb-12 sm:pb-16 border-b border-forest-900/80">
      
      {{-- Brand Col --}}
      <div class="md:col-span-5 space-y-4 sm:space-y-6">
        <div class="flex items-center gap-3">
          <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-serif font-bold text-xl sm:text-2xl shadow-glow-primary">
            {{ strtoupper(substr($site['short_name'] ?: $site['name'], 0, 1)) }}
          </div>
          <div>
            <h3 class="font-serif font-bold text-lg sm:text-xl text-white tracking-tight">{{ $site['short_name'] }}</h3>
            <p class="text-[10px] sm:text-xs text-forest-200/70 uppercase tracking-widest font-semibold">{{ $site['tagline'] ?: 'Anak Nusantara' }}</p>
          </div>
        </div>
        <p class="text-forest-200/80 text-xs sm:text-sm leading-relaxed max-w-sm">
          {{ $site['description'] ?: 'Profil yayasan belum diisi — lengkapi pada resources/data/site.php' }}
        </p>
        <div class="flex items-center gap-2 pt-1 flex-wrap">
          <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-forest-900 border border-forest-800 text-[10px] sm:text-[11px] text-forest-200">
            <svg class="w-3 h-3 text-forest-500" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            @if($site['legal_number'])
              {{ $site['legal_number'] }}
            @else
              Kemenkumham RI
            @endif
          </span>
          <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-forest-900 border border-forest-800 text-[10px] sm:text-[11px] text-forest-200">
            100% Transparan
          </span>
        </div>
        @if(array_filter($site['social']))
        <div class="flex items-center gap-2 pt-1">
          @foreach($site['social'] as $platform => $url)
            @if($url)
            <a href="{{ $url }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-full bg-forest-900 border border-forest-800 flex items-center justify-center text-forest-200 hover:text-sun-300 hover:border-forest-700 transition-colors uppercase text-[10px] font-bold">
              {{ substr($platform, 0, 2) }}
            </a>
            @endif
          @endforeach
        </div>
        @endif
      </div>

      {{-- Nav Links --}}
      <div class="md:col-span-2 space-y-3 sm:space-y-4">
        <h4 class="font-serif font-bold text-white text-xs sm:text-sm tracking-wide uppercase text-sun-300">Eksplorasi</h4>
        <ul class="space-y-2 text-xs sm:text-sm text-forest-200/80">
          <li><a href="{{ url('/tentang') }}" class="hover:text-sun-300 transition-colors">Tentang Kami</a></li>
          <li><a href="{{ url('/program') }}" class="hover:text-sun-300 transition-colors">Program Bantuan</a></li>
          <li><a href="{{ url('/kegiatan') }}" class="hover:text-sun-300 transition-colors">Berita & Kegiatan</a></li>
          <li><a href="{{ url('/galeri') }}" class="hover:text-sun-300 transition-colors">Dokumentasi Galeri</a></li>
          <li><a href="{{ url('/kontak') }}" class="hover:text-sun-300 transition-colors">Hubungi Kami</a></li>
        </ul>
      </div>

      {{-- Impact Pillars --}}
      <div class="md:col-span-2 space-y-3 sm:space-y-4">
        <h4 class="font-serif font-bold text-white text-xs sm:text-sm tracking-wide uppercase text-sun-300">Pilar Aksi</h4>
        <ul class="space-y-2 text-xs sm:text-sm text-forest-200/80">
          <li><span class="text-forest-200">&bull;</span> Pendidikan Pelosok</li>
          <li><span class="text-forest-200">&bull;</span> Gizi Sehat</li>
          <li><span class="text-forest-200">&bull;</span> Pemberdayaan Ibu</li>
          <li><span class="text-forest-200">&bull;</span> Tanggap Bencana</li>
        </ul>
      </div>

      {{-- Contact Card --}}
      <div class="md:col-span-3 space-y-3 sm:space-y-4 bg-forest-900/60 p-5 sm:p-6 rounded-3xl border border-forest-800/80 backdrop-blur-md">
        <h4 class="font-serif font-bold text-white text-sm">Sekretariat Yayasan</h4>
        <p class="text-xs text-forest-200/80 leading-relaxed">
          {{ $site['address'] ?: 'Alamat sekretariat belum diisi — lengkapi pada resources/data/site.php' }}
        </p>
        <div class="pt-1 flex flex-col gap-2 text-xs">
          @if($site['email'])
          <a href="mailto:{{ $site['email'] }}" class="text-sun-300 hover:underline flex items-center gap-2">
            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <span class="truncate">{{ $site['email'] }}</span>
          </a>
          @endif
          @if($site['whatsapp_link'])
          <a href="{{ $site['whatsapp_link'] }}" target="_blank" rel="noopener" class="text-forest-200 hover:text-white flex items-center gap-2">
            <svg class="w-3.5 h-3.5 shrink-0 text-emerald-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0012.04 2z"/></svg>
            <span class="truncate">{{ $site['phone'] ?: $site['whatsapp'] }}</span>
          </a>
          @endif
          @if(!$site['email'] && !$site['whatsapp_link'])
          <a href="{{ url('/kontak') }}" class="text-sun-300 hover:underline">Isi kontak di halaman Kontak &rarr;</a>
          @endif
        </div>
      </div>

    </div>

    {{-- Bottom Credit --}}
    <div class="pt-6 sm:pt-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left text-xs text-forest-200">
      <p>&copy; {{ date('Y') }} {{ $site['name'] }}.</p>
      <div class="flex items-center gap-4 sm:gap-6">
        <a href="{{ url('/tentang') }}" class="hover:text-forest-200 transition-colors">Transparansi</a>
        <a href="{{ url('/kontak') }}" class="hover:text-forest-200 transition-colors">Privasi</a>
        <a href="{{ url('/donasi') }}" class="text-sun-300 font-semibold hover:underline">Donasi &rarr;</a>
      </div>
    </div>
    </div>
  </footer>

  {{-- MOBILE BOTTOM NAVIGATION BAR (Thumb Zone Optimized) --}}
  <div class="md:hidden fixed bottom-0 left-0 right-0 z-50 glass-bottom-bar px-3 py-2">
    <div class="flex items-center justify-around max-w-md mx-auto">
    
    {{-- Tab Beranda --}}
    <a href="{{ url('/') }}" class="flex flex-col items-center gap-1 py-1 px-2.5 rounded-xl transition-colors {{ request()->is('/') ? 'text-accent-primary font-bold' : 'text-ink-muted hover:text-ink' }}">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ request()->is('/') ? '2.3' : '1.8' }}" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
      </svg>
      <span class="text-[10px] leading-none">Beranda</span>
    </a>

    {{-- Tab Program --}}
    <a href="{{ url('/program') }}" class="flex flex-col items-center gap-1 py-1 px-2.5 rounded-xl transition-colors {{ request()->is('program*') ? 'text-accent-primary font-bold' : 'text-ink-muted hover:text-ink' }}">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ request()->is('program*') ? '2.3' : '1.8' }}" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
      </svg>
      <span class="text-[10px] leading-none">Program</span>
    </a>

    {{-- Floating Center Donate Button --}}
    <a href="{{ url('/donasi') }}" class="flex flex-col items-center -mt-5 group">
      <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-primary-600 to-primary-500 text-white flex items-center justify-center shadow-lg transition-transform group-active:scale-95 group-hover:scale-105 border-2 border-white">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </svg>
      </div>
      <span class="text-[10px] font-bold text-accent-primary mt-0.5">Donasi</span>
    </a>

    {{-- Tab Kegiatan --}}
    <a href="{{ url('/kegiatan') }}" class="flex flex-col items-center gap-1 py-1 px-2.5 rounded-xl transition-colors {{ request()->is('kegiatan*') ? 'text-accent-primary font-bold' : 'text-ink-muted hover:text-ink' }}">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ request()->is('kegiatan*') ? '2.3' : '1.8' }}" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
      </svg>
      <span class="text-[10px] leading-none">Berita</span>
    </a>

    {{-- Tab Kontak --}}
    <a href="{{ url('/kontak') }}" class="flex flex-col items-center gap-1 py-1 px-2.5 rounded-xl transition-colors {{ request()->is('kontak') ? 'text-accent-primary font-bold' : 'text-ink-muted hover:text-ink' }}">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ request()->is('kontak') ? '2.3' : '1.8' }}" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
      </svg>
      <span class="text-[10px] leading-none">Kontak</span>
    </a>

    </div>
  </div>

  {{-- Toggle Script --}}
  <script>
    const mobileToggle = document.getElementById('mobile-toggle');
    const mobileDrawer = document.getElementById('mobile-drawer');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    if (mobileToggle && mobileDrawer) {
      mobileToggle.addEventListener('click', () => {
        const isHidden = mobileDrawer.classList.toggle('hidden');
        hamburgerIcon.classList.toggle('hidden', !isHidden);
        closeIcon.classList.toggle('hidden', isHidden);
      });
    }
  </script>

    {{-- Theme Toggle Script --}}
  <script>
    (function () {
      const root = document.documentElement;
      const btn = document.getElementById('theme-toggle');
      const btnMobile = document.getElementById('theme-toggle-mobile');
      const label = document.getElementById('theme-label-mobile');
      const iconMoon = document.getElementById('icon-moon');
      const iconSun = document.getElementById('icon-sun');
      const iconMoonMobile = document.getElementById('icon-moon-mobile');
      const iconSunMobile = document.getElementById('icon-sun-mobile');
      const metaTheme = document.querySelector('meta[name="theme-color"]');

      function isDark() { return root.classList.contains('dark'); }

      function paint() {
        const dark = isDark();
        if (iconMoon) iconMoon.classList.toggle('hidden', dark);
        if (iconSun) iconSun.classList.toggle('hidden', !dark);
        if (iconMoonMobile) iconMoonMobile.classList.toggle('hidden', dark);
        if (iconSunMobile) iconSunMobile.classList.toggle('hidden', !dark);
        if (label) label.textContent = dark ? 'Mode Gelap' : 'Mode Terang';
        if (metaTheme) metaTheme.setAttribute('content', dark ? '#0f1311' : '#fcfbf7');
        root.style.colorScheme = dark ? 'dark' : 'light';
      }

      function set(dark) {
        root.classList.toggle('dark', dark);
        try { localStorage.setItem('cci-theme', dark ? 'dark' : 'light'); } catch (e) {}
        paint();
      }

      function toggle() { set(!isDark()); }

      if (btn) btn.addEventListener('click', toggle);
      if (btnMobile) btnMobile.addEventListener('click', toggle);

      try {
        if (!localStorage.getItem('cci-theme')) {
          window.matchMedia('(prefers-color-scheme: dark)')
            .addEventListener('change', e => set(e.matches));
        }
      } catch (e) {}

      paint();
    })();
  </script>
</body>
</html>
