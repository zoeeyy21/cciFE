@extends('layouts.app')

@php
  $percent = min(100, round($campaign['raised'] / max(1, $campaign['target']) * 100, 1));
  $sisa = max(0, $campaign['target'] - $campaign['raised']);

  $formatRupiah = function (int $n) {
    if ($n >= 1000000)
      return 'Rp ' . number_format($n / 1000000, 0, ',', '.') . ' jt';
    return 'Rp ' . number_format($n, 0, ',', '.');
  };
  $formatFull = fn(int $n) => 'Rp ' . number_format($n, 0, ',', '.');

  $presets = [
    ['amount' => 50000, 'impact' => 'Alat tulis lengkap 1 anak'],
    ['amount' => 100000, 'impact' => 'Makan bergizi seminggu'],
    ['amount' => 250000, 'impact' => 'Biaya sekolah sebulan'],
    ['amount' => 500000, 'impact' => 'Paket seragam & sepatu'],
    ['amount' => 1000000, 'impact' => 'Dukung operasional lapangan'],
    ['amount' => 2500000, 'impact' => 'Dampingi 5 anak sekaligus'],
  ];

  $palettes = [
    'pendidikan' => 'from-primary-500 via-primary-600 to-primary-800',
    'kesehatan' => 'from-forest-700 via-forest-800 to-forest-950',
    'pemberdayaan' => 'from-sun-400 via-sun-500 to-primary-600',
    'bencana' => 'from-primary-700 via-primary-800 to-forest-900',
  ];
  $palette = $palettes[$campaign['category']] ?? 'from-stone-600 to-stone-800';
@endphp

