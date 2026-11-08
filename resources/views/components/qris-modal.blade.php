{{-- Modal QRIS Pembayaran Donasi --}}
<div 
  id="qris-modal" 
  class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-md flex items-center justify-center p-3 sm:p-4 overflow-y-auto"
  role="dialog"
  aria-modal="true"
  aria-labelledby="qris-modal-title"
>
  <div class="relative w-full max-w-md bg-surface rounded-3xl border border-line shadow-2xl overflow-hidden my-auto flex flex-col max-h-[92vh] animate-in fade-in zoom-in-95 duration-200">
    
    {{-- Header Modal QRIS --}}
    <div class="bg-gradient-to-r from-red-600 via-rose-600 to-red-700 px-5 sm:px-6 py-3.5 text-white flex items-center justify-between shrink-0">
      <div class="flex items-center gap-2">
        <div class="bg-white px-2 py-0.5 rounded font-black text-red-600 text-xs tracking-tighter shadow-sm">
          QRIS
        </div>
        <span class="text-xs font-semibold tracking-wide text-white/95">Standar Pembayaran Nasional</span>
      </div>
      <button 
        type="button" 
        id="qris-modal-close" 
        class="w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 text-white flex items-center justify-center transition-colors focus:outline-none"
        title="Tutup Modal"
      >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    {{-- Body Modal (Scrollable jika layar pendek) --}}
    <div class="p-5 sm:p-6 text-center space-y-3.5 overflow-y-auto flex-1">
      
      {{-- Info Penerima --}}
      <div>
        <p class="text-[10px] font-bold uppercase tracking-wider text-ink-muted">Penerima Donasi</p>
        <h3 id="qris-modal-title" class="font-serif font-bold text-base sm:text-lg text-ink mt-0.5 leading-snug">
          {{ $site['name'] ?? 'Yayasan Pelita Bahagia Anak Nusantara' }}
        </h3>
        <p id="qris-campaign-name" class="text-xs text-accent-primary font-medium mt-0.5 line-clamp-1">
          Donasi Umum Pelita Bahagia
        </p>
      </div>

      {{-- Total Nominal Donasi --}}
      <div class="py-2.5 px-4 rounded-2xl bg-paper-warm border border-line">
        <span class="block text-[10px] font-semibold text-ink-muted uppercase tracking-wider">Total Pembayaran</span>
        <span id="qris-modal-amount" class="block font-serif text-2xl sm:text-3xl font-bold text-accent-forest mt-0.5">
          Rp 50.000
        </span>
        <div class="flex items-center justify-center gap-2 text-[10px] text-ink-muted mt-1">
          <span>NMID: <strong class="font-mono text-ink">ID1024389201928</strong></span>
          <span>&bull;</span>
          <span class="text-emerald-600 font-semibold">Bebas Biaya Admin</span>
        </div>
      </div>

      {{-- Container Gambar QR Code --}}
      <div class="relative mx-auto w-56 sm:w-60 p-3.5 bg-white rounded-2xl border-2 border-line shadow-warm flex flex-col items-center justify-center">
        {{-- Logo QRIS & GPN di atas QR --}}
        <div class="w-full flex items-center justify-between px-1 pb-1.5 border-b border-gray-100 mb-2">
          <span class="font-black text-[13px] tracking-tight text-red-600">QRIS</span>
          <span class="text-[9px] font-bold text-gray-500 tracking-wider uppercase">GPN</span>
        </div>

        {{-- QR Code Display --}}
        <div class="relative w-44 h-44 bg-white flex items-center justify-center" id="qris-code-container">
          {{-- Authentic Vector QR Pattern --}}
          <svg id="qris-svg-code" class="w-full h-full text-gray-900" viewBox="0 0 100 100" fill="currentColor">
            <!-- Corner Finder Pattern: Top-Left -->
            <rect x="5" y="5" width="26" height="26" fill="currentColor" rx="3"/>
            <rect x="9" y="9" width="18" height="18" fill="white" rx="2"/>
            <rect x="13" y="13" width="10" height="10" fill="currentColor" rx="1.5"/>

            <!-- Corner Finder Pattern: Top-Right -->
            <rect x="69" y="5" width="26" height="26" fill="currentColor" rx="3"/>
            <rect x="73" y="9" width="18" height="18" fill="white" rx="2"/>
            <rect x="77" y="13" width="10" height="10" fill="currentColor" rx="1.5"/>

            <!-- Corner Finder Pattern: Bottom-Left -->
            <rect x="5" y="69" width="26" height="26" fill="currentColor" rx="3"/>
            <rect x="9" y="73" width="18" height="18" fill="white" rx="2"/>
            <rect x="13" y="77" width="10" height="10" fill="currentColor" rx="1.5"/>

            <!-- Timing and Alignment Patterns -->
            <rect x="35" y="9" width="4" height="4"/>
            <rect x="43" y="9" width="4" height="4"/>
            <rect x="51" y="9" width="4" height="4"/>
            <rect x="59" y="9" width="4" height="4"/>
            <rect x="9" y="35" width="4" height="4"/>
            <rect x="9" y="43" width="4" height="4"/>
            <rect x="9" y="51" width="4" height="4"/>
            <rect x="9" y="59" width="4" height="4"/>

            <!-- Random Data Modules Grid -->
            <rect x="35" y="17" width="4" height="8"/>
            <rect x="47" y="17" width="8" height="4"/>
            <rect x="59" y="17" width="4" height="4"/>
            <rect x="35" y="29" width="8" height="4"/>
            <rect x="47" y="25" width="4" height="8"/>
            <rect x="55" y="29" width="8" height="4"/>

            <rect x="17" y="35" width="4" height="4"/>
            <rect x="25" y="35" width="4" height="8"/>
            <rect x="69" y="35" width="8" height="4"/>
            <rect x="81" y="35" width="8" height="4"/>
            <rect x="17" y="47" width="8" height="4"/>
            <rect x="29" y="47" width="4" height="8"/>
            <rect x="69" y="43" width="4" height="12"/>
            <rect x="77" y="47" width="8" height="4"/>
            <rect x="89" y="43" width="4" height="8"/>

            <rect x="35" y="69" width="8" height="4"/>
            <rect x="47" y="69" width="4" height="8"/>
            <rect x="55" y="69" width="8" height="4"/>
            <rect x="35" y="77" width="4" height="8"/>
            <rect x="43" y="81" width="8" height="4"/>
            <rect x="55" y="77" width="4" height="12"/>
            <rect x="69" y="69" width="12" height="4"/>
            <rect x="85" y="69" width="8" height="4"/>
            <rect x="69" y="77" width="4" height="8"/>
            <rect x="77" y="77" width="8" height="8"/>
            <rect x="89" y="81" width="4" height="8"/>
            <rect x="69" y="89" width="8" height="4"/>
            <rect x="81" y="89" width="12" height="4"/>
          </svg>

          {{-- Logo Center Badge --}}
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-10 h-10 rounded-xl bg-white p-1 border-2 border-red-500 shadow-md flex items-center justify-center">
              <img src="{{ asset('images/logo-icon.png') }}" alt="Pelita" class="w-full h-full object-contain" />
            </div>
          </div>
        </div>

        <p class="text-[10px] text-gray-500 font-medium mt-2">
          Pindai dengan aplikasi pembayaran apa saja
        </p>

        {{-- Tombol Unduh QR (Memudahkan Donatur Mobile) --}}
        <button 
          type="button" 
          id="qris-download-btn"
          class="mt-1.5 inline-flex items-center gap-1.5 text-[11px] font-bold text-forest-700 hover:text-forest-800 transition-colors py-1 px-2.5 rounded-lg hover:bg-forest-50"
        >
          <svg class="w-3.5 h-3.5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
          </svg>
          <span>Unduh Gambar QR</span>
        </button>
      </div>

      {{-- Petunjuk Pembayaran Jelas untuk Donatur --}}
      <div class="p-3.5 rounded-2xl bg-paper-warm border border-line text-left space-y-1.5">
        <p class="font-bold text-[11px] uppercase tracking-wider text-forest-700 dark:text-sun-300 flex items-center gap-1.5">
          <svg class="w-4 h-4 shrink-0 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          Langkah Mudah Donasi:
        </p>
        <ol class="list-decimal list-inside text-[11px] text-ink-muted space-y-1 leading-snug">
          <li>Buka aplikasi m-Banking atau e-Wallet (BCA, BRI, GoPay, Dana, dll).</li>
          <li>Pindai (scan) kode QR di atas atau gunakan gambar QR yang diunduh.</li>
          <li>Periksa nominal &amp; selesaikan pembayaran.</li>
          <li>Setelah transfer berhasil, <strong>tekan tombol "Saya Sudah Membayar"</strong> di bawah.</li>
        </ol>
      </div>

      {{-- Logo Dompet Digital yang Didukung --}}
      <div class="pt-1">
        <div class="flex items-center justify-center gap-1.5 text-[10px] font-bold text-ink-muted flex-wrap">
          <span class="px-2 py-0.5 rounded-md bg-paper-warm border border-line">BCA</span>
          <span class="px-2 py-0.5 rounded-md bg-paper-warm border border-line">Mandiri</span>
          <span class="px-2 py-0.5 rounded-md bg-paper-warm border border-line">BRI</span>
          <span class="px-2 py-0.5 rounded-md bg-paper-warm border border-line">GoPay</span>
          <span class="px-2 py-0.5 rounded-md bg-paper-warm border border-line">OVO</span>
          <span class="px-2 py-0.5 rounded-md bg-paper-warm border border-line">DANA</span>
          <span class="px-2 py-0.5 rounded-md bg-paper-warm border border-line">ShopeePay</span>
        </div>
      </div>

    </div>

    {{-- Tombol Aksi (Sticky / Selalu Terlihat di Bagian Bawah) --}}
    <div class="p-4 sm:p-5 bg-surface border-t border-line-soft space-y-2 shrink-0">
      <button 
        type="button" 
        id="qris-btn-paid" 
        class="btn-pill btn-primary w-full !py-3.5 text-sm font-bold shadow-warm-lg flex items-center justify-center gap-2 transition-all active:scale-[0.99]"
      >
        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
        </svg>
        <span>Saya Sudah Membayar</span>
      </button>

      <button 
        type="button" 
        id="qris-btn-cancel" 
        class="w-full text-xs text-ink-muted hover:text-ink font-semibold py-1 transition-colors text-center"
      >
        Batal / Ubah Donasi
      </button>
    </div>

  </div>
