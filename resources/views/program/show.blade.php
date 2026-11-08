@extends('layouts.app')

@section('content')

{{-- Header Detail Program --}}
<section class="pt-28 pb-14 bg-gradient-to-b from-paper-warm to-paper">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <a href="{{ url('/program') }}" class="inline-flex items-center gap-2 text-xs font-bold text-ink-muted hover:text-accent-primary transition-colors mb-6">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      Kembali ke Seluruh Program
    </a>
    <div class="flex items-center gap-3 mb-3">
      @php
        $isAktif = strtolower($program->status ?? 'aktif') === 'aktif';
      @endphp
      @if($isAktif)
        <span class="badge-pill bg-tint-primary text-accent-primary border border-tint-primary-line text-[10px]">
          {{ $program->status ?? 'Aktif' }}
        </span>
        <span class="text-xs text-ink-muted">&bull; Target Terbuka</span>
      @else
        <span class="badge-pill bg-stone-100 text-stone-600 border border-stone-200 text-[10px]">
          {{ $program->status ?? 'Non-Aktif' }}
        </span>
        <span class="text-xs text-ink-muted">&bull; Program Telah Selesai</span>
      @endif
    </div>
    <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-ink leading-tight">
      {{ $program->name ?? 'Detail Program Bantuan' }}
    </h1>
  </div>
</section>