@section('content')

  {{-- ═══════════════ HERO KAMPANYE ═══════════════ --}}
  <section class="pt-20 sm:pt-28 pb-6 sm:pb-8 bg-gradient-to-b from-paper-warm to-paper">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <a href="{{ url('/donasi') }}"
        class="inline-flex items-center gap-2 text-xs font-bold text-ink-muted hover:text-accent-primary transition-colors mb-5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Jelajahi Kampanye Lain
      </a>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">

        {{-- Kolom Kiri: Visual + Cerita --}}
        <div class="lg:col-span-7 space-y-6">

          {{-- Visual Utama --}}
          <div class="bento-card overflow-hidden">
            @if(!empty($campaign['image']))
              <img src="{{ asset('storage/' . $campaign['image']) }}" alt="{{ $campaign['title'] }}"
                class="w-full max-h-[420px] object-cover" />
            @else
              <div class="h-56 sm:h-80 bg-gradient-to-br {{ $palette }} relative overflow-hidden">
                <div class="absolute -right-12 -top-12 w-56 h-56 rounded-full bg-white/10"></div>
                <div class="absolute -left-10 bottom-0 w-40 h-40 rounded-full bg-white/5"></div>
                <div class="relative h-full flex flex-col justify-between p-6 sm:p-9 text-white">
                  <div class="flex items-center gap-2 flex-wrap">
                    <span class="badge-pill bg-white/20 backdrop-blur-md text-white border border-white/25 text-[10px]">
                      {{ $categories[$campaign['category']] ?? 'Umum' }}
                    </span>
                  </div>
                  <div>
                    <span class="block text-[11px] uppercase tracking-widest text-white/70">Sisa Waktu Penggalangan</span>
                    <span class="block font-serif text-4xl sm:text-5xl font-bold mt-1">{{ $campaign['days_left'] }}
                      hari</span>
                  </div>
                </div>
              </div>
            @endif

            <div class="p-5 sm:p-7">
              <div class="flex items-center gap-2 flex-wrap mb-3">
                <span class="badge-pill bg-tint-primary text-accent-primary border border-tint-primary-line text-[10px]">
                  {{ $categories[$campaign['category']] ?? 'Umum' }}
                </span>
                <span class="text-[11px] text-ink-muted flex items-center gap-1">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  {{ $campaign['location'] }}
                </span>
                @if($campaign['verified'])
                  <span class="text-[11px] text-accent-forest font-semibold flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd"
                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812z"
                        clip-rule="evenodd" />
                    </svg>
                    Diverifikasi Tim Kami
                  </span>
                @endif
              </div>

              <h1 class="font-serif text-2xl sm:text-4xl font-bold text-ink leading-tight">
                {{ $campaign['title'] }}
              </h1>
              <p
                class="mt-4 text-sm sm:text-base text-ink-muted leading-relaxed font-serif italic border-l-4 border-primary-200 pl-4">
                "{{ $campaign['summary'] }}"
              </p>
            </div>
          </div>

          {{-- Cerita Lengkap --}}
          <div class="bento-card p-5 sm:p-7">
            <h2 class="font-serif text-lg sm:text-xl font-bold text-ink mb-4 flex items-center gap-2">
              <span class="w-1.5 h-5 rounded-full bg-primary-500"></span>
              Cerita Lengkap
            </h2>
            <div class="space-y-4 text-sm text-ink-muted leading-relaxed">
              @foreach($campaign['story'] as $paragraph)
                <p>{{ $paragraph }}</p>
              @endforeach
            </div>

            <div class="mt-6 p-4 sm:p-5 rounded-2xl bg-paper-warm border border-line flex items-start gap-3">
              <div
                class="w-9 h-9 rounded-xl bg-tint-forest-2 text-accent-forest flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                    clip-rule="evenodd" />
                </svg>
              </div>
              <div>
                <p class="text-xs font-bold text-ink">Dikelola oleh {{ $campaign['organization'] }}</p>
                <p class="text-[11px] text-ink-muted mt-0.5 leading-relaxed">
                  Dana disalurkan langsung kepada penerima manfaat. Setiap pengeluaran dilaporkan dengan bukti kuitansi
                  dan dokumentasi penyaluran.
                </p>
              </div>
            </div>
          </div>
        </div>

        {{-- Kolom Kanan: Progress + Form Donasi (Sticky) --}}
        <div class="lg:col-span-5">
          <div class="lg:sticky lg:top-24 space-y-5">

            {{-- Kartu Status Donatur & Sisa Hari --}}
            <div class="bento-card p-5 sm:p-6">
              <div class="grid grid-cols-2 gap-3 text-center">
                <div class="p-3.5 rounded-2xl bg-paper-warm/90 border border-line/60">
                  <span
                    class="block font-serif font-bold text-2xl text-ink leading-tight">{{ number_format($campaign['donors'], 0, ',', '.') }}</span>
                  <span class="block text-xs text-ink-muted mt-1 font-medium">Donatur</span>
                </div>
                <div class="p-3.5 rounded-2xl bg-tint-primary/60 border border-tint-primary-line">
                  <span
                    class="block font-serif font-bold text-2xl text-accent-primary leading-tight">{{ $campaign['days_left'] }}</span>
                  <span class="block text-xs text-ink-muted mt-1 font-medium">Hari Sisa</span>
                </div>
              </div>
            </div>

            {{-- Form Donasi Inline --}}
            <div class="bento-card p-5 sm:p-6" id="form-donasi">
              @if(session('success'))
                <div
                  class="mb-5 p-4 rounded-2xl bg-tint-forest border border-tint-forest-2 text-accent-forest text-xs flex items-center gap-3">
                  <div
                    class="w-7 h-7 rounded-full bg-forest-500 text-white flex items-center justify-center font-bold text-xs shrink-0">
                    ✓</div>
                  <p class="font-semibold">{{ session('success') }}</p>
                </div>
              @endif

              @if($errors->any())
                <div class="mb-5 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-xs">
                  <p class="font-bold mb-1">Mohon periksa kembali:</p>
                  <ul class="list-disc list-inside space-y-0.5 text-[11px]">
                    @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>@endforeach
                  </ul>
                </div>
              @endif

              <h2 class="font-serif text-lg font-bold text-ink mb-1">Donasi untuk Kampanye Ini</h2>
              <p class="text-[11px] text-ink-muted mb-4">Lengkapi identitas dan tentukan pilihan donasi terbaik Anda.</p>

              @php
                $donType = $campaign['donation_type'] ?? 'both'; // 'both', 'package', 'nominal'
                $minDon = (int) ($campaign['min_donation'] ?? 28000);
                $packages = $campaign['packages'] ?? [];
                $initialMode = ($donType === 'nominal') ? 'nominal' : 'package';
              @endphp

              <form action="{{ route('donasi.store') }}" method="POST" id="inline-donation-form" class="space-y-4">
                @csrf
                <input type="hidden" name="campaign" value="{{ $campaign['slug'] }}" />
                <input type="hidden" name="frequency" value="once" />
                <input type="hidden" name="amount" id="inline-amount" value="0" />
                <input type="hidden" name="donation_mode" id="inline-donation-mode" value="{{ $initialMode }}" />
                <input type="hidden" name="package_name" id="inline-package-name" value="" />
                <input type="hidden" name="package_qty" id="inline-package-qty" value="1" />
                <input type="hidden" name="payment_method" value="qris" />

                {{-- 1. SWITCHER TIPE DONASI (Muncul jika tipe Kombinasi / 'both') --}}
                @if($donType === 'both')
                  <div class="p-1 rounded-2xl bg-paper-warm border border-line flex gap-1" id="donation-mode-switcher">
                    <button 
                      type="button" 
                      id="tab-mode-package" 
                      class="flex-1 py-2.5 px-3 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-1.5 bg-surface text-forest-700 dark:text-sun-300 shadow-warm-sm border border-line"
                    >
                      <svg class="w-4 h-4 text-forest-600 dark:text-sun-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                      <span>Sedekah Paket</span>
                    </button>
                    <button 
                      type="button" 
                      id="tab-mode-nominal" 
                      class="flex-1 py-2.5 px-3 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-1.5 text-ink-muted hover:text-ink"
                    >
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                      <span>Nominal Bebas</span>
                    </button>
                  </div>
                @endif

                {{-- 2. DATA IDENTITAS DONATUR --}}
                <div class="space-y-3 pt-1">
                  <div>
                    <label class="block text-xs font-semibold text-ink mb-1">Nama Donatur <span class="text-accent-primary">*</span></label>
                    <input type="text" name="name" id="inline-name" placeholder="Nama Lengkap Anda" value="{{ old('name') }}"
                      required class="input-premium transition-all" />
                  </div>

                  <div>
                    <label class="block text-xs font-semibold text-ink mb-1">Nomor WhatsApp <span class="text-accent-primary">*</span></label>
                    <input type="tel" name="phone" id="inline-phone" placeholder="Contoh: 0812xxxxxxxx" value="{{ old('phone') }}"
                      required class="input-premium" />
                  </div>

                  <div class="flex items-center gap-2 pt-0.5">
                    <input type="checkbox" id="inline-anon"
                      class="rounded text-accent-primary focus:ring-primary-500 w-4 h-4 border-line-strong cursor-pointer">
                    <label for="inline-anon" class="text-xs text-ink-muted cursor-pointer select-none">
                      Donasi sebagai <strong class="text-ink font-semibold">Hamba Allah</strong> (Nama disamarkan)
                    </label>
                  </div>
                </div>

                {{-- 3. DI BAWAH FORM NOMOR: PILIHAN DONASI SESUAI MODE --}}

                {{-- 3A. FORM MODE PAKET --}}
                <div id="section-package-mode" class="space-y-3 pt-3 border-t border-line-soft {{ ($initialMode !== 'package') ? 'hidden' : '' }}">
                  <div class="flex items-center justify-between">
                    <label class="block text-xs font-semibold text-ink">Pilih Paket Donasi</label>
                    <span class="text-[11px] text-ink-muted">Pilih salah satu paket</span>
                  </div>

                  {{-- Daftar Kartu Paket (Sesuai Gaya Kartu Hijau Pilihan) --}}
                  <div class="space-y-2.5" id="package-options-list">
                    @foreach($packages as $index => $pkg)
                      <div 
                        class="package-card p-3.5 sm:p-4 rounded-2xl border-2 transition-all cursor-pointer select-none {{ $index === 0 ? 'border-forest-600 bg-forest-50/70 dark:bg-forest-950/40 shadow-warm-sm active-pkg' : 'border-line bg-surface hover:border-forest-300' }}"
                        data-id="{{ $pkg['id'] ?? 'pkg-'.$index }}"
                        data-name="{{ $pkg['name'] }}"
                        data-price="{{ $pkg['price'] }}"
                      >
                        <div class="flex items-start justify-between gap-3">
                          <div class="flex-1">
                            <div class="flex items-center gap-2 flex-wrap">
                              <span class="font-bold text-sm pkg-title {{ $index === 0 ? 'text-forest-800 dark:text-sun-300' : 'text-ink' }}">{{ $pkg['name'] }}</span>
                              @if(!empty($pkg['badge']))
                                <span class="badge-pill bg-neutral-900 text-white dark:bg-neutral-100 dark:text-neutral-900 text-[9px] font-bold px-2 py-0.5 uppercase tracking-wider rounded-full shadow-sm">
                                  {{ $pkg['badge'] }}
                                </span>
                              @endif
                            </div>
                            @if(!empty($pkg['description']))
                              <p class="text-xs text-ink-muted mt-1 leading-snug">
                                {{ $pkg['description'] }}
                              </p>
                            @endif
                          </div>
                          <div class="text-right shrink-0">
                            <span class="font-serif font-bold text-base sm:text-lg pkg-price {{ $index === 0 ? 'text-forest-700 dark:text-sun-300' : 'text-ink' }}">
                              Rp {{ number_format($pkg['price'], 0, ',', '.') }}
                            </span>
                            <span class="block text-[11px] text-ink-muted mt-0.5">
                              {{ $pkg['unit'] ?? '/ paket' }}
                            </span>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>

                  {{-- Stepper: Mau sedekah berapa paket? --}}
                  <div class="p-3.5 rounded-2xl bg-paper-warm border border-line flex items-center justify-between gap-3 flex-wrap">
                    <div>
                      <span class="block text-xs font-bold text-ink">Mau sedekah berapa paket?</span>
                      <span class="block text-[11px] text-ink-muted mt-0.5" id="pkg-calc-label">1 paket x Rp {{ number_format($packages[0]['price'] ?? 28000, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                      <button type="button" id="btn-qty-minus" class="w-8 h-8 rounded-xl bg-surface border border-line text-ink font-bold flex items-center justify-center hover:bg-paper-warm active:scale-95 transition-all text-sm">-</button>
                      <span id="pkg-qty-text" class="w-8 text-center font-bold text-sm text-ink font-mono">1</span>
                      <button type="button" id="btn-qty-plus" class="w-8 h-8 rounded-xl bg-surface border border-line text-ink font-bold flex items-center justify-center hover:bg-paper-warm active:scale-95 transition-all text-sm">+</button>
                    </div>
                  </div>

                  {{-- Pilihan Cepat Jumlah Paket --}}
                  <div class="flex items-center gap-2 pt-0.5">
                    <span class="text-[11px] text-ink-muted font-medium mr-0.5">Jumlah:</span>
                    @foreach([1, 2, 5, 10] as $q)
                      <button type="button" class="btn-quick-qty px-2.5 py-1 rounded-xl bg-surface border border-line text-[11px] font-bold text-ink hover:border-forest-500 hover:text-forest-700 transition-all {{ $q === 1 ? 'border-forest-500 bg-forest-50/50 text-forest-700' : '' }}" data-qty="{{ $q }}">
                        {{ $q }} Paket
                      </button>
                    @endforeach
                  </div>

                  {{-- Total Donasi Paket Banner --}}
                  <div class="p-3.5 rounded-2xl bg-forest-900 text-white flex items-center justify-between shadow-warm-sm">
                    <span class="text-xs text-forest-200">Total Donasi Paket:</span>
                    <span class="font-serif font-bold text-lg text-sun-300" id="pkg-total-display">Rp {{ number_format($packages[0]['price'] ?? 28000, 0, ',', '.') }}</span>
                  </div>
                </div>

                {{-- 3B. FORM MODE MINIMAL DONASI --}}
                <div id="section-nominal-mode" class="space-y-3 pt-3 border-t border-line-soft {{ ($initialMode !== 'nominal') ? 'hidden' : '' }}">
                  <div class="flex items-center justify-between">
                    <label class="block text-xs font-semibold text-ink">Mau donasi berapa?</label>
                    <span class="text-[11px] font-semibold text-accent-primary bg-tint-primary px-2.5 py-0.5 rounded-full border border-tint-primary-line">
                      Minimal Rp {{ number_format($minDon, 0, ',', '.') }}
                    </span>
                  </div>

                  {{-- Nominal Presets --}}
                  @php
                    $presets = array_unique([
                      $minDon,
                      max($minDon, 50000),
                      max($minDon, 100000),
                      max($minDon, 250000),
                      max($minDon, 500000),
                      max($minDon, 1000000),
                    ]);
                    sort($presets);
                    $presets = array_slice($presets, 0, 6);
                  @endphp
                  <div class="grid grid-cols-3 gap-2">
                    @foreach($presets as $idx => $preset)
                      <button 
                        type="button" 
                        class="btn-nominal-preset p-2.5 rounded-xl border border-line bg-surface text-ink text-xs font-bold hover:border-forest-500 hover:bg-forest-50/40 transition-all text-center {{ $idx === 0 ? 'border-primary-500 bg-tint-primary/50 text-accent-primary shadow-warm-sm active-preset' : '' }}" 
                        data-amount="{{ $preset }}"
                      >
                        Rp {{ number_format($preset, 0, ',', '.') }}
                      </button>
                    @endforeach
                  </div>

                  {{-- Custom Amount Input --}}
                  <div>
                    <div class="relative flex items-center">
                      <span class="absolute left-3.5 z-10 text-xs font-bold text-ink-muted select-none pointer-events-none">Rp</span>
                      <input 
                        type="number" 
                        id="input-custom-nominal" 
                        placeholder="Atau ketik nominal lainnya..." 
                        min="{{ $minDon }}" 
                        step="1000" 
                        style="padding-left: 2.75rem !important;"
                        class="input-premium !pl-11 transition-all" 
                      />
                    </div>
                    <p id="nominal-min-warning" class="hidden text-[11px] text-red-500 font-medium flex items-center gap-1.5 pt-1.5">
                      <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                      <span>Nominal donasi minimal sebesar Rp {{ number_format($minDon, 0, ',', '.') }}</span>
                    </p>
                  </div>
                </div>

                {{-- 4. SUBMIT BUTTON --}}
                <div class="pt-2">
                  <button type="submit"
                    id="btn-submit-donation"
                    class="btn-pill btn-primary w-full !py-3.5 text-sm font-bold shadow-warm-lg flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                      <path
                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                    <span>Lanjutkan Pembayaran</span>
                  </button>
                </div>

                <p class="text-center text-[10px] text-ink-muted flex items-center justify-center gap-1.5">
                  <svg class="w-3 h-3 text-accent-forest" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                      clip-rule="evenodd" />
                  </svg>
                  Transaksi terenkripsi &amp; aman
                </p>
              </form>
            </div>

            {{-- Bagikan --}}
            <div class="bento-card p-5">
              <p class="text-xs font-bold text-ink mb-3">Bantu sebarkan kampanye ini</p>
              <div class="grid grid-cols-3 gap-2">
                <a href="https://wa.me/?text={{ urlencode($campaign['title'] . ' — ' . url('/donasi/' . $campaign['slug'])) }}"
                  target="_blank"
                  class="p-2.5 rounded-xl border border-line hover:border-emerald-400 hover:bg-emerald-50 transition-all text-center">
                  <span class="block text-[11px] font-bold text-ink">WhatsApp</span>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/donasi/' . $campaign['slug'])) }}"
                  target="_blank"
                  class="p-2.5 rounded-xl border border-line hover:border-sky-400 hover:bg-sky-50 transition-all text-center">
                  <span class="block text-[11px] font-bold text-ink">Facebook</span>
                </a>
                <button type="button" id="copy-link"
                  class="p-2.5 rounded-xl border border-line hover:border-primary-400 hover:bg-tint-primary transition-all text-center">
                  <span class="block text-[11px] font-bold text-ink" id="copy-link-text">Salin Tautan</span>
                </button>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- ═══════════════ KAMPANYE LAIN ═══════════════ --}}
  @if(!empty($others))
    <section class="py-12 sm:py-20 bg-surface border-t border-line/60">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="flex items-center gap-2 mb-6 sm:mb-8">
          <span class="w-1.5 h-6 rounded-full bg-forest-700"></span>
          <h2 class="font-serif text-lg sm:text-2xl font-bold text-ink">Kampanye Lain yang Butuh Bantuan</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
          @foreach($others as $o)
            @php
              $oPercent = min(100, round($o['raised'] / max(1, $o['target']) * 100, 1));
              $oPalette = $palettes[$o['category']] ?? 'from-stone-600 to-stone-800';
            @endphp
            <a href="{{ url('/donasi/' . $o['slug']) }}" class="bento-card group flex flex-col justify-between">
              <div>
                @if(!empty($o['image']))
                  <div class="h-40 overflow-hidden">
                    <img src="{{ asset('storage/' . $o['image']) }}" alt="{{ $o['title'] }}"
                      class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                  </div>
                @else
                  <div class="h-36 bg-gradient-to-br {{ $oPalette }} relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-28 h-28 rounded-full bg-white/10"></div>
                    <div class="relative h-full flex items-center px-5">
                      <span class="badge-pill bg-white/20 backdrop-blur-md text-white border border-white/25 text-[10px]">
                        {{ $categories[$o['category']] ?? 'Umum' }}
                      </span>
                    </div>
                  </div>
                @endif
                <div class="p-5">
                  <h3
                    class="font-serif font-bold text-base text-ink group-hover:text-accent-primary transition-colors leading-snug line-clamp-2">
                    {{ $o['title'] }}</h3>
                  <p class="text-[11px] text-ink-muted mt-2 line-clamp-2 leading-relaxed">{{ $o['summary'] }}</p>
                </div>
              </div>
              <div class="px-5 pb-5">
                <div class="flex items-center justify-between text-[11px] mb-1.5">
                  <span class="font-bold text-ink">{{ $formatRupiah($o['raised']) }}</span>
                  <span class="text-ink-muted">{{ $oPercent }}%</span>
                </div>
                <div class="w-full h-2 rounded-full bg-paper-warm overflow-hidden">
                  <div class="h-full rounded-full bg-gradient-to-r from-primary-500 to-primary-600 progress-bar-shimmer"
                    style="width: {{ $oPercent }}%"></div>
                </div>
              </div>
            </a>
          @endforeach
        </div>

        <div class="mt-8 text-center">
          <a href="{{ url('/donasi') }}" class="btn-pill btn-outline text-xs">Lihat Semua Kampanye</a>
        </div>
      </div>
    </section>
  @endif

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const form = document.getElementById('inline-donation-form');
      const modeInput = document.getElementById('inline-donation-mode');
      const amountInput = document.getElementById('inline-amount');
      const pkgNameInput = document.getElementById('inline-package-name');
      const pkgQtyInput = document.getElementById('inline-package-qty');
      
      const tabPackage = document.getElementById('tab-mode-package');
      const tabNominal = document.getElementById('tab-mode-nominal');
      const secPackage = document.getElementById('section-package-mode');
      const secNominal = document.getElementById('section-nominal-mode');

      const packageCards = document.querySelectorAll('.package-card');
      const qtyMinusBtn = document.getElementById('btn-qty-minus');
      const qtyPlusBtn = document.getElementById('btn-qty-plus');
      const qtyText = document.getElementById('pkg-qty-text');
      const quickQtyBtns = document.querySelectorAll('.btn-quick-qty');
      const pkgCalcLabel = document.getElementById('pkg-calc-label');
      const pkgTotalDisplay = document.getElementById('pkg-total-display');

      const presetBtns = document.querySelectorAll('.btn-nominal-preset');
      const customNominalInput = document.getElementById('input-custom-nominal');
      const minWarning = document.getElementById('nominal-min-warning');
      const minDonation = {{ (int) $minDon }};

      const anon = document.getElementById('inline-anon');
      const nameField = document.querySelector('#inline-donation-form input[name="name"]');
      const copyBtn = document.getElementById('copy-link');
      const copyText = document.getElementById('copy-link-text');

      let currentMode = modeInput ? modeInput.value : '{{ $initialMode }}';
      let selectedPackagePrice = 0;
      let selectedPackageName = '';
      let packageQty = 1;
      let nominalAmount = {{ (int) ($presets[0] ?? $minDon) }};

      function formatRupiah(num) {
        return new Intl.NumberFormat('id-ID').format(num);
      }

      // Initialize selected package from DOM
      const activePkgCard = document.querySelector('.package-card.active-pkg') || packageCards[0];
      if (activePkgCard) {
        selectedPackagePrice = parseInt(activePkgCard.dataset.price, 10) || 0;
        selectedPackageName = activePkgCard.dataset.name || '';
        if (pkgNameInput) pkgNameInput.value = selectedPackageName;
      }

      function updatePackageCalculation() {
        const total = selectedPackagePrice * packageQty;
        if (qtyText) qtyText.textContent = packageQty;
        if (pkgQtyInput) pkgQtyInput.value = packageQty;
        if (pkgCalcLabel) {
          pkgCalcLabel.textContent = `${packageQty} paket x Rp ${formatRupiah(selectedPackagePrice)}`;
        }
        if (pkgTotalDisplay) {
          pkgTotalDisplay.textContent = `Rp ${formatRupiah(total)}`;
        }
        if (currentMode === 'package') {
          if (amountInput) amountInput.value = total;
        }
      }

      function switchMode(newMode) {
        currentMode = newMode;
        if (modeInput) modeInput.value = newMode;

        if (newMode === 'package') {
          if (secPackage) secPackage.classList.remove('hidden');
          if (secNominal) secNominal.classList.add('hidden');

          if (tabPackage) {
            tabPackage.className = "flex-1 py-2.5 px-3 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-1.5 bg-surface text-forest-700 dark:text-sun-300 shadow-warm-sm border border-line";
          }
          if (tabNominal) {
            tabNominal.className = "flex-1 py-2.5 px-3 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-1.5 text-ink-muted hover:text-ink";
          }
          updatePackageCalculation();
        } else {
          if (secPackage) secPackage.classList.add('hidden');
          if (secNominal) secNominal.classList.remove('hidden');

          if (tabNominal) {
            tabNominal.className = "flex-1 py-2.5 px-3 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-1.5 bg-surface text-forest-700 dark:text-sun-300 shadow-warm-sm border border-line";
          }
          if (tabPackage) {
            tabPackage.className = "flex-1 py-2.5 px-3 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-1.5 text-ink-muted hover:text-ink";
          }
          if (amountInput) amountInput.value = nominalAmount;
        }
      }

      tabPackage?.addEventListener('click', () => switchMode('package'));
      tabNominal?.addEventListener('click', () => switchMode('nominal'));

      // Package Card Selection
      packageCards.forEach(card => {
        card.addEventListener('click', () => {
          packageCards.forEach(c => {
            c.classList.remove('border-forest-600', 'bg-forest-50/70', 'dark:bg-forest-950/40', 'shadow-warm-sm', 'active-pkg');
            c.classList.add('border-line', 'bg-surface');
            const titleEl = c.querySelector('.pkg-title');
            const priceEl = c.querySelector('.pkg-price');
            if (titleEl) {
              titleEl.classList.remove('text-forest-800', 'dark:text-sun-300');
              titleEl.classList.add('text-ink');
            }
            if (priceEl) {
              priceEl.classList.remove('text-forest-700', 'dark:text-sun-300');
              priceEl.classList.add('text-ink');
            }
          });

          card.classList.remove('border-line', 'bg-surface');
          card.classList.add('border-forest-600', 'bg-forest-50/70', 'dark:bg-forest-950/40', 'shadow-warm-sm', 'active-pkg');
          const titleEl = card.querySelector('.pkg-title');
          const priceEl = card.querySelector('.pkg-price');
          if (titleEl) {
            titleEl.classList.remove('text-ink');
            titleEl.classList.add('text-forest-800', 'dark:text-sun-300');
          }
          if (priceEl) {
            priceEl.classList.remove('text-ink');
            priceEl.classList.add('text-forest-700', 'dark:text-sun-300');
          }

          selectedPackagePrice = parseInt(card.dataset.price, 10) || 0;
          selectedPackageName = card.dataset.name || '';
          if (pkgNameInput) pkgNameInput.value = selectedPackageName;
          updatePackageCalculation();
        });
      });

      // Stepper
      qtyMinusBtn?.addEventListener('click', () => {
        if (packageQty > 1) {
          packageQty--;
          updateQuickQtyHighlight();
          updatePackageCalculation();
        }
      });

      qtyPlusBtn?.addEventListener('click', () => {
        packageQty++;
        updateQuickQtyHighlight();
        updatePackageCalculation();
      });

      function updateQuickQtyHighlight() {
        quickQtyBtns.forEach(btn => {
          const q = parseInt(btn.dataset.qty, 10);
          if (q === packageQty) {
            btn.classList.add('border-forest-500', 'bg-forest-50/50', 'text-forest-700');
          } else {
            btn.classList.remove('border-forest-500', 'bg-forest-50/50', 'text-forest-700');
          }
        });
      }

      quickQtyBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          packageQty = parseInt(btn.dataset.qty, 10) || 1;
          updateQuickQtyHighlight();
          updatePackageCalculation();
        });
      });

      // Nominal Presets
      presetBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          presetBtns.forEach(b => {
            b.classList.remove('border-primary-500', 'bg-tint-primary/50', 'text-accent-primary', 'shadow-warm-sm', 'active-preset');
            b.classList.add('border-line', 'bg-surface', 'text-ink');
          });
          btn.classList.remove('border-line', 'bg-surface', 'text-ink');
          btn.classList.add('border-primary-500', 'bg-tint-primary/50', 'text-accent-primary', 'shadow-warm-sm', 'active-preset');

          if (customNominalInput) {
            customNominalInput.value = '';
            customNominalInput.classList.remove('border-red-500', 'focus:border-red-500');
          }
          if (minWarning) minWarning.classList.add('hidden');

          nominalAmount = parseInt(btn.dataset.amount, 10) || minDonation;
          if (currentMode === 'nominal' && amountInput) {
            amountInput.value = nominalAmount;
          }
        });
      });

      // Custom Nominal Input
      customNominalInput?.addEventListener('input', () => {
        // Deselect presets
        presetBtns.forEach(b => {
          b.classList.remove('border-primary-500', 'bg-tint-primary/50', 'text-accent-primary', 'shadow-warm-sm', 'active-preset');
          b.classList.add('border-line', 'bg-surface', 'text-ink');
        });

        const val = parseInt(customNominalInput.value, 10) || 0;
        if (customNominalInput.value !== '' && val < minDonation) {
          if (minWarning) minWarning.classList.remove('hidden');
          customNominalInput.classList.add('border-red-500');
        } else {
          if (minWarning) minWarning.classList.add('hidden');
          customNominalInput.classList.remove('border-red-500');
        }

        nominalAmount = val;
        if (currentMode === 'nominal' && amountInput) {
          amountInput.value = nominalAmount;
        }
      });

      // Initial state calculation
      if (currentMode === 'package') {
        updatePackageCalculation();
      } else {
        if (amountInput) amountInput.value = nominalAmount;
      }

      // Anonymous toggle
      anon?.addEventListener('change', () => {
        if (!nameField) return;
        if (anon.checked) {
          nameField.value = 'Hamba Allah';
          nameField.readOnly = true;
          nameField.classList.add('bg-paper-warm', 'text-ink-muted', 'cursor-not-allowed');
        } else {
          nameField.value = '';
          nameField.readOnly = false;
          nameField.classList.remove('bg-paper-warm', 'text-ink-muted', 'cursor-not-allowed');
          nameField.focus();
        }
      });

      // Copy link
      copyBtn?.addEventListener('click', async () => {
        try {
          await navigator.clipboard.writeText(window.location.href);
          copyText.textContent = 'Tersalin!';
          setTimeout(() => copyText.textContent = 'Salin Tautan', 2000);
        } catch (e) {
          copyText.textContent = 'Gagal menyalin';
          setTimeout(() => copyText.textContent = 'Salin Tautan', 2000);
        }
      });

      // Validation before triggering QRIS modal
      form?.addEventListener('submit', (e) => {
        if (currentMode === 'nominal') {
          const val = parseInt(amountInput ? amountInput.value : 0, 10) || 0;
          if (val < minDonation) {
            e.preventDefault();
            e.stopImmediatePropagation();
            if (minWarning) minWarning.classList.remove('hidden');
            if (customNominalInput) {
              customNominalInput.focus();
              customNominalInput.classList.add('border-red-500');
            }
            return false;
          }
        }
      }, true);

      // Inisialisasi Modal QRIS Langsung
      if (window.initQrisPayment) {
        window.initQrisPayment(
          '#inline-donation-form',
          () => {
            const val = parseInt(document.getElementById('inline-amount')?.value, 10);
            return val > 0 ? val : 50000;
          },
          () => {
            const title = {!! json_encode($campaign['title'] ?? 'Donasi Pelita Bahagia') !!};
            if (currentMode === 'package' && selectedPackageName) {
              return `${title} (${packageQty}x ${selectedPackageName})`;
            }
            return title;
          }
        );
      }
    });
  </script>

  @include('components.qris-modal')

@endsection