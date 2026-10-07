@extends('layouts.app')

@php
  $campaignList = $campaigns ?? [];
  $selected     = request('campaign');
  $presets = [
    ['amount' => 50000,   'impact' => '1 Paket Alat Tulis Baru'],
    ['amount' => 100000,  'impact' => 'Makanan Sehat 1 Minggu'],
    ['amount' => 250000,  'impact' => 'Beasiswa SPP 1 Bulan'],
    ['amount' => 500000,  'impact' => 'Seragam Lengkap 2 Anak'],
    ['amount' => 1000000, 'impact' => 'Buku & Sudut Baca Baru'],
    ['amount' => 2500000, 'impact' => 'Operasional Balai Edukasi'],
  ];
@endphp

@section('content')

{{-- Header --}}
<section class="pt-20 sm:pt-28 pb-10 sm:pb-12 bg-gradient-to-b from-paper-warm to-paper text-center">
  <div class="max-w-3xl mx-auto px-4 sm:px-6">
    <span class="badge-pill bg-tint-primary text-accent-primary border border-tint-primary-line text-[10px] sm:text-xs">Amal Jariyah & Kebaikan</span>
    <h1 class="font-serif text-2xl sm:text-4xl lg:text-5xl font-bold text-ink mt-2 sm:mt-3 tracking-tight">
      Salurkan Pelita Kebaikan Anda
    </h1>
    <p class="mt-2.5 sm:mt-3 text-xs sm:text-base text-ink-muted max-w-xl mx-auto px-2">
      100% donasi dialokasikan untuk pemenuhan gizi, biaya sekolah, dan fasilitas belajar anak pelosok negeri.
    </p>
    <div class="mt-5">
      <a href="{{ url('/donasi') }}" class="btn-pill btn-outline text-xs">
        &larr; Jelajahi Kampanye
      </a>
    </div>
  </div>
</section>

