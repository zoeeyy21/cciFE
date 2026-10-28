@extends('layouts.app')

@section('content')

{{-- Header Galeri --}}
<section class="pt-24 sm:pt-28 pb-12 sm:pb-16 bg-gradient-to-b from-paper-warm via-paper-warm/80 to-paper text-center">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-bold text-ink tracking-tight">
      Momen <span class="italic text-accent-primary">& Senyuman</span>
    </h1>
    <p class="mt-3 sm:mt-5 text-sm sm:text-base text-ink-muted leading-relaxed max-w-2xl mx-auto">
      Rekaman visual kehangatan para relawan, pembangunan ruang belajar, dan binar bahagia anak-anak penerima manfaat.
    </p>

    <div class="mt-6 flex items-center justify-center gap-2 text-xs text-ink-muted">
      <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface border border-line shadow-warm-sm">
        <svg class="w-3.5 h-3.5 text-accent-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <span>Total <strong id="gallery-total-count" class="text-ink">0</strong> Foto Dokumentasi</span>
      </span>
      <span class="text-ink-light">•</span>
      <span class="text-ink-muted text-[11px]">Klik foto untuk melihat resolusi penuh</span>
    </div>
  </div>
</section>

{{-- Grid Galeri: 4 Kolom x 2 Baris (8 kartu per halaman) --}}
<section class="py-12 sm:py-16 bg-paper" id="gallery-grid-section">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-stretch" id="gallery-container">
      @forelse($galleries ?? [] as $index => $gallery)
        <div 
          class="gallery-card bento-card group flex flex-col justify-between overflow-hidden cursor-pointer transition-all duration-300 hover:shadow-warm-lg hover:-translate-y-1"
          data-index="{{ $index }}"
          data-image="{{ asset('storage/'.$gallery->image) }}"
          data-title="{{ $gallery->activity_title ?: 'Dokumentasi Lapangan' }}"
          data-caption="{{ $gallery->caption }}"
        >
          <div>
            {{-- Media Preview (Foto / Thumbnail) --}}
            <div class="h-48 sm:h-52 overflow-hidden relative bg-paper-warm">
              @if($gallery->image)
                <img 
                  src="{{ asset('storage/'.$gallery->image) }}" 
                  alt="{{ $gallery->caption ?? 'Galeri Pelita Bahagia' }}" 
                  class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-108"
                  loading="lazy"
                />
              @else
                <div class="w-full h-full bg-paper-warm flex items-center justify-center text-ink-light">
                  <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                  </svg>
                </div>
              @endif

              {{-- Hover State Overlay --}}
              <div class="absolute inset-0 bg-ink/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                <div class="w-10 h-10 rounded-full bg-black/70 text-white flex items-center justify-center shadow-lg transform scale-90 group-hover:scale-100 transition-transform">
                  <svg class="w-5 h-5 text-sun-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/>
                  </svg>
                </div>
              </div>

              {{-- Badge Indikator Media --}}
              <div class="absolute bottom-2.5 left-2.5">
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[9px] font-bold bg-black/60 text-white backdrop-blur-md">
                  <svg class="w-2.5 h-2.5 text-sun-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                  Foto
                </span>
              </div>
            </div>

            {{-- Struktur Kartu Galeri: Judul Kegiatan & Keterangan --}}
            <div class="p-5 bg-surface">
              {{-- 1. Judul Kegiatan --}}
              <h3 class="font-serif font-bold text-sm sm:text-base text-ink group-hover:text-accent-primary transition-colors leading-snug line-clamp-1 mb-1.5">
                {{ $gallery->activity_title ?: 'Dokumentasi Lapangan' }}
              </h3>

              {{-- 2. Keterangan / Caption --}}
              <p class="text-xs text-ink-muted leading-relaxed line-clamp-2">
                {{ $gallery->caption }}
              </p>
            </div>
          </div>

          {{-- Footer Card --}}
          <div class="px-5 pb-4 pt-1 bg-surface border-t border-line-soft flex items-center justify-between text-[11px] font-semibold text-accent-primary">
            <span>Perbesar Gambar</span>
            <span class="transition-transform group-hover:translate-x-0.5">&nearr;</span>
          </div>
        </div>
      @empty
        <div class="col-span-full p-8 sm:p-14 text-center rounded-3xl bg-surface border-2 border-dashed border-line">
          <p class="font-serif text-lg sm:text-xl font-bold text-ink">Galeri masih kosong</p>
        </div>
      @endforelse
    </div>

    {{-- Navigasi Pagination: Bawah Tengah Kontainer Grid --}}
    <div id="gallery-pagination" class="mt-12 sm:mt-16 flex items-center justify-center gap-2 flex-wrap">
      {{-- Dirender otomatis oleh skrip di bawah --}}
    </div>

  </div>