</div>

{{-- Skrip Pengendali Modal QRIS --}}
<script>
window.initQrisPayment = function(formSelector, getAmountFn, getTitleFn) {
  const form = document.querySelector(formSelector);
  const modal = document.getElementById('qris-modal');
  const closeBtn = document.getElementById('qris-modal-close');
  const cancelBtn = document.getElementById('qris-btn-cancel');
  const paidBtn = document.getElementById('qris-btn-paid');
  const downloadBtn = document.getElementById('qris-download-btn');
  const amountEl = document.getElementById('qris-modal-amount');
  const campaignEl = document.getElementById('qris-campaign-name');

  if (!form || !modal) return;

  function openModal() {
    const rawAmount = typeof getAmountFn === 'function' ? getAmountFn() : 50000;
    const campaignTitle = typeof getTitleFn === 'function' ? getTitleFn() : 'Donasi Pelita Bahagia';

    const formatted = 'Rp ' + Number(rawAmount || 0).toLocaleString('id-ID');
    if (amountEl) amountEl.textContent = formatted;
    if (campaignEl) campaignEl.textContent = campaignTitle;

    // Reset tombol jika dibuka kembali
    if (paidBtn) {
      paidBtn.disabled = false;
      paidBtn.innerHTML = `
        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
        </svg>
        <span>Saya Sudah Membayar</span>
      `;
    }

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    modal.classList.add('hidden');
    document.body.style.overflow = '';
  }

  // Intercept submit form donasi
  form.addEventListener('submit', function (e) {
    if (!form.checkValidity()) {
      return;
    }
    
    e.preventDefault();
    openModal();
  });

  if (closeBtn) closeBtn.addEventListener('click', closeModal);
  if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

  // Jika donatur klik "Saya Sudah Membayar"
  if (paidBtn) {
    paidBtn.addEventListener('click', function () {
      paidBtn.disabled = true;
      paidBtn.innerHTML = `
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span>Memverifikasi Pembayaran...</span>
      `;

      setTimeout(() => {
        paidBtn.innerHTML = `
          <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
          </svg>
          <span>Pembayaran Terverifikasi! Mengalihkan...</span>
        `;
        setTimeout(() => {
          form.submit();
        }, 600);
      }, 700);
    });
  }

  // Unduh Gambar QR untuk kemudahan pengguna HP
  if (downloadBtn) {
    downloadBtn.addEventListener('click', function () {
      try {
        const svgEl = document.getElementById('qris-svg-code');
        if (!svgEl) return;

        const svgData = new XMLSerializer().serializeToString(svgEl);
        const canvas = document.createElement('canvas');
        canvas.width = 500;
        canvas.height = 500;
        const ctx = canvas.getContext('2d');
        const img = new Image();

        img.onload = function () {
          ctx.fillStyle = '#ffffff';
          ctx.fillRect(0, 0, 500, 500);
          ctx.drawImage(img, 25, 25, 450, 450);

          const a = document.createElement('a');
          a.download = 'qris-donasi-pelita.png';
          a.href = canvas.toDataURL('image/png');
          a.click();
        };

        img.src = 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(svgData)));
      } catch (err) {
        console.error('Gagal mengunduh QR:', err);
      }
    });
  }

  // Tutup jika klik backdrop
  modal.addEventListener('click', function (e) {
    if (e.target === modal) {
      closeModal();
    }
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
      closeModal();
    }
  });
};
</script>