{{-- Form Section --}}
<section class="py-8 sm:py-12 bg-paper">
  <div class="max-w-3xl mx-auto px-3.5 sm:px-6">
    
 <div class="bento-card p-5 sm:p-10">

      {{-- Success Alert --}}
      @if(session('success'))
        <div class="mb-6 sm:mb-8 p-4 sm:p-5 rounded-2xl bg-tint-forest border border-tint-forest-2 text-accent-forest text-xs sm:text-sm flex items-center gap-3">
          <div class="w-8 h-8 rounded-full bg-forest-500 text-white flex items-center justify-center font-bold text-sm shrink-0">
            ✓
          </div>
          <div>
            <p class="font-bold">Alhamdulillah, Donasi Berhasil Diterima!</p>
            <p class="text-[11px] sm:text-xs text-accent-forest mt-0.5">{{ session('success') }}</p>
          </div>
        </div>
      @endif

      {{-- Error Alert --}}
      @if($errors->any())
        <div class="mb-6 sm:mb-8 p-4 sm:p-5 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-xs sm:text-sm">
          <p class="font-bold mb-1">Mohon lengkapi formulir dengan benar:</p>
          <ul class="list-disc list-inside text-[11px] sm:text-xs space-y-1">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('donasi.store') }}" method="POST" id="donation-form" class="space-y-6 sm:space-y-8">
        @csrf

        {{-- 1. FREKUENSI --}}
        <div>
          <label class="block text-[11px] sm:text-xs font-bold uppercase tracking-wider text-ink-muted mb-2.5">Frekuensi Donasi</label>
          <div class="grid grid-cols-2 gap-2 p-1.5 bg-paper-warm rounded-2xl border border-line/80">
            <label class="cursor-pointer">
              <input type="radio" name="frequency" value="once" class="peer sr-only" checked />
              <div class="py-2.5 text-center text-xs font-bold rounded-xl transition-all peer-checked:bg-surface peer-checked:text-accent-primary peer-checked:shadow-warm-sm text-ink-muted flex items-center justify-center min-h-[42px]">
                Sekali Berbagi
              </div>
            </label>
            <label class="cursor-pointer">
              <input type="radio" name="frequency" value="monthly" class="peer sr-only" />
              <div class="py-2.5 text-center text-xs font-bold rounded-xl transition-all peer-checked:bg-surface peer-checked:text-accent-primary peer-checked:shadow-warm-sm text-ink-muted flex items-center justify-center gap-1 min-h-[42px]">
                <span>Rutin Tiap Bulan</span>
                <span class="text-[9px] px-1.5 py-0.2 bg-primary-100 text-accent-primary rounded-full font-extrabold hidden sm:inline">Sahabat</span>
              </div>
            </label>
          </div>
        </div>

        {{-- 2. PERUNTUKAN / KAMPANYE --}}
        <div>
          <label class="block text-[11px] sm:text-xs font-bold uppercase tracking-wider text-ink-muted mb-2.5">Peruntukan Dana</label>
          <select name="campaign" class="input-premium !py-3.5 text-sm font-semibold cursor-pointer">
            <option value="umum" {{ !$selected ? 'selected' : '' }}>Donasi Umum — program paling mendesak</option>
            @foreach($campaignList as $c)
              <option value="{{ $c['slug'] }}" {{ $selected === $c['slug'] ? 'selected' : '' }}>
                {{ \Illuminate\Support\Str::limit($c['title'], 58) }}
              </option>
            @endforeach
          </select>
          <p class="text-[10px] text-ink-muted mt-1.5">Pilih kampanye tertentu, atau biarkan umum agar disalurkan ke kebutuhan paling mendesak.</p>
        </div>

        {{-- 3. NOMINAL --}}
        <div>
          <div class="flex items-center justify-between mb-2.5">
            <label class="block text-[11px] sm:text-xs font-bold uppercase tracking-wider text-ink-muted">Pilih Nominal</label>
            <span class="text-[10px] sm:text-[11px] text-accent-primary font-semibold" id="impact-label">{{ $presets[0]['impact'] }}</span>
          </div>

          <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
            @foreach($presets as $idx => $preset)
              <button type="button" 
                      data-amount="{{ $preset['amount'] }}" 
                      data-impact="{{ $preset['impact'] }}"
                      class="nominal-button p-3 sm:p-3.5 rounded-2xl border text-left transition-all min-h-[54px] {{ $idx === 0 ? 'border-primary-500 bg-tint-primary/50 shadow-warm-sm' : 'border-line bg-surface hover:border-line-strong' }}">
                <span class="block text-xs font-bold text-ink">Rp {{ number_format($preset['amount'], 0, ',', '.') }}</span>
                <span class="block text-[9px] sm:text-[10px] text-ink-muted mt-0.5 truncate">{{ $preset['impact'] }}</span>
              </button>
            @endforeach
          </div>

          <div class="mt-3 relative">
            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-xs font-bold text-ink-muted">Rp</span>
            <input type="number" 
                   name="amount" 
                   id="custom-amount-input" 
                   value="{{ request('nominal', 50000) }}" 
                   min="10000" 
                   step="5000" 
                   placeholder="Nominal lainnya (Min. 10.000)" 
                   class="input-premium pl-9 text-sm font-bold" />
          </div>
        </div>

        {{-- 4. DATA DONATUR --}}
        <div class="pt-4 border-t border-line-soft space-y-3.5">
          <label class="block text-[11px] sm:text-xs font-bold uppercase tracking-wider text-ink-muted">Identitas Donatur</label>
          
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
            <div>
              <label class="block text-xs font-semibold text-ink mb-1">Nama Lengkap</label>
              <input type="text" name="name" id="donor-name" placeholder="Nama Anda (Bisa Anonim)" value="{{ old('name') }}" class="input-premium" />
            </div>
            <div>
              <label class="block text-xs font-semibold text-ink mb-1">No. WhatsApp <span class="text-accent-primary">*</span></label>
              <input type="tel" name="phone" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}" required class="input-premium" />
            </div>
          </div>

          <div>
            <label class="block text-xs font-semibold text-ink mb-1">Alamat Email (Untuk Bukti & Laporan) <span class="text-accent-primary">*</span></label>
            <input type="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required class="input-premium" />
          </div>

          <div class="flex items-center gap-2 pt-1">
            <input type="checkbox" id="anon-check" class="rounded text-accent-primary focus:ring-primary-500 w-4 h-4 border-line-strong">
            <label for="anon-check" class="text-xs text-ink-muted cursor-pointer select-none">Sembunyikan nama saya (Hamba Allah)</label>
          </div>
        </div>

        {{-- 5. METODE PEMBAYARAN --}}
        <div class="pt-4 border-t border-line-soft">
          <label class="block text-[11px] sm:text-xs font-bold uppercase tracking-wider text-ink-muted mb-2.5">Metode Pembayaran</label>
          
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
            <label class="cursor-pointer">
              <input type="radio" name="payment_method" value="qris" class="peer sr-only" checked />
              <div class="p-2.5 sm:p-3 rounded-2xl border border-line peer-checked:border-primary-500 peer-checked:bg-tint-primary/50 peer-checked:shadow-warm-sm transition-all text-center min-h-[54px] flex flex-col justify-center">
                <span class="block text-xs font-bold text-ink">QRIS Instan</span>
                <span class="block text-[9px] sm:text-[10px] text-accent-forest font-semibold mt-0.5">Gopay, OVO, Dana</span>
              </div>
            </label>

            <label class="cursor-pointer">
              <input type="radio" name="payment_method" value="bca" class="peer sr-only" />
              <div class="p-2.5 sm:p-3 rounded-2xl border border-line peer-checked:border-primary-500 peer-checked:bg-tint-primary/50 peer-checked:shadow-warm-sm transition-all text-center min-h-[54px] flex flex-col justify-center">
                <span class="block text-xs font-bold text-ink">Bank BCA</span>
                <span class="block text-[9px] sm:text-[10px] text-ink-muted mt-0.5">Virtual Account</span>
              </div>
            </label>

            <label class="cursor-pointer">
              <input type="radio" name="payment_method" value="mandiri" class="peer sr-only" />
              <div class="p-2.5 sm:p-3 rounded-2xl border border-line peer-checked:border-primary-500 peer-checked:bg-tint-primary/50 peer-checked:shadow-warm-sm transition-all text-center min-h-[54px] flex flex-col justify-center">
                <span class="block text-xs font-bold text-ink">Mandiri</span>
                <span class="block text-[9px] sm:text-[10px] text-ink-muted mt-0.5">Virtual Account</span>
              </div>
            </label>

            <label class="cursor-pointer">
              <input type="radio" name="payment_method" value="bri" class="peer sr-only" />
              <div class="p-2.5 sm:p-3 rounded-2xl border border-line peer-checked:border-primary-500 peer-checked:bg-tint-primary/50 peer-checked:shadow-warm-sm transition-all text-center min-h-[54px] flex flex-col justify-center">
                <span class="block text-xs font-bold text-ink">Bank BRI</span>
                <span class="block text-[9px] sm:text-[10px] text-ink-muted mt-0.5">Virtual Account</span>
              </div>
            </label>
          </div>
        </div>

        {{-- SUBMIT --}}
        <div class="pt-2">
          <button type="submit" class="btn-pill btn-primary w-full !py-4 text-base font-bold shadow-warm-lg flex items-center justify-center gap-2">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            Lanjutkan Pembayaran Donasi
          </button>
          
          <div class="mt-3 flex items-center justify-center gap-3 text-[10px] sm:text-[11px] text-ink-muted flex-wrap">
            <span class="flex items-center gap-1">
              <svg class="w-3.5 h-3.5 text-accent-forest" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
              </svg>
              Enkripsi SSL 256-Bit
            </span>
            <span>&bull;</span>
            <span>Konfirmasi Otomatis via WA</span>
          </div>
        </div>

      </form>
    </div>

  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const customInput = document.getElementById('custom-amount-input');
    const impactLabel = document.getElementById('impact-label');
    const buttons = document.querySelectorAll('.nominal-button');
    const anonCheck = document.getElementById('anon-check');
    const donorName = document.getElementById('donor-name');

    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        buttons.forEach(b => {
          b.classList.remove('border-primary-500', 'bg-tint-primary/50', 'shadow-warm-sm');
          b.classList.add('border-line', 'bg-surface');
        });
        btn.classList.remove('border-line', 'bg-surface');
        btn.classList.add('border-primary-500', 'bg-tint-primary/50', 'shadow-warm-sm');

        const amt = btn.getAttribute('data-amount');
        const imp = btn.getAttribute('data-impact');
        if (customInput) customInput.value = amt;
        if (impactLabel) impactLabel.textContent = imp;
      });
    });

    if (customInput) {
      customInput.addEventListener('input', () => {
        buttons.forEach(b => {
          b.classList.remove('border-primary-500', 'bg-tint-primary/50', 'shadow-warm-sm');
          b.classList.add('border-line', 'bg-surface');
        });
        if (impactLabel) impactLabel.textContent = 'Nominal Kustom Pilihan Anda';
      });
    }

    if (anonCheck && donorName) {
      anonCheck.addEventListener('change', () => {
        if (anonCheck.checked) {
          donorName.value = 'Hamba Allah';
          donorName.disabled = true;
          donorName.classList.add('bg-block', 'opacity-70');
        } else {
          donorName.value = '';
          donorName.disabled = false;
          donorName.classList.remove('bg-block', 'opacity-70');
        }
      });
    }
  });
</script>

@endsection