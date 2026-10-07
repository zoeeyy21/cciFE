@extends('layouts.app')

@section('content')

{{-- Header --}}
<section class="pt-28 pb-16 bg-gradient-to-b from-paper-warm to-paper text-center">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <span class="badge-pill bg-tint-primary text-accent-primary border border-tint-primary-line">Program Aksi Nyata</span>
    <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold text-ink mt-4 tracking-tight">
      Program Bantuan <span class="italic text-accent-primary">& Intervensi</span>
    </h1>
    <p class="mt-5 text-base sm:text-lg text-ink-muted leading-relaxed max-w-2xl mx-auto">
      Setiap program dirancang berbasis data lapangan dan kebutuhan riil anak-anak Indonesia untuk memberikan dampak jangka panjang.
    </p>
  </div>
</section>

{{-- Program List --}}
<section class="py-16 bg-paper">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      @forelse($programs ?? [] as $program)
        <div class="bento-card flex flex-col justify-between group">
          <div>
            @if($program->image)
              <div class="h-56 overflow-hidden relative">
                <img src="{{ asset('storage/'.$program->image) }}" alt="{{ $program->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"/>
                <div class="absolute top-4 left-4">
                  <span class="badge-pill bg-white/90 backdrop-blur-md text-accent-primary border border-line text-[10px]">
                    {{ $program->status ?? 'Aktif' }}
                  </span>
                </div>
              </div>
            @else
              <div class="h-56 bg-gradient-to-tr from-forest-800 to-forest-950 flex items-center justify-center text-white/50 relative">
                <span class="font-serif text-4xl font-bold">Pelita</span>
                <div class="absolute top-4 left-4">
                  <span class="badge-pill bg-white/20 backdrop-blur-md text-white text-[10px]">
                    {{ $program->status ?? 'Aktif' }}
                  </span>
                </div>
              </div>
            @endif

            <div class="p-6 sm:p-7">
              <h3 class="font-serif font-bold text-2xl text-ink group-hover:text-accent-primary transition-colors leading-snug">
                <a href="{{ url('/program/'.$program->slug) }}">
                  {{ $program->name }}
                </a>
              </h3>
              <p class="text-sm text-ink-muted mt-3 line-clamp-3 leading-relaxed">
                {{ $program->summary }}
              </p>

              @if($program->goal)
                <div class="mt-5 p-3.5 rounded-2xl bg-paper-warm border border-line/80 text-xs">
                  <span class="font-bold text-ink block mb-0.5">Target Capaian:</span>
                  <span class="text-ink-muted line-clamp-1">{{ $program->goal }}</span>
                </div>
              @endif
            </div>
          </div>

          <div class="px-6 pb-6 pt-0 flex items-center justify-between border-t border-line-soft mt-4">
            <a href="{{ url('/program/'.$program->slug) }}" class="text-xs font-bold text-ink hover:text-accent-primary flex items-center gap-1">
              Pelajari Detail &rarr;
            </a>
            <a href="{{ url('/donasi') }}" class="btn-pill btn-primary !py-2 !px-4 !text-xs font-bold shadow-md">
              Dukung Program
            </a>
          </div>
        </div>
      @empty
        <div class="col-span-full p-8 sm:p-14 text-center rounded-3xl bg-surface border-2 border-dashed border-line">
          <div class="w-16 h-16 rounded-2xl bg-paper-warm border border-line flex items-center justify-center mx-auto text-ink-light">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
          </div>
          <p class="font-serif text-lg sm:text-xl font-bold text-ink mt-4">Belum ada program</p>
          <p class="text-xs sm:text-sm text-ink-muted mt-2 max-w-md mx-auto leading-relaxed">
            Data program belum diisi. Tambahkan program pada file
            <code class="px-1.5 py-0.5 rounded bg-paper-warm border border-line text-[11px] font-mono text-accent-primary">resources/data/programs.php</code>
            lalu halaman ini akan otomatis menampilkannya.
          </p>
        </div>
      @endforelse
    </div>

    @if(is_object($programs ?? null) && method_exists($programs, 'hasPages') && $programs->hasPages())
          <div class="mt-14">
            {{ $programs->links() }}
          </div>
        @endif

  </div>
</section>

@endsection
