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
    
    @if(isset($activity->cover))
      <div class="rounded-3xl overflow-hidden mb-12 shadow-warm-lg">
        <img src="{{ asset('storage/'.$activity->cover) }}" alt="{{ $activity->title }}" class="w-full max-h-[480px] object-cover"/>
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

    {{-- Bottom Share & Back Navigation --}}
    <div class="mt-12 pt-8 border-t border-line-soft flex items-center justify-between flex-wrap gap-4">
      <a href="{{ url('/kegiatan') }}" class="btn-pill btn-outline text-xs">
        &larr; Berita Lainnya
      </a>
      <a href="{{ url('/donasi') }}" class="btn-pill btn-primary text-xs">
        Salurkan Donasi Aksi Ini
      </a>
    </div>

  </div>
</section>

@endsection
