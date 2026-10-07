@extends('layouts.app')

@php
  $percent = min(100, round($campaign['raised'] / max(1, $campaign['target']) * 100, 1));
  $sisa    = max(0, $campaign['target'] - $campaign['raised']);

  $formatRupiah = function (int $n) {
      if ($n >= 1000000) return 'Rp ' . number_format($n / 1000000, 0, ',', '.') . ' jt';
      return 'Rp ' . number_format($n, 0, ',', '.');
  };
  $formatFull = fn (int $n) => 'Rp ' . number_format($n, 0, ',', '.');

  $presets = [
    ['amount' => 50000,   'impact' => 'Alat tulis lengkap 1 anak'],
    ['amount' => 100000,  'impact' => 'Makan bergizi seminggu'],
    ['amount' => 250000,  'impact' => 'Biaya sekolah sebulan'],
    ['amount' => 500000,  'impact' => 'Paket seragam & sepatu'],
    ['amount' => 1000000, 'impact' => 'Dukung operasional lapangan'],
    ['amount' => 2500000, 'impact' => 'Dampingi 5 anak sekaligus'],
  ];

  $palettes = [
    'pendidikan'   => 'from-primary-500 via-primary-600 to-primary-800',
    'kesehatan'    => 'from-forest-700 via-forest-800 to-forest-950',
    'pemberdayaan' => 'from-sun-400 via-sun-500 to-primary-600',
    'bencana'      => 'from-primary-700 via-primary-800 to-forest-900',
  ];
  $palette = $palettes[$campaign['category']] ?? 'from-stone-600 to-stone-800';
@endphp

@section('content')