{{-- Content Body --}}
<section class="py-12 bg-surface border-y border-line/60">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    
    @php
      $photos = [];
      $seen = [];

      // 1. Cover / Image program sebagai foto utama jika ada
      if (!empty($program->image)) {
          $photos[] = [
              'image' => $program->image,
              'caption' => $program->name,
          ];
          $seen[$program->image] = true;
      }

      // 2. Kumpulan foto dokumentasi galeri program jika ada
      if (!empty($program->gallery) && (is_array($program->gallery) || is_iterable($program->gallery))) {
          foreach ($program->gallery as $item) {
              $img = is_array($item) ? ($item['image'] ?? null) : ($item->image ?? null);
              $cap = is_array($item) ? ($item['caption'] ?? '') : ($item->caption ?? '');
              if ($img && !isset($seen[$img])) {
                  $photos[] = [
                      'image' => $img,
                      'caption' => $cap ?: $program->name,
                  ];
                  $seen[$img] = true;
              }
          }
      }

      // 3. Sertakan juga foto-foto dokumentasi dari kegiatan yang terafiliasi dengan program ini
      if (!empty($relatedActivities)) {
          foreach ($relatedActivities as $act) {
              if (!empty($act->cover) && !isset($seen[$act->cover])) {
                  $photos[] = [
                      'image' => $act->cover,
                      'caption' => $act->title,
                  ];
                  $seen[$act->cover] = true;
              }
              if (!empty($act->gallery) && (is_array($act->gallery) || is_iterable($act->gallery))) {
                  foreach ($act->gallery as $gItem) {
                      $gImg = is_array($gItem) ? ($gItem['image'] ?? null) : ($gItem->image ?? null);
                      $gCap = is_array($gItem) ? ($gItem['caption'] ?? '') : ($gItem->caption ?? '');
                      if ($gImg && !isset($seen[$gImg])) {
                          $photos[] = [
                              'image' => $gImg,
                              'caption' => $gCap ?: $act->title,
                          ];
                          $seen[$gImg] = true;
                      }
                  }
              }
          }
      }
    @endphp

    {{-- Media Carousel / Slider & Lightbox Trigger --}}
    @if(count($photos) > 0)
      <div class="mb-12">
        <div class="relative rounded-3xl overflow-hidden shadow-warm-lg border border-line/60 bg-black/90 group" id="program-slider">

          {{-- Main Slide Display Container --}}
          <div class="relative w-full h-[320px] sm:h-[420px] md:h-[480px] overflow-hidden cursor-zoom-in" id="prog-slider-main-track" title="Klik foto untuk melihat layar penuh">
            @foreach($photos as $index => $photo)
              <div 
                class="prog-slide-item absolute inset-0 transition-opacity duration-500 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 pointer-events-none z-0' }}" 
                data-index="{{ $index }}"
              >
                <img 
                  src="{{ asset('storage/'.$photo['image']) }}" 
                  alt="{{ $photo['caption'] }}" 
                  class="w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                  loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                />
              </div>
            @endforeach

            {{-- Click to Expand Hint Pill (Top Right) --}}
            <button 
              type="button" 
              id="prog-btn-open-lightbox" 
              class="absolute top-4 right-4 z-20 badge-pill bg-black/60 hover:bg-black/85 text-white border border-white/20 text-xs backdrop-blur-md flex items-center gap-1.5 transition-all shadow-lg hover:scale-105"
              title="Buka Layar Penuh"
            >
              <svg class="w-3.5 h-3.5 text-sun-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
              </svg>
              <span>Layar Penuh</span>
            </button>

            {{-- Floating Caption & Counter (Bottom Bar) --}}
            <div class="absolute inset-x-0 bottom-0 z-20 p-4 sm:p-5 bg-gradient-to-t from-black/85 via-black/50 to-transparent pointer-events-none">
              <div class="flex items-end justify-between gap-3">
                <p id="prog-slider-caption" class="text-xs sm:text-sm text-white/95 font-medium leading-relaxed line-clamp-2 max-w-2xl drop-shadow">
                  {{ $photos[0]['caption'] ?? $program->name }}
                </p>
                @if(count($photos) > 1)
                  <span id="prog-slider-counter" class="shrink-0 badge-pill bg-white/20 text-white border border-white/30 text-[11px] font-mono px-2.5 py-0.5 backdrop-blur-md">
                    1 / {{ count($photos) }}
                  </span>
                @endif
              </div>
            </div>
          </div>

          {{-- Navigation Arrows (hanya muncul bila foto > 1) --}}
          @if(count($photos) > 1)
            {{-- Prev Button --}}
            <button 
              type="button" 
              id="prog-slider-prev" 
              class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white/85 hover:bg-white text-ink hover:text-accent-primary shadow-warm flex items-center justify-center transition-all duration-200 backdrop-blur-md hover:scale-110 active:scale-95"
              aria-label="Foto Sebelumnya"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </button>

            {{-- Next Button --}}
            <button 
              type="button" 
              id="prog-slider-next" 
              class="absolute right-3 sm:right-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white/85 hover:bg-white text-ink hover:text-accent-primary shadow-warm flex items-center justify-center transition-all duration-200 backdrop-blur-md hover:scale-110 active:scale-95"
              aria-label="Foto Selanjutnya"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </button>
          @endif

        </div>

        {{-- Mini Thumbnail Strip (bila foto > 1) --}}
        @if(count($photos) > 1)
          <div class="mt-3 flex items-center gap-2.5 overflow-x-auto pb-2 scrollbar-none px-1" id="prog-slider-thumbnails">
            @foreach($photos as $index => $photo)
              <button 
                type="button" 
                class="prog-thumb-item shrink-0 w-16 h-12 sm:w-20 sm:h-14 rounded-2xl overflow-hidden border-2 transition-all cursor-pointer {{ $index === 0 ? 'border-accent-primary ring-2 ring-accent-primary/30 scale-105' : 'border-line/70 opacity-60 hover:opacity-100 hover:border-line' }}" 
                data-index="{{ $index }}"
                title="{{ $photo['caption'] }}"
              >
                <img src="{{ asset('storage/'.$photo['image']) }}" alt="" class="w-full h-full object-cover"/>
              </button>
            @endforeach
          </div>
        @endif

      </div>
    @endif

    {{-- Highlight Box: Target & Goal --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-12">
      @if(isset($program->goal))
        <div class="p-6 rounded-3xl bg-tint-primary border border-tint-primary-line">
          <span class="text-xs font-bold text-accent-primary uppercase tracking-wider block mb-1">Target Utama</span>
          <p class="text-sm font-semibold text-ink leading-relaxed">{{ $program->goal }}</p>
        </div>
      @endif

      @if(isset($program->target))
        <div class="p-6 rounded-3xl bg-tint-forest border border-tint-forest-line">
          <span class="text-xs font-bold text-accent-forest uppercase tracking-wider block mb-1">Penerima Manfaat</span>
          <p class="text-sm font-semibold text-ink leading-relaxed">{{ $program->target }}</p>
        </div>
      @endif
    </div>

    {{-- Description Body --}}
    <div class="prose-content max-w-none text-ink-muted text-base leading-relaxed space-y-6">
      @if(isset($program->description) && trim(strip_tags($program->description)) !== '')
        {!! $program->description !!}
      @else
        <div class="p-6 sm:p-8 rounded-3xl bg-paper-warm border-2 border-dashed border-line text-center not-prose">
          <p class="font-serif text-base font-bold text-ink">Uraian program belum diisi</p>
          <p class="text-xs text-ink-muted mt-1.5 leading-relaxed">
            Tambahkan field <code class="px-1.5 py-0.5 rounded bg-surface border border-line text-[11px] font-mono text-accent-primary">'description'</code>
            pada file <code class="px-1.5 py-0.5 rounded bg-surface border border-line text-[11px] font-mono text-accent-primary">resources/data/programs.php</code>.
          </p>
        </div>
      @endif
    </div>

    {{-- Donation CTA Banner inside Program --}}
    @if($isAktif)
      <div class="mt-14 p-8 sm:p-10 rounded-3xl bg-gradient-to-br from-forest-900 to-forest-950 text-white flex flex-col sm:flex-row items-center justify-between gap-6 shadow-warm-lg">
        <div>
          <span class="badge-pill bg-forest-800 text-sun-300 border border-forest-700 text-[10px] mb-2">Ayo Terlibat</span>
          <h3 class="font-serif font-bold text-2xl text-white">Dukung Kelangsungan Program Ini</h3>
          <p class="text-xs text-forest-200/80 mt-1 max-w-md">Donasi Anda disalurkan 100% untuk operasional dan pengadaan kebutuhan anak pada program ini.</p>
        </div>
        <a href="{{ url('/donasi/'.$program->slug) }}" class="btn-pill btn-sun shrink-0 !py-3.5 !px-6 text-sm font-bold">
          Donasi Sekarang &rarr;
        </a>
      </div>
    @else
      <div class="mt-14 p-8 sm:p-10 rounded-3xl bg-paper-warm border border-line text-ink flex flex-col sm:flex-row items-center justify-between gap-6 shadow-warm-sm">
        <div>
          <span class="badge-pill bg-line text-ink-muted border border-line text-[10px] mb-2">Status: Program Selesai</span>
          <h3 class="font-serif font-bold text-2xl text-ink">Program Telah Selesai</h3>
          <p class="text-xs text-ink-muted mt-1 max-w-md">Program ini telah selesai dilaksanakan. Dukungan donasi untuk program ini telah ditutup.</p>
        </div>
        <button type="button" disabled class="btn-pill shrink-0 !py-3.5 !px-6 text-sm font-bold bg-line text-ink-muted/60 border border-line cursor-not-allowed opacity-70">
          Donasi Ditutup
        </button>
      </div>
    @endif

    {{-- Bottom Navigation --}}
    <div class="mt-12 pt-8 border-t border-line-soft flex items-center justify-between flex-wrap gap-4">
      <a href="{{ url('/program') }}" class="btn-pill btn-outline text-xs font-bold">
        &larr; Lihat Seluruh Program
      </a>
    </div>

  </div>
</section>

{{-- ═══════════════ KEGIATAN LAINNYA DARI PROGRAM INI (1 ROW) ═══════════════ --}}
@if(!empty($relatedActivities) && count($relatedActivities) > 0)
  @php
    $displayActivities = array_slice($relatedActivities, 0, 3);
    $cardCount = count($displayActivities);
    $colClass = $cardCount === 1 ? 'md:grid-cols-1 md:max-w-sm' : ($cardCount === 2 ? 'sm:grid-cols-2 sm:max-w-2xl' : 'sm:grid-cols-2 lg:grid-cols-3');
  @endphp
  <section class="py-12 sm:py-16 bg-surface border-t border-line/60">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <div class="flex items-center justify-between mb-6 sm:mb-8 flex-wrap gap-4">
        <div class="flex items-center gap-2.5">
          <span class="w-1.5 h-6 rounded-full bg-accent-primary"></span>
          <h2 class="font-serif text-xl sm:text-2xl font-bold text-ink">
            Kegiatan Terkait Program Ini
          </h2>
        </div>
        <span class="badge-pill bg-paper-warm border border-line text-ink-muted text-xs font-medium">
          {{ count($relatedActivities) }} Kegiatan Terlaksana
        </span>
      </div>

      {{-- 1 Row Layout: Flex Horizontal Scroll on Mobile, Grid 1 Row on Desktop --}}
      <div class="flex sm:grid {{ $colClass }} gap-5 sm:gap-6 overflow-x-auto pb-4 sm:pb-0 scrollbar-none snap-x -mx-4 px-4 sm:mx-0 sm:px-0">
        @foreach($displayActivities as $act)
          <a href="{{ url('/kegiatan/'.$act->slug) }}" class="bento-card group flex flex-col justify-between overflow-hidden hover:shadow-warm-lg hover:-translate-y-1 transition-all duration-300 w-[280px] sm:w-auto shrink-0 snap-start">
            <div>
              {{-- Cover Photo --}}
              <div class="h-44 sm:h-48 overflow-hidden relative bg-paper-warm">
                @if($act->cover)
                  <img src="{{ asset('storage/'.$act->cover) }}" alt="{{ $act->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"/>
                @else
                  <div class="w-full h-full bg-paper-warm flex items-center justify-center text-ink-light">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  </div>
                @endif
                @if(!empty($act->date))
                  <div class="absolute bottom-3 left-3 badge-pill bg-ink/75 text-white text-[10px] backdrop-blur-md">
                    {{ \Carbon\Carbon::parse($act->date)->format('d M Y') }}
                  </div>
                @endif
              </div>

              {{-- Content --}}
              <div class="p-5">
                @if(!empty($act->location))
                  <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-accent-primary mb-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ $act->location }}
                  </span>
                @endif
                <h3 class="font-serif font-bold text-base text-ink group-hover:text-accent-primary transition-colors line-clamp-2 leading-snug">
                  {{ $act->title }}
                </h3>
                @if(!empty($act->summary))
                  <p class="text-xs text-ink-muted mt-2 line-clamp-2 leading-relaxed">
                    {{ $act->summary }}
                  </p>
                @endif
              </div>
            </div>

            <div class="px-5 pb-5 pt-1 text-xs font-bold text-accent-primary group-hover:underline flex items-center gap-1.5">
              <span>Baca Laporan Kegiatan</span>
              <span>&rarr;</span>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </section>
