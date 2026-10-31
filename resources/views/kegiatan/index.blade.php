@extends('layouts.app')

@section('content')

{{-- Header Kegiatan --}}
<section class="pt-24 sm:pt-28 pb-12 sm:pb-16 bg-gradient-to-b from-paper-warm via-paper-warm/80 to-paper text-center">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-bold text-ink tracking-tight">
      Kegiatan Yayasan
    </h1>
    <p class="mt-3 sm:mt-5 text-sm sm:text-base text-ink-muted leading-relaxed max-w-2xl mx-auto">
      Dokumentasi terperinci aksi nyata para relawan dan penyaluran bantuan di desa-desa binaan.
    </p>

    {{-- Search Bar Khusus Kegiatan --}}
    <div class="mt-8 sm:mt-10 max-w-xl mx-auto">
      <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-4 sm:pl-5 flex items-center pointer-events-none text-ink-muted">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </div>
        <input 
          type="text" 
          id="activity-search" 
          placeholder="Cari nama kegiatan atau lokasi..." 
          class="w-full pl-11 sm:pl-12 pr-10 py-3 sm:py-3.5 rounded-full bg-surface border border-line shadow-warm-sm text-sm text-ink placeholder-ink-muted focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-transparent transition-all"
        />
        <button 
          id="activity-search-clear" 
          type="button" 
          class="hidden absolute inset-y-0 right-0 pr-4 flex items-center text-ink-muted hover:text-ink transition-colors"
          title="Hapus pencarian"
        >
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
      <p class="text-[11px] text-ink-muted mt-2 text-center">
        Menampilkan total <span id="activity-total-count" class="font-bold text-ink">0</span> kegiatan lapangan
      </p>
    </div>
  </div>
</section>

{{-- Grid Kegiatan: 4 Kolom x 2 Baris (8 kartu per halaman) --}}
<section class="py-12 sm:py-16 bg-paper" id="activity-grid-section">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-stretch" id="activities-container">
      @forelse($activities ?? [] as $activity)
        <a 
          href="{{ url('/kegiatan/'.$activity->slug) }}" 
          class="activity-card bento-card group flex flex-col justify-between overflow-hidden transition-all duration-300 hover:shadow-warm-lg"
          data-title="{{ strtolower($activity->title) }}"
          data-location="{{ strtolower($activity->location ?? '') }}"
          data-program="{{ strtolower($activity->program_name ?? '') }}"
        >
          <div>
            {{-- Thumbnail Kegiatan --}}
            @if($activity->cover)
              <div class="h-44 sm:h-48 overflow-hidden relative bg-paper-warm">
                <img 
                  src="{{ asset('storage/'.$activity->cover) }}" 
                  alt="{{ $activity->title }}" 
                  class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                  loading="lazy"
                />
                <div class="absolute bottom-3 left-3">
                  <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-black/70 text-white backdrop-blur-md">
                    <svg class="w-3 h-3 text-sun-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ \Carbon\Carbon::parse($activity->date ?? now())->format('d M Y') }}
                  </span>
                </div>
              </div>
            @else
              <div class="h-44 sm:h-48 bg-paper-warm flex flex-col items-center justify-center p-6 border-b border-line-soft text-center relative">
                <div class="w-12 h-12 rounded-2xl bg-surface border border-line flex items-center justify-center text-accent-forest font-serif font-bold text-lg mb-1">
                  🌿
                </div>
                <span class="text-[11px] font-medium text-ink-muted">Catatan Relawan</span>
                <div class="absolute bottom-3 left-3">
                  <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-surface/90 border border-line text-ink backdrop-blur-md">
                    {{ \Carbon\Carbon::parse($activity->date ?? now())->format('d M Y') }}
                  </span>
                </div>
              </div>
            @endif

            {{-- Isi Informasi Kegiatan Lapangan Secara Lugas --}}
            <div class="p-5 sm:p-6">
              {{-- Nama Kegiatan --}}
              <h3 class="font-serif font-bold text-base sm:text-lg text-ink group-hover:text-accent-primary transition-colors leading-snug line-clamp-2">
                {{ $activity->title }}
              </h3>

              {{-- Info Lokasi Pelaksanaan --}}
              @if(!empty($activity->location))
                <div class="mt-2.5 pt-2 border-t border-line-soft">
                  <div class="flex items-center gap-1.5 text-[11px] text-ink-muted">
                    <svg class="w-3.5 h-3.5 text-accent-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="truncate">{{ $activity->location }}</span>
                  </div>
                </div>
              @endif

              {{-- Ringkasan --}}
              <p class="text-xs sm:text-sm text-ink-muted mt-2.5 line-clamp-2 leading-relaxed">
                {{ $activity->summary }}
              </p>
            </div>
          </div>

          {{-- Footer Link --}}
          <div class="px-5 sm:px-6 pb-5 sm:pb-6 pt-2 border-t border-line-soft flex items-center justify-between text-xs font-bold text-accent-primary group-hover:translate-x-0.5 transition-transform">
            <span>Baca Laporan Kegiatan</span>
            <span>&rarr;</span>
          </div>
        </a>
      @empty
        <div class="col-span-full p-8 sm:p-14 text-center rounded-3xl bg-surface border-2 border-dashed border-line">
          <p class="font-serif text-lg sm:text-xl font-bold text-ink">Belum ada catatan kegiatan</p>
        </div>
      @endforelse
    </div>

    {{-- State Kosong Pencarian --}}
    <div id="no-activity-results" class="hidden py-16 px-4 text-center rounded-3xl bg-surface border border-line shadow-warm-sm max-w-xl mx-auto my-8">
      <div class="w-14 h-14 rounded-2xl bg-paper-warm border border-line flex items-center justify-center mx-auto text-ink-muted mb-4">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
      </div>
      <h3 class="font-serif font-bold text-lg text-ink">Tidak ditemukan kegiatan terkait</h3>
      <p class="text-xs sm:text-sm text-ink-muted mt-1 max-w-sm mx-auto">
        Silakan coba dengan kata kunci lain seperti nama desa, kota, atau nama program.
      </p>
      <button 
        type="button" 
        id="btn-reset-activity-search" 
        class="mt-5 btn-pill btn-outline text-xs !py-2 !px-5 font-bold"
      >
        Hapus Pencarian
      </button>
    </div>

    {{-- Navigasi Pagination: Bawah Tengah Kontainer Grid --}}
    <div id="activity-pagination" class="mt-12 sm:mt-16 flex items-center justify-center gap-2 flex-wrap">
      {{-- Dirender otomatis oleh JS --}}
    </div>

  </div>
