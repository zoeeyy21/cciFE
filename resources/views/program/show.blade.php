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
    
    @if(isset($program->image))
      <div class="rounded-3xl overflow-hidden mb-12 shadow-warm-lg">
        <img src="{{ asset('storage/'.$program->image) }}" alt="{{ $program->name }}" class="w-full max-h-[480px] object-cover"/>
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

@endsection
