@extends('layouts.app')

@section('content')

{{-- Header Program --}}
<section class="pt-24 sm:pt-28 pb-12 sm:pb-16 bg-gradient-to-b from-paper-warm via-paper-warm/80 to-paper text-center">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-bold text-ink tracking-tight">
      Program <span class="italic text-accent-primary">Kebaikan</span>
    </h1>
    <p class="mt-3 sm:mt-5 text-sm sm:text-base text-ink-muted leading-relaxed max-w-2xl mx-auto">
      Daftar program terencana untuk menjangkau anak-anak dan keluarga di pelosok negeri secara berkelanjutan.
    </p>

    {{-- Filter & Pencarian Program --}}
    <div class="mt-8 sm:mt-10 max-w-2xl mx-auto space-y-4">
      {{-- Search Bar --}}
      <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-4 sm:pl-5 flex items-center pointer-events-none text-ink-muted">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </div>
        <input 
          type="text" 
          id="program-search" 
          placeholder="Cari nama program atau kategori bantuan..." 
          class="w-full pl-11 sm:pl-12 pr-10 py-3 sm:py-3.5 rounded-full bg-surface border border-line shadow-warm-sm text-sm text-ink placeholder-ink-muted focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
        />
        <button 
          id="program-search-clear" 
          type="button" 
          class="hidden absolute inset-y-0 right-0 pr-4 flex items-center text-ink-muted hover:text-ink transition-colors"
          title="Hapus pencarian"
        >
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>

      {{-- Chip Filter Status Program --}}
      <div class="flex items-center justify-center gap-2 flex-wrap pt-1" id="status-filter-container">
        <button 
          type="button" 
          data-status="all" 
          class="status-chip active px-4 py-1.5 rounded-full text-xs font-semibold tracking-wide transition-all duration-200 bg-primary-500 text-white shadow-warm"
        >
          Semua (<span id="count-all">0</span>)
        </button>
        <button 
          type="button" 
          data-status="aktif" 
          class="status-chip px-4 py-1.5 rounded-full text-xs font-semibold tracking-wide transition-all duration-200 bg-surface border border-line text-ink-muted hover:text-ink hover:bg-paper-warm"
        >
          Aktif (<span id="count-aktif">0</span>)
        </button>
        <button 
          type="button" 
          data-status="non-aktif" 
          class="status-chip px-4 py-1.5 rounded-full text-xs font-semibold tracking-wide transition-all duration-200 bg-surface border border-line text-ink-muted hover:text-ink hover:bg-paper-warm"
        >
          Non-Aktif (<span id="count-nonaktif">0</span>)
        </button>
      </div>
    </div>
  </div>
</section>