@endif

{{-- Fullscreen Lightbox Modal untuk Program --}}
@if(count($photos) > 0)
<div 
  id="prog-lightbox" 
  class="fixed inset-0 z-50 hidden bg-black/95 backdrop-blur-md flex items-center justify-center p-3 sm:p-6 transition-opacity duration-300"
  role="dialog"
  aria-modal="true"
  aria-label="Tampilan Penuh Foto Program"
>
  {{-- Close Button --}}
  <button 
    type="button" 
    id="prog-lightbox-close" 
    class="absolute top-4 right-4 sm:top-6 sm:right-6 w-11 h-11 rounded-full bg-white/10 hover:bg-white/25 text-white flex items-center justify-center transition-all z-30 focus:outline-none"
    title="Tutup (Esc)"
  >
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg>
  </button>

  @if(count($photos) > 1)
    {{-- Lightbox Prev Button --}}
    <button 
      type="button" 
      id="prog-lightbox-prev" 
      class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 z-30 w-11 h-11 sm:w-14 sm:h-14 rounded-full bg-white/15 hover:bg-white/30 text-white flex items-center justify-center transition-all backdrop-blur-md hover:scale-110 active:scale-95"
      aria-label="Foto Sebelumnya"
    >
      <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
    </button>

    {{-- Lightbox Next Button --}}
    <button 
      type="button" 
      id="prog-lightbox-next" 
      class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 z-30 w-11 h-11 sm:w-14 sm:h-14 rounded-full bg-white/15 hover:bg-white/30 text-white flex items-center justify-center transition-all backdrop-blur-md hover:scale-110 active:scale-95"
      aria-label="Foto Selanjutnya"
    >
      <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
    </button>
  @endif

  {{-- Lightbox Image Box --}}
  <div class="relative max-w-5xl max-h-[85vh] w-full flex flex-col items-center justify-center" id="prog-lightbox-container">
    <img 
      id="prog-lightbox-img" 
      src="{{ asset('storage/'.$photos[0]['image']) }}" 
      alt="{{ $photos[0]['caption'] }}" 
      class="max-w-full max-h-[72vh] object-contain rounded-2xl shadow-2xl transition-all duration-300"
    />
    
    {{-- Bottom Caption and Counter --}}
    <div class="mt-4 text-center px-4 max-w-2xl">
      <p id="prog-lightbox-caption" class="text-sm sm:text-base text-white/95 font-medium leading-relaxed drop-shadow">
        {{ $photos[0]['caption'] }}
      </p>
      @if(count($photos) > 1)
        <span id="prog-lightbox-counter" class="inline-block mt-1 text-xs text-white/60 font-mono">
          Foto 1 dari {{ count($photos) }}
        </span>
      @endif
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const photos = {!! json_encode($photos) !!};
  const total = photos.length;
  if (total === 0) return;

  let currentIndex = 0;
  const baseUrl = "{{ asset('storage') }}";

  // Elemen slider utama
  const slides = document.querySelectorAll('.prog-slide-item');
  const thumbs = document.querySelectorAll('.prog-thumb-item');
  const sliderCaption = document.getElementById('prog-slider-caption');
  const sliderCounter = document.getElementById('prog-slider-counter');
  const sliderPrev = document.getElementById('prog-slider-prev');
  const sliderNext = document.getElementById('prog-slider-next');
  const mainTrack = document.getElementById('prog-slider-main-track');
  const btnOpenLightbox = document.getElementById('prog-btn-open-lightbox');

  // Elemen lightbox
  const lightbox = document.getElementById('prog-lightbox');
  const lightboxImg = document.getElementById('prog-lightbox-img');
  const lightboxCaption = document.getElementById('prog-lightbox-caption');
  const lightboxCounter = document.getElementById('prog-lightbox-counter');
  const lightboxClose = document.getElementById('prog-lightbox-close');
  const lightboxPrev = document.getElementById('prog-lightbox-prev');
  const lightboxNext = document.getElementById('prog-lightbox-next');

  function updateSlider(newIndex) {
    if (newIndex < 0) newIndex = total - 1;
    if (newIndex >= total) newIndex = 0;
    currentIndex = newIndex;

    // Update slide display
    slides.forEach((slide, idx) => {
      if (idx === currentIndex) {
        slide.classList.remove('opacity-0', 'pointer-events-none', 'z-0');
        slide.classList.add('opacity-100', 'z-10');
      } else {
        slide.classList.remove('opacity-100', 'z-10');
        slide.classList.add('opacity-0', 'pointer-events-none', 'z-0');
      }
    });

    // Update thumbnails
    thumbs.forEach((thumb, idx) => {
      if (idx === currentIndex) {
        thumb.className = 'prog-thumb-item shrink-0 w-16 h-12 sm:w-20 sm:h-14 rounded-2xl overflow-hidden border-2 transition-all cursor-pointer border-accent-primary ring-2 ring-accent-primary/30 scale-105';
        thumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
      } else {
        thumb.className = 'prog-thumb-item shrink-0 w-16 h-12 sm:w-20 sm:h-14 rounded-2xl overflow-hidden border-2 transition-all cursor-pointer border-line/70 opacity-60 hover:opacity-100 hover:border-line';
      }
    });

    // Update caption & counter
    if (sliderCaption && photos[currentIndex]) {
      sliderCaption.textContent = photos[currentIndex].caption || '';
    }
    if (sliderCounter) {
      sliderCounter.textContent = `${currentIndex + 1} / ${total}`;
    }

    // Update lightbox jika sedang terbuka
    if (lightbox && !lightbox.classList.contains('hidden')) {
      updateLightbox();
    }
  }

  function updateLightbox() {
    if (!photos[currentIndex]) return;
    const current = photos[currentIndex];
    lightboxImg.src = baseUrl + '/' + current.image;
    lightboxImg.alt = current.caption || '';
    if (lightboxCaption) lightboxCaption.textContent = current.caption || '';
    if (lightboxCounter) lightboxCounter.textContent = `Foto ${currentIndex + 1} dari ${total}`;
  }

  function openLightbox() {
    updateLightbox();
    lightbox.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    lightbox.classList.add('hidden');
    document.body.style.overflow = '';
  }

  if (sliderPrev) {
    sliderPrev.addEventListener('click', function (e) {
      e.stopPropagation();
      updateSlider(currentIndex - 1);
    });
  }

  if (sliderNext) {
    sliderNext.addEventListener('click', function (e) {
      e.stopPropagation();
      updateSlider(currentIndex + 1);
    });
  }

  thumbs.forEach(thumb => {
    thumb.addEventListener('click', function () {
      const idx = parseInt(this.getAttribute('data-index'), 10);
      updateSlider(idx);
    });
  });

  if (mainTrack) {
    mainTrack.addEventListener('click', openLightbox);
  }

  if (btnOpenLightbox) {
    btnOpenLightbox.addEventListener('click', function (e) {
      e.stopPropagation();
      openLightbox();
    });
  }

  if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);

  if (lightboxPrev) {
    lightboxPrev.addEventListener('click', function (e) {
      e.stopPropagation();
      updateSlider(currentIndex - 1);
    });
  }

  if (lightboxNext) {
    lightboxNext.addEventListener('click', function (e) {
      e.stopPropagation();
      updateSlider(currentIndex + 1);
    });
  }

  if (lightbox) {
    lightbox.addEventListener('click', function (e) {
      if (e.target === lightbox || e.target.id === 'prog-lightbox-container') {
        closeLightbox();
      }
    });
  }

  // Keyboard navigation
  document.addEventListener('keydown', function (e) {
    if (lightbox && !lightbox.classList.contains('hidden')) {
      if (e.key === 'Escape') closeLightbox();
      if (e.key === 'ArrowLeft') updateSlider(currentIndex - 1);
      if (e.key === 'ArrowRight') updateSlider(currentIndex + 1);
    }
  });

  // Touch swipe support untuk slider utama program
  let touchStartX = 0;
  let touchEndX = 0;
  if (mainTrack) {
    mainTrack.addEventListener('touchstart', function (e) {
      touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    mainTrack.addEventListener('touchend', function (e) {
      touchEndX = e.changedTouches[0].screenX;
      if (touchStartX - touchEndX > 50) {
        updateSlider(currentIndex + 1);
      }
      if (touchEndX - touchStartX > 50) {
        updateSlider(currentIndex - 1);
      }
    }, { passive: true });
  }
});
</script>
@endif

@endsection