{{-- ═══════════════ HERO KAMPANYE ═══════════════ --}}
<section class="pt-20 sm:pt-28 pb-6 sm:pb-8 bg-gradient-to-b from-paper-warm to-paper">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <a href="{{ url('/donasi') }}" class="inline-flex items-center gap-2 text-xs font-bold text-ink-muted hover:text-accent-primary transition-colors mb-5">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      Jelajahi Kampanye Lain
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">

      {{-- Kolom Kiri: Visual + Cerita --}}
      <div class="lg:col-span-7 space-y-6">

        {{-- Visual Utama --}}
        <div class="bento-card overflow-hidden">
          @if(!empty($campaign['image']))
            <img src="{{ asset('storage/'.$campaign['image']) }}" alt="{{ $campaign['title'] }}" class="w-full max-h-[420px] object-cover"/>
          @else
            <div class="h-56 sm:h-80 bg-gradient-to-br {{ $palette }} relative overflow-hidden">
              <div class="absolute -right-12 -top-12 w-56 h-56 rounded-full bg-white/10"></div>
              <div class="absolute -left-10 bottom-0 w-40 h-40 rounded-full bg-white/5"></div>
              <div class="relative h-full flex flex-col justify-between p-6 sm:p-9 text-white">
                <div class="flex items-center gap-2 flex-wrap">
                  <span class="badge-pill bg-white/20 backdrop-blur-md text-white border border-white/25 text-[10px]">
                    {{ $categories[$campaign['category']] ?? 'Umum' }}
                  </span>
                  @if($campaign['urgent'])
                    <span class="badge-pill bg-red-500 text-white text-[10px] flex items-center gap-1.5">
                      <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Mendesak
                    </span>
                  @endif
                </div>
                <div>
                  <span class="block text-[11px] uppercase tracking-widest text-white/70">Sisa Waktu Penggalangan</span>
                  <span class="block font-serif text-4xl sm:text-5xl font-bold mt-1">{{ $campaign['days_left'] }} hari</span>
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
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                {{ $campaign['location'] }}
              </span>
              @if($campaign['verified'])
              <span class="text-[11px] text-accent-forest font-semibold flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812z" clip-rule="evenodd"/></svg>
                Diverifikasi Tim Kami
              </span>
              @endif
            </div>

            <h1 class="font-serif text-2xl sm:text-4xl font-bold text-ink leading-tight">
              {{ $campaign['title'] }}
            </h1>
            <p class="mt-4 text-sm sm:text-base text-ink-muted leading-relaxed font-serif italic border-l-4 border-primary-200 pl-4">
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
            <div class="w-9 h-9 rounded-xl bg-tint-forest-2 text-accent-forest flex items-center justify-center shrink-0">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
            </div>
            <div>
              <p class="text-xs font-bold text-ink">Dikelola oleh {{ $campaign['organization'] }}</p>
              <p class="text-[11px] text-ink-muted mt-0.5 leading-relaxed">
                Dana disalurkan langsung kepada penerima manfaat. Setiap pengeluaran dilaporkan dengan bukti kuitansi dan dokumentasi penyaluran.
              </p>
            </div>
          </div>
        </div>

        {{-- Transparansi --}}
 <div class="bento-card p-5 sm:p-7">
          <h2 class="font-serif text-lg sm:text-xl font-bold text-ink mb-4 flex items-center gap-2">
            <span class="w-1.5 h-5 rounded-full bg-forest-700"></span>
            Komitmen Transparansi
          </h2>
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            @foreach([
              ['t' => 'Tanpa Potongan', 'd' => 'Dana donasi masuk 100%'],
              ['t' => 'Laporan Berkala', 'd' => 'Dikirim ke email donatur'],
              ['t' => 'Bukti Kuitansi', 'd' => 'Dokumen publik terbuka'],
            ] as $item)
            <div class="p-4 rounded-2xl bg-paper-warm border border-line/80">
              <div class="w-8 h-8 rounded-lg bg-forest-500/15 text-accent-forest flex items-center justify-center mb-2.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
              </div>
              <p class="text-xs font-bold text-ink">{{ $item['t'] }}</p>
              <p class="text-[10px] text-ink-muted mt-0.5">{{ $item['d'] }}</p>
            </div>
            @endforeach
          </div>
        </div>

      </div>

      {{-- Kolom Kanan: Progress + Form Donasi (Sticky) --}}
      <div class="lg:col-span-5">
        <div class="lg:sticky lg:top-24 space-y-5">

          {{-- Kartu Progres --}}
 <div class="bento-card p-5 sm:p-6">
            <div class="flex items-end justify-between gap-3 mb-1">
              <span class="font-serif text-2xl sm:text-3xl font-bold text-ink">{{ $formatFull($campaign['raised']) }}</span>
              <span class="font-serif text-xl sm:text-2xl font-bold text-accent-primary">{{ $percent }}%</span>
            </div>
            <p class="text-[11px] text-ink-muted mb-3">terkumpul dari target {{ $formatFull($campaign['target']) }}</p>

            <div class="w-full h-3 rounded-full bg-paper-warm overflow-hidden">
              <div class="h-full rounded-full bg-gradient-to-r from-primary-500 to-primary-600" style="width: {{ $percent }}%"></div>
            </div>

            <div class="grid grid-cols-3 gap-2 mt-4 text-center">
              <div class="p-2.5 rounded-xl bg-paper-warm">
                <span class="block font-serif font-bold text-sm text-ink">{{ number_format($campaign['donors'], 0, ',', '.') }}</span>
                <span class="block text-[10px] text-ink-muted mt-0.5">Donatur</span>
              </div>
              <div class="p-2.5 rounded-xl bg-paper-warm">
                <span class="block font-serif font-bold text-sm text-accent-primary">{{ $campaign['days_left'] }}</span>
                <span class="block text-[10px] text-ink-muted mt-0.5">Hari Sisa</span>
              </div>
              <div class="p-2.5 rounded-xl bg-paper-warm">
                <span class="block font-serif font-bold text-sm text-accent-forest">{{ $formatRupiah($sisa) }}</span>
                <span class="block text-[10px] text-ink-muted mt-0.5">Kekurangan</span>
              </div>
            </div>
          </div>

          {{-- Form Donasi Inline --}}
 <div class="bento-card p-5 sm:p-6" id="form-donasi">
            @if(session('success'))
              <div class="mb-5 p-4 rounded-2xl bg-tint-forest border border-tint-forest-2 text-accent-forest text-xs flex items-center gap-3">
                <div class="w-7 h-7 rounded-full bg-forest-500 text-white flex items-center justify-center font-bold text-xs shrink-0">✓</div>
                <p class="font-semibold">{{ session('success') }}</p>
              </div>
            @endif

            @if($errors->any())
              <div class="mb-5 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-xs">
                <p class="font-bold mb-1">Mohon periksa kembali:</p>
                <ul class="list-disc list-inside space-y-0.5 text-[11px]">
                  @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
                </ul>
              </div>
            @endif

            <h2 class="font-serif text-lg font-bold text-ink mb-1">Donasi untuk Kampanye Ini</h2>
            <p class="text-[11px] text-ink-muted mb-5">Pilih nominal, lalu lanjutkan ke pembayaran.</p>

            <form action="{{ route('donasi.store') }}" method="POST" id="inline-donation-form" class="space-y-5">
              @csrf
              <input type="hidden" name="campaign" value="{{ $campaign['slug'] }}"/>

              {{-- Frekuensi --}}
              <div class="grid grid-cols-2 gap-2 p-1.5 bg-paper-warm rounded-2xl border border-line/80">
                <label class="cursor-pointer">
                  <input type="radio" name="frequency" value="once" class="peer sr-only" checked/>
                  <div class="py-2.5 text-center text-xs font-bold rounded-xl transition-all peer-checked:bg-surface peer-checked:text-accent-primary peer-checked:shadow-warm-sm text-ink-muted min-h-[42px] flex items-center justify-center">Sekali</div>
                </label>
                <label class="cursor-pointer">
                  <input type="radio" name="frequency" value="monthly" class="peer sr-only"/>
                  <div class="py-2.5 text-center text-xs font-bold rounded-xl transition-all peer-checked:bg-surface peer-checked:text-accent-primary peer-checked:shadow-warm-sm text-ink-muted min-h-[42px] flex items-center justify-center">Rutin Bulanan</div>
                </label>
              </div>

              {{-- Preset Nominal --}}
              <div>
                <div class="flex items-center justify-between mb-2">
                  <span class="text-[11px] font-bold uppercase tracking-wider text-ink-muted">Nominal</span>
                  <span class="text-[10px] font-semibold text-accent-primary" id="inline-impact-label">{{ $presets[0]['impact'] }}</span>
                </div>
                <div class="grid grid-cols-3 gap-2">
                  @foreach($presets as $i => $p)
                    <button type="button"
                            data-amount="{{ $p['amount'] }}"
                            data-impact="{{ $p['impact'] }}"
                            class="inline-nominal p-2.5 rounded-xl border text-center transition-all min-h-[52px] flex flex-col justify-center {{ $i === 0 ? 'border-primary-500 bg-tint-primary/50 shadow-warm-sm' : 'border-line bg-surface hover:border-line-strong' }}">
                      <span class="block text-[11px] font-bold text-ink">Rp {{ number_format($p['amount'] / 1000, 0, ',', '.') }}rb</span>
                    </button>
                  @endforeach
                </div>
                <div class="relative mt-2.5">
                  <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-xs font-bold text-ink-muted">Rp</span>
                  <input type="number" name="amount" id="inline-amount" value="50000" min="10000" step="5000"
                         placeholder="Nominal lain" class="input-premium !pl-9 text-sm font-bold"/>
                </div>
              </div>

              {{-- Data Donatur --}}
              <div class="space-y-3 pt-3 border-t border-line-soft">
                <input type="text" name="name" placeholder="Nama kamu (opsional)" value="{{ old('name') }}" class="input-premium"/>
                <input type="email" name="email" placeholder="Email untuk laporan donasi" value="{{ old('email') }}" required class="input-premium"/>
                <input type="tel" name="phone" placeholder="Nomor WhatsApp (opsional)" value="{{ old('phone') }}" class="input-premium"/>
                <div class="flex items-center gap-2">
                  <input type="checkbox" id="inline-anon" class="rounded text-accent-primary focus:ring-primary-500 w-4 h-4 border-line-strong">
                  <label for="inline-anon" class="text-[11px] text-ink-muted cursor-pointer select-none">Donasi sebagai Hamba Allah</label>
                </div>
              </div>

              {{-- Metode --}}
              <div class="pt-3 border-t border-line-soft">
                <span class="block text-[11px] font-bold uppercase tracking-wider text-ink-muted mb-2">Metode Pembayaran</span>
                <div class="grid grid-cols-2 gap-2">
                  <label class="cursor-pointer">
                    <input type="radio" name="payment_method" value="qris" class="peer sr-only" checked/>
                    <div class="p-2.5 rounded-xl border border-line peer-checked:border-primary-500 peer-checked:bg-tint-primary/50 transition-all text-center min-h-[50px] flex flex-col justify-center">
                      <span class="block text-[11px] font-bold text-ink">QRIS</span>
                      <span class="block text-[9px] text-ink-muted">Gopay, OVO, Dana</span>
                    </div>
                  </label>
                  <label class="cursor-pointer">
                    <input type="radio" name="payment_method" value="bca" class="peer sr-only"/>
                    <div class="p-2.5 rounded-xl border border-line peer-checked:border-primary-500 peer-checked:bg-tint-primary/50 transition-all text-center min-h-[50px] flex flex-col justify-center">
                      <span class="block text-[11px] font-bold text-ink">Bank BCA</span>
                      <span class="block text-[9px] text-ink-muted">Virtual Account</span>
                    </div>
                  </label>
                  <label class="cursor-pointer">
                    <input type="radio" name="payment_method" value="mandiri" class="peer sr-only"/>
                    <div class="p-2.5 rounded-xl border border-line peer-checked:border-primary-500 peer-checked:bg-tint-primary/50 transition-all text-center min-h-[50px] flex flex-col justify-center">
                      <span class="block text-[11px] font-bold text-ink">Mandiri</span>
                      <span class="block text-[9px] text-ink-muted">Virtual Account</span>
                    </div>
                  </label>
                  <label class="cursor-pointer">
                    <input type="radio" name="payment_method" value="bri" class="peer sr-only"/>
                    <div class="p-2.5 rounded-xl border border-line peer-checked:border-primary-500 peer-checked:bg-tint-primary/50 transition-all text-center min-h-[50px] flex flex-col justify-center">
                      <span class="block text-[11px] font-bold text-ink">Bank BRI</span>
                      <span class="block text-[9px] text-ink-muted">Virtual Account</span>
                    </div>
                  </label>
                </div>
              </div>

              <button type="submit" class="btn-pill btn-primary w-full !py-3.5 text-sm font-bold shadow-warm-lg flex items-center justify-center gap-2">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                Lanjutkan Pembayaran
              </button>

              <p class="text-center text-[10px] text-ink-muted flex items-center justify-center gap-1.5">
                <svg class="w-3 h-3 text-accent-forest" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                Transaksi terenkripsi &amp; aman
              </p>
            </form>
          </div>

          {{-- Bagikan --}}
 <div class="bento-card p-5">
            <p class="text-xs font-bold text-ink mb-3">Bantu sebarkan kampanye ini</p>
            <div class="grid grid-cols-3 gap-2">
              <a href="https://wa.me/?text={{ urlencode($campaign['title'].' — '.url('/donasi/'.$campaign['slug'])) }}" target="_blank"
                 class="p-2.5 rounded-xl border border-line hover:border-emerald-400 hover:bg-emerald-50 transition-all text-center">
                <span class="block text-[11px] font-bold text-ink">WhatsApp</span>
              </a>
              <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/donasi/'.$campaign['slug'])) }}" target="_blank"
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
        <a href="{{ url('/donasi/'.$o['slug']) }}" class="bento-card group flex flex-col justify-between">
          <div>
            @if(!empty($o['image']))
              <div class="h-40 overflow-hidden">
                <img src="{{ asset('storage/'.$o['image']) }}" alt="{{ $o['title'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"/>
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
              <h3 class="font-serif font-bold text-base text-ink group-hover:text-accent-primary transition-colors leading-snug line-clamp-2">{{ $o['title'] }}</h3>
              <p class="text-[11px] text-ink-muted mt-2 line-clamp-2 leading-relaxed">{{ $o['summary'] }}</p>
            </div>
          </div>
          <div class="px-5 pb-5">
            <div class="flex items-center justify-between text-[11px] mb-1.5">
              <span class="font-bold text-ink">{{ $formatRupiah($o['raised']) }}</span>
              <span class="text-ink-muted">{{ $oPercent }}%</span>
            </div>
            <div class="w-full h-2 rounded-full bg-paper-warm overflow-hidden">
              <div class="h-full rounded-full bg-gradient-to-r from-primary-500 to-primary-600" style="width: {{ $oPercent }}%"></div>
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
    const amountInput = document.getElementById('inline-amount');
    const impactLabel = document.getElementById('inline-impact-label');
    const buttons     = document.querySelectorAll('.inline-nominal');
    const anon        = document.getElementById('inline-anon');
    const nameField   = document.querySelector('#inline-donation-form input[name="name"]');
    const copyBtn     = document.getElementById('copy-link');
    const copyText    = document.getElementById('copy-link-text');

    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        buttons.forEach(b => {
          b.classList.remove('border-primary-500', 'bg-tint-primary/50', 'shadow-warm-sm');
          b.classList.add('border-line', 'bg-surface');
        });
        btn.classList.remove('border-line', 'bg-surface');
        btn.classList.add('border-primary-500', 'bg-tint-primary/50', 'shadow-warm-sm');
        if (amountInput) amountInput.value = btn.dataset.amount;
        if (impactLabel) impactLabel.textContent = btn.dataset.impact;
      });
    });

    amountInput?.addEventListener('input', () => {
      buttons.forEach(b => {
        b.classList.remove('border-primary-500', 'bg-tint-primary/50', 'shadow-warm-sm');
        b.classList.add('border-line', 'bg-surface');
      });
      if (impactLabel) impactLabel.textContent = 'Nominal pilihanmu';
    });

    anon?.addEventListener('change', () => {
      if (!nameField) return;
      if (anon.checked) {
        nameField.value = 'Hamba Allah';
        nameField.disabled = true;
        nameField.classList.add('bg-block', 'opacity-70');
      } else {
        nameField.value = '';
        nameField.disabled = false;
        nameField.classList.remove('bg-block', 'opacity-70');
      }
    });

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
  });
</script>

@endsection