{{-- Page header for inner pages (tidak dipakai layout utama — contoh komponen) --}}
@props(['title', 'subtitle' => ''])
<section class="gradient-hero relative overflow-hidden text-white">
  {{-- Decorative elements --}}
  <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full bg-white/5"></div>
  <div class="absolute -bottom-16 -left-16 h-56 w-56 rounded-full bg-white/5"></div>
  <div class="absolute top-1/2 right-1/4 h-32 w-32 rounded-full bg-primary-400/10"></div>

  <div class="relative mx-auto max-w-6xl px-4 py-20 text-center sm:px-6 md:py-28">
    <h1 class="font-serif text-4xl font-bold md:text-5xl lg:text-6xl">{{ $title }}</h1>
    @if($subtitle)
    <p class="mx-auto mt-5 max-w-2xl text-lg leading-relaxed text-primary-100/90">{{ $subtitle }}</p>
    @endif
    {{-- Breadcrumb-like dots --}}
    <div class="mt-8 flex items-center justify-center gap-2">
      <span class="h-1.5 w-8 rounded-full bg-sun-300"></span>
      <span class="h-1.5 w-1.5 rounded-full bg-white/40"></span>
      <span class="h-1.5 w-1.5 rounded-full bg-white/20"></span>
    </div>
  </div>
</section>
