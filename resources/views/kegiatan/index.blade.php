@extends('layouts.app')

@section('content')

{{-- Header --}}
<section class="pt-28 pb-16 bg-gradient-to-b from-paper-warm to-paper text-center">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <span class="badge-pill bg-tint-forest text-accent-forest border border-tint-forest-line">Catatan & Liputan</span>
    <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold text-ink mt-4 tracking-tight">
      Kabar Aksi <span class="italic text-accent-primary">& Kegiatan</span>
    </h1>
    <p class="mt-5 text-base sm:text-lg text-ink-muted leading-relaxed max-w-2xl mx-auto">
      Transparansi aktivitas lapangan, cerita kehangatan relawan, dan senyum anak-anak yang telah kita dampingi bersama.
    </p>
  </div>
</section>

{{-- List Kegiatan --}}
<section class="py-16 bg-paper">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      @forelse($activities ?? [] as $activity)
        <a href="{{ url('/kegiatan/'.$activity->slug) }}" class="bento-card group flex flex-col justify-between">
          <div>
            @if($activity->cover)
              <div class="h-52 overflow-hidden relative">
                <img src="{{ asset('storage/'.$activity->cover) }}" alt="{{ $activity->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"/>
                <div class="absolute bottom-3 left-3">
                  <span class="badge-pill bg-black/60 backdrop-blur-md text-white text-[10px]">
                    {{ \Carbon\Carbon::parse($activity->date ?? now())->format('d M Y') }}
                  </span>
                </div>
              </div>
            @else
              <div class="h-52 bg-paper-warm flex items-center justify-center p-6 border-b border-line-soft">
                <div class="w-12 h-12 rounded-2xl bg-surface border border-line flex items-center justify-center text-accent-forest font-serif font-bold text-lg">
                  📰
                </div>
              </div>
            @endif

            <div class="p-6">
              <span class="text-[11px] font-semibold text-accent-primary uppercase tracking-wider block mb-1">Berita Lapangan</span>
              <h3 class="font-serif font-bold text-xl text-ink group-hover:text-accent-primary transition-colors leading-snug">
                {{ $activity->title }}
              </h3>
              <p class="text-sm text-ink-muted mt-2.5 line-clamp-3 leading-relaxed">
                {{ $activity->summary }}
              </p>
            </div>
          </div>

          <div class="px-6 pb-6 pt-0 flex items-center justify-between text-xs font-bold text-ink group-hover:text-accent-primary">
            <span>Baca Selengkapnya</span>
            <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
          </div>
        </a>
      @empty
        <div class="col-span-full p-8 sm:p-14 text-center rounded-3xl bg-surface border-2 border-dashed border-line">
          <div class="w-16 h-16 rounded-2xl bg-paper-warm border border-line flex items-center justify-center mx-auto text-ink-light">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
          </div>
          <p class="font-serif text-lg sm:text-xl font-bold text-ink mt-4">Belum ada kegiatan</p>
          <p class="text-xs sm:text-sm text-ink-muted mt-2 max-w-md mx-auto leading-relaxed">
            Data kegiatan belum diisi. Tambahkan catatan lapangan pada file
            <code class="px-1.5 py-0.5 rounded bg-paper-warm border border-line text-[11px] font-mono text-accent-primary">resources/data/activities.php</code>
            lalu halaman ini akan otomatis menampilkannya.
          </p>
        </div>
      @endforelse
    </div>

    @if(is_object($activities ?? null) && method_exists($activities, 'hasPages') && $activities->hasPages())
      <div class="mt-12">
        {{ $activities->links() }}
      </div>
    @endif

  </div>
</section>

@endsection