</section>

{{-- Lightbox Modal Resolusi Penuh --}}
<div 
  id="gallery-lightbox" 
  class="fixed inset-0 z-50 hidden bg-black/90 backdrop-blur-md flex items-center justify-center p-3 sm:p-6 transition-opacity duration-300"
  role="dialog"
  aria-modal="true"
  aria-label="Tampilan Penuh Media"
>
  {{-- Close Button --}}
  <button 
    type="button" 
    id="lightbox-close" 
    class="absolute top-4 right-4 sm:top-6 sm:right-6 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all z-20 focus:outline-none"
    title="Tutup (Esc)"
  >
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg>
  </button>

  {{-- Lightbox Content Container --}}
  <div class="relative max-w-4xl w-full max-h-[90vh] flex flex-col items-center justify-center" id="lightbox-container">
    <div class="w-full overflow-hidden rounded-2xl bg-black/40 flex items-center justify-center relative shadow-2xl">
      <img 
        id="lightbox-image" 
        src="" 
        alt="" 
        class="max-h-[70vh] w-auto max-w-full object-contain mx-auto transition-transform duration-300"
      />
    </div>

    {{-- Keterangan di Bawah Gambar --}}
    <div class="w-full mt-4 p-4 sm:p-5 rounded-2xl bg-white/10 text-white border border-white/15 backdrop-blur-md">
      <h3 id="lightbox-title" class="font-serif font-bold text-base sm:text-lg text-sun-300 leading-snug"></h3>
      <p id="lightbox-caption" class="text-xs sm:text-sm text-forest-100/90 mt-1.5 leading-relaxed"></p>
    </div>
  </div>
</div>

{{-- Script Pagination (8 slot/halaman) & Lightbox Modal --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
  const ITEMS_PER_PAGE = 8;
  const cards = Array.from(document.querySelectorAll('.gallery-card'));
  const totalCountEl = document.getElementById('gallery-total-count');
  const paginationContainer = document.getElementById('gallery-pagination');
  const gridSection = document.getElementById('gallery-grid-section');

  // Lightbox elements
  const lightbox = document.getElementById('gallery-lightbox');
  const lightboxClose = document.getElementById('lightbox-close');
  const lightboxImage = document.getElementById('lightbox-image');
  const lightboxTitle = document.getElementById('lightbox-title');
  const lightboxCaption = document.getElementById('lightbox-caption');

  let currentPage = 1;

  if (totalCountEl) {
    totalCountEl.textContent = cards.length;
  }

  // Render halaman & pagination
  function render(scrollUp = false) {
    const totalPages = Math.ceil(cards.length / ITEMS_PER_PAGE) || 1;

    if (currentPage > totalPages) {
      currentPage = 1;
    }

    const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
    const endIndex = startIndex + ITEMS_PER_PAGE;

    cards.forEach((c, index) => {
      if (index >= startIndex && index < endIndex) {
        c.style.display = 'flex';
      } else {
        c.style.display = 'none';
      }
    });

    renderPagination(totalPages);

    if (scrollUp) {
      gridSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }

  function renderPagination(totalPages) {
    paginationContainer.innerHTML = '';

    if (totalPages <= 1) {
      return;
    }

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

    // Nomor Halaman [1] [2]...
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

  // Lightbox Modal Logic
  function openLightbox(card) {
    const src = card.dataset.image;
    const title = card.dataset.title;
    const caption = card.dataset.caption;

    lightboxImage.src = src;
    lightboxImage.alt = caption;
    lightboxTitle.textContent = title;
    lightboxCaption.textContent = caption;

    lightbox.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    lightbox.classList.add('hidden');
    lightboxImage.src = '';
    document.body.style.overflow = '';
  }

  cards.forEach(card => {
    card.addEventListener('click', function () {
      openLightbox(this);
    });
  });

  if (lightboxClose) {
    lightboxClose.addEventListener('click', closeLightbox);
  }

  if (lightbox) {
    lightbox.addEventListener('click', function (e) {
      if (e.target === lightbox) {
        closeLightbox();
      }
    });
  }

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !lightbox.classList.contains('hidden')) {
      closeLightbox();
    }
  });

  render(false);
});
</script>

@endsection
