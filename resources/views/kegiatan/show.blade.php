@extends('layouts.app')

@section('content')

{{-- Header Artikel Kegiatan --}}
<section class="pt-28 pb-14 bg-gradient-to-b from-paper-warm to-paper">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <a href="{{ url('/kegiatan') }}" class="inline-flex items-center gap-2 text-xs font-bold text-ink-muted hover:text-accent-primary transition-colors mb-6">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      Kembali ke Seluruh Berita
    </a>
    <div class="flex items-center gap-3 mb-3">
      <span class="badge-pill bg-tint-forest text-accent-forest border border-tint-forest-line text-[10px]">
        Laporan Kegiatan
      </span>
      <span class="text-xs text-ink-muted">
        Dipublikasikan pada {{ \Carbon\Carbon::parse($activity->date ?? now())->format('d F Y') }}
      </span>
    </div>
    <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-ink leading-tight">
      {{ $activity->title ?? 'Detail Kegiatan Lapangan' }}
    </h1>
    @if(isset($activity->summary))
      <p class="text-base sm:text-lg text-ink-muted mt-4 leading-relaxed font-serif italic">
        "{{ $activity->summary }}"
      </p>
    @endif
  </div>
</section>

{{-- Content Body --}}
<section class="py-12 bg-surface border-y border-line/60">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">

    @php
      $photos = [];
      $seen = [];

      // 1. Cover sebagai foto pertama jika ada
      if (!empty($activity->cover)) {
          $photos[] = [
              'image' => $activity->cover,
              'caption' => $activity->title,
          ];
          $seen[$activity->cover] = true;
      }

      // 2. Kumpulan foto dokumentasi galeri kegiatan
      if (!empty($activity->gallery) && (is_array($activity->gallery) || is_iterable($activity->gallery))) {
          foreach ($activity->gallery as $item) {
              $img = is_array($item) ? ($item['image'] ?? null) : ($item->image ?? null);
              $cap = is_array($item) ? ($item['caption'] ?? '') : ($item->caption ?? '');
              if ($img && !isset($seen[$img])) {
                  $photos[] = [
                      'image' => $img,
                      'caption' => $cap ?: $activity->title,
                  ];
                  $seen[$img] = true;
              }
          }
      }
    @endphp

    {{-- Media Carousel / Slider & Lightbox Trigger --}}
    @if(count($photos) > 0)
      <div class="mb-12">
        <div class="relative rounded-3xl overflow-hidden shadow-warm-lg border border-line/60 bg-black/90 group" id="activity-slider">

          {{-- Main Slide Display Container --}}
          <div class="relative w-full h-[320px] sm:h-[420px] md:h-[480px] overflow-hidden cursor-zoom-in" id="slider-main-track" title="Klik foto untuk melihat layar penuh">
            @foreach($photos as $index => $photo)
              <div 
                class="slide-item absolute inset-0 transition-opacity duration-500 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 pointer-events-none z-0' }}" 
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
              id="btn-open-lightbox" 
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
                <p id="slider-caption" class="text-xs sm:text-sm text-white/95 font-medium leading-relaxed line-clamp-2 max-w-2xl drop-shadow">
                  {{ $photos[0]['caption'] ?? $activity->title }}
                </p>
                @if(count($photos) > 1)
                  <span id="slider-counter" class="shrink-0 badge-pill bg-white/20 text-white border border-white/30 text-[11px] font-mono px-2.5 py-0.5 backdrop-blur-md">
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
              id="slider-prev" 
              class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white/85 hover:bg-white text-ink hover:text-accent-primary shadow-warm flex items-center justify-center transition-all duration-200 backdrop-blur-md hover:scale-110 active:scale-95"
              aria-label="Foto Sebelumnya"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </button>

            {{-- Next Button --}}
            <button 
              type="button" 
              id="slider-next" 
              class="absolute right-3 sm:right-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white/85 hover:bg-white text-ink hover:text-accent-primary shadow-warm flex items-center justify-center transition-all duration-200 backdrop-blur-md hover:scale-110 active:scale-95"
              aria-label="Foto Selanjutnya"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </button>
          @endif

        </div>

        {{-- Mini Thumbnail Strip (bila foto > 1) --}}
        @if(count($photos) > 1)
          <div class="mt-3 flex items-center gap-2.5 overflow-x-auto pb-2 scrollbar-none px-1" id="slider-thumbnails">
            @foreach($photos as $index => $photo)
              <button 
                type="button" 
                class="thumb-item shrink-0 w-16 h-12 sm:w-20 sm:h-14 rounded-2xl overflow-hidden border-2 transition-all cursor-pointer {{ $index === 0 ? 'border-accent-primary ring-2 ring-accent-primary/30 scale-105' : 'border-line/70 opacity-60 hover:opacity-100 hover:border-line' }}" 
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

    {{-- Description Content --}}
    <div class="prose-content max-w-none text-ink-muted text-base leading-relaxed space-y-6">
      @if(isset($activity->content) && trim(strip_tags($activity->content)) !== '')
        {!! $activity->content !!}
      @else
        <div class="p-6 sm:p-8 rounded-3xl bg-paper-warm border-2 border-dashed border-line text-center not-prose">
          <p class="font-serif text-base font-bold text-ink">Uraian kegiatan belum diisi</p>
          <p class="text-xs text-ink-muted mt-1.5 leading-relaxed">
            Tambahkan field <code class="px-1.5 py-0.5 rounded bg-surface border border-line text-[11px] font-mono text-accent-primary">'content'</code>
            pada file <code class="px-1.5 py-0.5 rounded bg-surface border border-line text-[11px] font-mono text-accent-primary">resources/data/activities.php</code>.
          </p>
        </div>
      @endif
    </div>

    {{-- Program Link Banner if any --}}
    @if(isset($activity->program))
      <div class="mt-12 p-6 rounded-3xl bg-paper-warm border border-line flex items-center justify-between gap-4 flex-wrap">
        <div>
          <span class="text-[11px] font-bold uppercase text-accent-primary tracking-wider">Terkait Program</span>
          <h4 class="font-serif font-bold text-lg text-ink mt-0.5">{{ $activity->program->name }}</h4>
        </div>
        <a href="{{ url('/program/'.$activity->program->slug) }}" class="btn-pill btn-outline !py-2 !px-4 text-xs font-bold">
          Lihat Program Ini &rarr;
        </a>
      </div>
    @endif

    {{-- Bottom Back Navigation --}}
    <div class="mt-12 pt-8 border-t border-line-soft flex items-center justify-between flex-wrap gap-4">
      <a href="{{ url('/kegiatan') }}" class="btn-pill btn-outline text-xs font-bold">
        &larr; Berita Lainnya
      </a>
    </div>

  </div>