</section>

{{-- Script Controller Pencarian & Pagination (8 item per halaman, 4x2 grid) --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
  const ITEMS_PER_PAGE = 8;
  const cards = Array.from(document.querySelectorAll('.activity-card'));
  const searchInput = document.getElementById('activity-search');
  const clearBtn = document.getElementById('activity-search-clear');
  const totalCountEl = document.getElementById('activity-total-count');
  const paginationContainer = document.getElementById('activity-pagination');
  const noResultsBlock = document.getElementById('no-activity-results');
  const resetBtn = document.getElementById('btn-reset-activity-search');
  const gridSection = document.getElementById('activity-grid-section');

  let currentSearch = '';
  let currentPage = 1;

  if (totalCountEl) {
    totalCountEl.textContent = cards.length;
  }

  function getFilteredCards() {
    if (!currentSearch) return cards;
    return cards.filter(card => {
      const title = card.dataset.title || '';
      const location = card.dataset.location || '';
      const program = card.dataset.program || '';
      return title.includes(currentSearch) || location.includes(currentSearch) || program.includes(currentSearch);
    });
  }

  function render(scrollUp = false) {
    const matched = getFilteredCards();
    const totalPages = Math.ceil(matched.length / ITEMS_PER_PAGE) || 1;

    if (currentPage > totalPages) {
      currentPage = 1;
    }

    const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
    const endIndex = startIndex + ITEMS_PER_PAGE;

    cards.forEach(c => c.style.display = 'none');

    matched.slice(startIndex, endIndex).forEach(c => {
      c.style.display = 'flex';
    });

    if (matched.length === 0) {
      noResultsBlock.classList.remove('hidden');
      paginationContainer.classList.add('hidden');
    } else {
      noResultsBlock.classList.add('hidden');
      paginationContainer.classList.remove('hidden');
      renderPagination(totalPages);
    }

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

  // Events
  searchInput.addEventListener('input', function () {
    currentSearch = this.value.trim().toLowerCase();
    clearBtn.classList.toggle('hidden', currentSearch.length === 0);
    currentPage = 1;
    render(false);
  });

  clearBtn.addEventListener('click', function () {
    searchInput.value = '';
    currentSearch = '';
    clearBtn.classList.add('hidden');
    currentPage = 1;
    render(false);
    searchInput.focus();
  });

  if (resetBtn) {
    resetBtn.addEventListener('click', function () {
      searchInput.value = '';
      currentSearch = '';
      clearBtn.classList.add('hidden');
      currentPage = 1;
      render(false);
    });
  }

  render(false);
});
</script>

@endsection
