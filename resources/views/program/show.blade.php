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
      <span class="badge-pill bg-tint-primary text-accent-primary border border-tint-primary-line text-[10px]">
        {{ $program->status ?? 'Program Berjalan' }}
      </span>
      <span class="text-xs text-ink-muted">&bull; Target Terbuka</span>
    </div>
    <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-ink leading-tight">
      {{ $program->name ?? 'Detail Program Bantuan' }}
    </h1>
    @if(isset($program->summary))
      <p class="text-base sm:text-lg text-ink-muted mt-4 leading-relaxed">
        {{ $program->summary }}
      </p>
    @endif
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
    <div class="mt-14 p-8 sm:p-10 rounded-3xl bg-gradient-to-br from-forest-900 to-forest-950 text-white flex flex-col sm:flex-row items-center justify-between gap-6 shadow-warm-lg">
      <div>
        <span class="badge-pill bg-forest-800 text-sun-300 border border-forest-700 text-[10px] mb-2">Ayo Terlibat</span>
        <h3 class="font-serif font-bold text-2xl text-white">Dukung Kelangsungan Program Ini</h3>
        <p class="text-xs text-forest-200/80 mt-1 max-w-md">Donasi Anda disalurkan 100% untuk operasional dan pengadaan kebutuhan anak pada program ini.</p>
      </div>
      <a href="{{ url('/donasi') }}" class="btn-pill btn-sun shrink-0 !py-3.5 !px-6 text-sm font-bold">
        Donasi Sekarang &rarr;
      </a>
    </div>

  </div>
</section>

@endsection