</section>

{{-- Fullscreen Lightbox Modal --}}
@if(count($photos) > 0)
<div 
  id="activity-lightbox" 
  class="fixed inset-0 z-50 hidden bg-black/95 backdrop-blur-md flex items-center justify-center p-3 sm:p-6 transition-opacity duration-300"
  role="dialog"
  aria-modal="true"
  aria-label="Tampilan Penuh Foto Kegiatan"
>
  {{-- Close Button --}}
  <button 
    type="button" 
    id="lightbox-close" 
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
      id="lightbox-prev" 
      class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 z-30 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white/10 hover:bg-white/25 text-white flex items-center justify-center transition-all focus:outline-none hover:scale-110 active:scale-95"
      title="Sebelumnya (Panah Kiri)"
    >
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
    </button>

    {{-- Lightbox Next Button --}}
    <button 
      type="button" 
      id="lightbox-next" 
      class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 z-30 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white/10 hover:bg-white/25 text-white flex items-center justify-center transition-all focus:outline-none hover:scale-110 active:scale-95"
      title="Selanjutnya (Panah Kanan)"
    >
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
    </button>
  @endif

  {{-- Lightbox Content --}}
  <div class="relative max-w-5xl w-full max-h-[92vh] flex flex-col items-center justify-center z-20" id="lightbox-container">
    <div class="w-full overflow-hidden rounded-2xl flex items-center justify-center relative shadow-2xl">
      <img 
        id="lightbox-img" 
        src="" 
        alt="" 
        class="max-h-[72vh] sm:max-h-[76vh] w-auto max-w-full object-contain mx-auto transition-transform duration-300 select-none"
      />
    </div>

    {{-- Caption & Counter Bar --}}
    <div class="w-full mt-4 p-4 sm:p-5 rounded-2xl bg-white/10 text-white border border-white/15 backdrop-blur-md flex items-center justify-between gap-4">
      <p id="lightbox-caption" class="text-xs sm:text-sm text-forest-100/90 leading-relaxed max-w-3xl"></p>
      @if(count($photos) > 1)
        <span id="lightbox-counter" class="shrink-0 badge-pill bg-white/15 text-sun-300 border border-white/20 text-xs font-mono px-3 py-1"></span>
      @endif
    </div>
  </div>
</div>

{{-- Script Slider & Lightbox --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
  const photos = @json($photos);
  if (!photos || photos.length === 0) return;

  let currentIndex = 0;
  const total = photos.length;
  const baseUrl = "{{ asset('storage') }}";

  const slides = document.querySelectorAll('.slide-item');
  const thumbs = document.querySelectorAll('.thumb-item');
  const sliderCaption = document.getElementById('slider-caption');
  const sliderCounter = document.getElementById('slider-counter');

  const sliderPrev = document.getElementById('slider-prev');
  const sliderNext = document.getElementById('slider-next');
  const mainTrack = document.getElementById('slider-main-track');
  const btnOpenLightbox = document.getElementById('btn-open-lightbox');

  const lightbox = document.getElementById('activity-lightbox');
  const lightboxClose = document.getElementById('lightbox-close');
  const lightboxImg = document.getElementById('lightbox-img');
  const lightboxCaption = document.getElementById('lightbox-caption');
  const lightboxCounter = document.getElementById('lightbox-counter');
  const lightboxPrev = document.getElementById('lightbox-prev');
  const lightboxNext = document.getElementById('lightbox-next');

  function updateSlider(newIndex) {
    if (newIndex < 0) newIndex = total - 1;
    if (newIndex >= total) newIndex = 0;
    currentIndex = newIndex;

    // Update slides
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
        thumb.className = 'thumb-item shrink-0 w-16 h-12 sm:w-20 sm:h-14 rounded-2xl overflow-hidden border-2 transition-all cursor-pointer border-accent-primary ring-2 ring-accent-primary/30 scale-105';
        thumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
      } else {
        thumb.className = 'thumb-item shrink-0 w-16 h-12 sm:w-20 sm:h-14 rounded-2xl overflow-hidden border-2 transition-all cursor-pointer border-line/70 opacity-60 hover:opacity-100 hover:border-line';
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
      if (e.target === lightbox || e.target.id === 'lightbox-container') {
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

  // Touch swipe support for main slider
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