{{-- Program Grid Section --}}
<section class="py-12 sm:py-16 bg-paper" id="program-grid-section">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">

    {{-- Grid 4 Kolom x 2 Baris (8 kartu per halaman) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-stretch" id="programs-container">
      @forelse($programs ?? [] as $program)
        @php
          $isAktif = strtolower($program->status ?? 'aktif') === 'aktif';
          $statusKey = $isAktif ? 'aktif' : 'non-aktif';
        @endphp
        <div 
          class="program-card bento-card flex flex-col justify-between group overflow-hidden transition-all duration-300 hover:shadow-warm-lg"
          data-name="{{ strtolower($program->name) }}"
          data-category="{{ strtolower($program->category ?? '') }}"
          data-status="{{ $statusKey }}"
        >
          <div>
            {{-- 1. Thumbnail / Ikon Program --}}
            @if($program->image)
              <div class="h-44 sm:h-48 overflow-hidden relative bg-paper-warm">
                <img 
                  src="{{ asset('storage/'.$program->image) }}" 
                  alt="{{ $program->name }}" 
                  class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                  loading="lazy"
                />
                {{-- Status Badge di atas foto --}}
                <div class="absolute top-3 right-3">
                  @if($isAktif)
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-white/95 dark:bg-surface/95 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800 shadow-warm-sm backdrop-blur-md">
                      <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                      Aktif
                    </span>
                  @else
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-white/95 dark:bg-surface/95 text-stone-600 dark:text-stone-300 border border-stone-200 dark:border-stone-700 shadow-warm-sm backdrop-blur-md">
                      <span class="w-1.5 h-1.5 rounded-full bg-stone-400"></span>
                      Selesai
                    </span>
                  @endif
                </div>
              </div>
            @else
              <div class="h-44 sm:h-48 bg-gradient-to-tr from-forest-800 via-forest-900 to-forest-950 flex flex-col items-center justify-center text-white/50 relative p-4 text-center">
                <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center text-white font-serif font-bold text-xl mb-2">
                  {{ strtoupper(substr($program->name, 0, 1)) }}
                </div>
                <span class="text-xs font-serif font-medium text-white/70">{{ $program->category }}</span>
                {{-- Status Badge --}}
                <div class="absolute top-3 right-3">
                  @if($isAktif)
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-white/20 text-white border border-white/20 backdrop-blur-md">
                      <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                      Aktif
                    </span>
                  @else
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-white/10 text-white/70 border border-white/10 backdrop-blur-md">
                      <span class="w-1.5 h-1.5 rounded-full bg-stone-400"></span>
                      Selesai
                    </span>
                  @endif
                </div>
              </div>
            @endif

            {{-- Isi Konten Kartu --}}
            <div class="p-5 sm:p-6">
              {{-- 2. Kategori / Periode --}}
              <div class="flex items-center gap-1.5 text-[11px] font-semibold text-ink-muted uppercase tracking-wider mb-2">
                <span class="text-accent-primary font-bold">{{ $program->category ?: 'Pendidikan' }}</span>
                @if(!empty($program->period))
                  <span>•</span>
                  <span>{{ $program->period }}</span>
                @endif
              </div>

              {{-- 3. Judul Program --}}
              <h3 class="font-serif font-bold text-base sm:text-lg text-ink group-hover:text-accent-primary transition-colors leading-snug line-clamp-2">
                <a href="{{ url('/program/'.$program->slug) }}">
                  {{ $program->name }}
                </a>
              </h3>

              {{-- Ringkasan Program --}}
              <p class="text-xs sm:text-sm text-ink-muted mt-2 line-clamp-2 leading-relaxed">
                {{ $program->summary }}
              </p>
            </div>
          </div>

          {{-- 4. Tombol Detail (Target Capaian sudah dihilangkan) --}}
          <div class="px-5 sm:px-6 pb-5 sm:pb-6 pt-3 border-t border-line-soft flex items-center justify-between mt-2">
            <a 
              href="{{ url('/program/'.$program->slug) }}" 
              class="text-xs font-bold text-accent-primary group-hover:translate-x-0.5 transition-transform flex items-center gap-1"
            >
              <span>Detail Program</span>
              <span>&rarr;</span>
            </a>
            @if($isAktif)
              <a 
                href="{{ url('/donasi/'.$program->slug) }}" 
                class="btn-pill btn-primary !py-1.5 !px-3.5 !text-xs font-semibold shadow-sm"
              >
                Dukung
              </a>
            @else
              <button 
                type="button" 
                disabled 
                class="btn-pill !py-1.5 !px-3.5 !text-xs font-semibold bg-line text-ink-muted/50 border border-line cursor-not-allowed opacity-60"
                title="Program telah selesai / non-aktif"
              >
                Dukung
              </button>
            @endif
          </div>
        </div>
      @empty
        <div class="col-span-full p-8 sm:p-14 text-center rounded-3xl bg-surface border-2 border-dashed border-line">
          <p class="font-serif text-lg sm:text-xl font-bold text-ink">Belum ada program terdaftar</p>
        </div>
      @endforelse
    </div>

    {{-- State Kosong Pencarian / Filter --}}
    <div id="no-program-results" class="hidden py-16 px-4 text-center rounded-3xl bg-surface border border-line shadow-warm-sm max-w-xl mx-auto my-8">
      <div class="w-14 h-14 rounded-2xl bg-paper-warm border border-line flex items-center justify-center mx-auto text-ink-muted mb-4">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
      </div>
      <h3 class="font-serif font-bold text-lg text-ink">Tidak ada program yang sesuai</h3>
      <p class="text-xs sm:text-sm text-ink-muted mt-1 max-w-sm mx-auto">
        Coba ganti kata kunci pencarian atau ubah filter status program di atas.
      </p>
      <button 
        type="button" 
        id="btn-reset-filters" 
        class="mt-5 btn-pill btn-outline text-xs !py-2 !px-5 font-bold"
      >
        Reset Filter & Pencarian
      </button>
    </div>

    {{-- Navigasi Pagination: Bawah Tengah Kontainer Grid --}}
    <div id="program-pagination" class="mt-12 sm:mt-16 flex items-center justify-center gap-2 flex-wrap">
      {{-- Akan dirender otomatis oleh skrip di bawah --}}
    </div>

  </div>
</section>

{{-- Script Controller Filter, Pencarian, & Pagination (8 item per halaman, 4x2 grid) --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
  const ITEMS_PER_PAGE = 8;
  const cards = Array.from(document.querySelectorAll('.program-card'));
  const searchInput = document.getElementById('program-search');
  const clearBtn = document.getElementById('program-search-clear');
  const statusChips = Array.from(document.querySelectorAll('.status-chip'));
  const paginationContainer = document.getElementById('program-pagination');
  const noResultsBlock = document.getElementById('no-program-results');
  const resetBtn = document.getElementById('btn-reset-filters');
  const gridSection = document.getElementById('program-grid-section');

  let currentStatus = 'all';
  let currentSearch = '';
  let currentPage = 1;

  // Hitung jumlah item untuk chip badge
  function updateCounts() {
    const total = cards.length;
    const aktif = cards.filter(c => c.dataset.status === 'aktif').length;
    const nonaktif = cards.filter(c => c.dataset.status === 'non-aktif').length;

    const countAllEl = document.getElementById('count-all');
    const countAktifEl = document.getElementById('count-aktif');
    const countNonaktifEl = document.getElementById('count-nonaktif');

    if (countAllEl) countAllEl.textContent = total;
    if (countAktifEl) countAktifEl.textContent = aktif;
    if (countNonaktifEl) countNonaktifEl.textContent = nonaktif;
  }

  // Filter kartu
  function getFilteredCards() {
    return cards.filter(card => {
      const matchStatus = (currentStatus === 'all') || (card.dataset.status === currentStatus);
      const name = card.dataset.name || '';
      const category = card.dataset.category || '';
      const matchSearch = !currentSearch || name.includes(currentSearch) || category.includes(currentSearch);
      return matchStatus && matchSearch;
    });
  }

  // Render halaman & pagination
  function render(scrollUp = false) {
    const matched = getFilteredCards();
    const totalPages = Math.ceil(matched.length / ITEMS_PER_PAGE) || 1;

    if (currentPage > totalPages) {
      currentPage = 1;
    }

    const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
    const endIndex = startIndex + ITEMS_PER_PAGE;

    // Sembunyikan semua kartu terlebih dahulu
    cards.forEach(c => c.style.display = 'none');

    // Tampilkan hanya kartu di halaman saat ini
    matched.slice(startIndex, endIndex).forEach(c => {
      c.style.display = 'flex';
    });

    // Tangani kondisi kosong
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

  // Render tombol navigasi pagination [Previous] [1] [2]... [Next]
  function renderPagination(totalPages) {
    paginationContainer.innerHTML = '';

    if (totalPages <= 1) {
      return; // Tidak perlu pagination jika hanya 1 halaman
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

  // Event Listeners Pencarian
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

  // Event Listeners Chip Filter
  statusChips.forEach(chip => {
    chip.addEventListener('click', function () {
      statusChips.forEach(c => {
        c.classList.remove('bg-primary-500', 'text-white', 'shadow-warm');
        c.classList.add('bg-surface', 'border', 'border-line', 'text-ink-muted');
      });
      this.classList.remove('bg-surface', 'border', 'border-line', 'text-ink-muted');
      this.classList.add('bg-primary-500', 'text-white', 'shadow-warm');

      currentStatus = this.dataset.status;
      currentPage = 1;
      render(false);
    });
  });

  // Tombol Reset
  if (resetBtn) {
    resetBtn.addEventListener('click', function () {
      searchInput.value = '';
      currentSearch = '';
      clearBtn.classList.add('hidden');

      const allChip = statusChips.find(c => c.dataset.status === 'all');
      if (allChip) allChip.click();
    });
  }

  // Inisialisasi awal
  updateCounts();
  render(false);
});
</script>

@endsection
