@extends('layouts.app')

@section('content')

{{-- Header --}}
<section class="pt-28 pb-16 bg-gradient-to-b from-paper-warm to-paper text-center">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <span class="badge-pill bg-tint-sun text-accent-sun border border-tint-sun-line">Dokumentasi Visual</span>
    <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold text-ink mt-4 tracking-tight">
      Galeri Momen <span class="italic text-accent-primary">& Senyuman</span>
    </h1>
    <p class="mt-5 text-base sm:text-lg text-ink-muted leading-relaxed max-w-2xl mx-auto">
      Setiap foto menyimpan cerita kebahagiaan, perjuangan, dan ketulusan para donatur dan relawan yang terus menyalakan harapan.
    </p>
  </div>
</section>

{{-- Gallery Grid --}}
<section class="py-16 bg-paper">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    
    <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6 [column-fill:balance]">
      @forelse($galleries ?? [] as $gallery)
 <div class="break-inside-avoid bento-card group overflow-hidden">
          @if($gallery->image)
            <div class="overflow-hidden relative">
              <img src="{{ asset('storage/'.$gallery->image) }}" alt="{{ $gallery->caption ?? 'Galeri Pelita Bahagia' }}" class="w-full object-cover transition-transform duration-700 group-hover:scale-105"/>
            </div>
          @endif
          @if($gallery->caption)
            <div class="p-5 bg-surface border-t border-line-soft">
              <p class="text-xs text-ink leading-relaxed font-medium">
                {{ $gallery->caption }}
              </p>
            </div>
          @endif
        </div>
      @empty
        <div class="col-span-full p-8 sm:p-14 text-center rounded-3xl bg-surface border-2 border-dashed border-line" style="column-span: all;">
          <div class="w-16 h-16 rounded-2xl bg-paper-warm border border-line flex items-center justify-center mx-auto text-ink-light">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          </div>
          <p class="font-serif text-lg sm:text-xl font-bold text-ink mt-4">Galeri masih kosong</p>
          <p class="text-xs sm:text-sm text-ink-muted mt-2 max-w-md mx-auto leading-relaxed">
            Foto kegiatan belum diunggah. Tambahkan data pada file
            <code class="px-1.5 py-0.5 rounded bg-paper-warm border border-line text-[11px] font-mono text-accent-primary">resources/data/galleries.php</code>
            dengan gambar di <code class="px-1.5 py-0.5 rounded bg-paper-warm border border-line text-[11px] font-mono text-accent-primary">storage/app/public/galleries/</code>.
          </p>
        </div>
      @endforelse
    </div>

    @if(is_object($galleries ?? null) && method_exists($galleries, 'hasPages') && $galleries->hasPages())
      <div class="mt-14">
        {{ $galleries->links() }}
      </div>
    @endif

  </div>
</section>

@endsection
