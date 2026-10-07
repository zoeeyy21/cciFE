@extends('layouts.app')

@section('content')

{{-- Header --}}
<section class="pt-28 pb-16 bg-gradient-to-b from-paper-warm to-paper text-center">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <span class="badge-pill bg-tint-forest text-accent-forest border border-tint-forest-line">Pusat Bantuan & Sinergi</span>
    <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold text-ink mt-4 tracking-tight">
      Hubungi <span class="italic text-accent-primary">{{ $site['short_name'] }}</span>
    </h1>
    <p class="mt-5 text-base sm:text-lg text-ink-muted leading-relaxed max-w-2xl mx-auto">
      Ingin menjadi relawan, mengajukan kerja sama kemitraan CSR, atau menanyakan seputar donasi? Pintu kami selalu terbuka.
    </p>
  </div>
</section>

{{-- Main Grid --}}
<section class="py-16 bg-paper">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

      {{-- Left Side: Quick Contact Channels + Direct WA Card --}}
      <div class="lg:col-span-5 space-y-6">

        {{-- WhatsApp Card (hanya tampil kalau nomor sudah diisi) --}}
        @if($site['whatsapp_link'])
        <div class="bento-card p-7 bg-gradient-to-br from-forest-900 to-forest-950 text-white relative overflow-hidden">
          <div class="absolute -right-8 -bottom-8 w-36 h-36 rounded-full bg-forest-700/30 blur-xl"></div>
          <span class="badge-pill bg-forest-800 text-sun-300 border border-forest-700 text-[10px] mb-3">Respon Cepat</span>
          <h3 class="font-serif font-bold text-2xl text-white">Konsultasi Donasi via WhatsApp</h3>
          <p class="text-xs text-forest-200/80 mt-2 leading-relaxed">
            Tim layanan donatur kami siap membantu konfirmasi transfer, laporan pertanggungjawaban, dan konsultasi program.
          </p>
          <a href="{{ $site['whatsapp_link'] }}" target="_blank" rel="noopener" class="btn-pill btn-sun !py-3 !px-5 text-xs font-bold mt-6 inline-flex items-center gap-2">
            <svg class="w-4 h-4 text-forest-950" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0012.04 2z"/></svg>
            Chat WhatsApp Sekarang &rarr;
          </a>
        </div>
        @endif

        {{-- Contact Info Bento --}}
 <div class="bento-card p-6 space-y-5">
          <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-tint-primary text-accent-primary flex items-center justify-center shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
              <p class="text-xs font-bold uppercase text-ink-muted">Alamat Yayasan</p>
              @if($site['address'])
                <p class="text-sm font-semibold text-ink mt-0.5">{{ $site['address'] }}</p>
                @if($site['maps_url'])
                  <a href="{{ $site['maps_url'] }}" target="_blank" rel="noopener" class="text-xs text-accent-primary font-semibold hover:underline mt-0.5 inline-block">Lihat di peta &rarr;</a>
                @endif
              @else
                <p class="text-xs text-ink-muted mt-0.5 leading-relaxed">
                  Alamat belum diisi — lengkapi <code class="px-1 py-0.5 rounded bg-paper-warm border border-line text-[10px] font-mono">'address'</code> pada resources/data/site.php
                </p>
              @endif
            </div>
          </div>

          <div class="w-full h-px bg-block"></div>

          <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-tint-forest text-accent-forest flex items-center justify-center shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div>
              <p class="text-xs font-bold uppercase text-ink-muted">Email Resmi</p>
              @if($site['email'])
                <a href="mailto:{{ $site['email'] }}" class="text-sm font-semibold text-ink mt-0.5 block hover:text-accent-primary">{{ $site['email'] }}</a>
              @else
                <p class="text-xs text-ink-muted mt-0.5">Email belum diisi</p>
              @endif
              @if($site['email_partner'])
                <p class="text-xs text-ink-muted mt-0.5">Kemitraan: {{ $site['email_partner'] }}</p>
              @endif
              @if($site['phone'])
                <p class="text-xs text-ink-muted mt-0.5">Telepon: {{ $site['phone'] }}</p>
              @endif
            </div>
          </div>
        </div>

        {{-- Social Media (hanya tampil kalau ada) --}}
        @if(array_filter($site['social']))
 <div class="bento-card p-6">
          <p class="text-xs font-bold uppercase text-ink-muted mb-3">Media Sosial Resmi</p>
          <div class="flex flex-wrap gap-2">
            @foreach($site['social'] as $platform => $url)
              @if($url)
              <a href="{{ $url }}" target="_blank" rel="noopener" class="px-3.5 py-2 rounded-xl bg-paper-warm border border-line text-xs font-semibold text-ink hover:border-primary-300 hover:text-accent-primary transition-colors capitalize">
                {{ $platform }}
              </a>
              @endif
            @endforeach
          </div>
        </div>
        @endif

      </div>

      {{-- Right Side: Interactive FAQ Accordion --}}
      <div class="lg:col-span-7 space-y-6">

 <div class="bento-card p-7 sm:p-9">
          <span class="badge-pill bg-tint-sun text-accent-sun border border-tint-sun-line text-[10px] mb-3">Tanya Jawab</span>
          <h2 class="font-serif font-bold text-2xl text-ink">Pertanyaan Yang Sering Diajukan (FAQ)</h2>

          @if(!empty($faqs ?? []))
          <div class="mt-6 space-y-3" id="faq-container">
            @foreach($faqs as $faq)
            <div class="border border-line rounded-2xl overflow-hidden faq-item transition-colors">
              <button type="button" class="w-full p-4 text-left font-bold text-sm text-ink flex items-center justify-between gap-4 faq-toggle">
                <span>{{ $faq['q'] ?? '' }}</span>
                <span class="text-accent-primary text-lg faq-icon">+</span>
              </button>
              <div class="px-4 pb-4 text-xs text-ink-muted leading-relaxed hidden faq-content">
                {!! $faq['a'] ?? '' !!}
              </div>
            </div>
            @endforeach
          </div>
          @else
          <div class="mt-6 p-6 sm:p-8 rounded-3xl bg-paper-warm border-2 border-dashed border-line text-center">
            <p class="font-serif text-base font-bold text-ink">FAQ belum diisi</p>
            <p class="text-xs text-ink-muted mt-1.5 leading-relaxed">
              Tambahkan pertanyaan &amp; jawaban pada file <code class="px-1.5 py-0.5 rounded bg-surface border border-line text-[11px] font-mono text-accent-primary">resources/data/faqs.php</code>.
            </p>
          </div>
          @endif
        </div>

      </div>

    </div>

  </div>
</section>

{{-- FAQ Script --}}
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const toggles = document.querySelectorAll('.faq-toggle');
    toggles.forEach(toggle => {
      toggle.addEventListener('click', () => {
        const content = toggle.nextElementSibling;
        const icon = toggle.querySelector('.faq-icon');
        const isHidden = content.classList.toggle('hidden');
        icon.textContent = isHidden ? '+' : '−';
        toggle.parentElement.classList.toggle('bg-paper-warm', !isHidden);
      });
    });
  });
</script>

@endsection