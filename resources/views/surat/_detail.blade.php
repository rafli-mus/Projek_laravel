{{--
    Lembar detail surat (dipakai Surat Masuk & Surat Keluar).
    Variabel: $surat, $route ('surat-masuk' / 'surat-keluar'), $judul, $pihakLabel, $pihak
--}}
<div class="mx-auto max-w-3xl">
    <a href="{{ route($route . '.index') }}" class="mb-6 inline-flex items-center gap-2 text-sm font-semibold text-ink-soft transition hover:text-accent"><span aria-hidden="true">←</span> Kembali ke daftar</a>

    <article class="card relative overflow-hidden">
        <div class="h-1.5 bg-accent"></div>

        {{-- Kop --}}
        <header class="relative border-b border-dashed border-line px-6 pt-8 pb-7 sm:px-10">
            <p class="eyebrow">{{ $judul }}</p>
            <h1 class="mt-3 max-w-xl font-display text-2xl leading-tight font-semibold tracking-tight sm:text-3xl">{{ $surat->perihal }}</h1>
            <p class="mt-3 font-mono text-xs text-ink-soft">No. {{ $surat->nomor_surat }}</p>

            <div class="mt-5 sm:absolute sm:top-8 sm:right-10 sm:mt-0">
                @if ($surat->category)
                    <span class="stamp rotate-[-6deg] px-3 py-1.5 text-xs">{{ $surat->category->nama }}</span>
                @else
                    <span class="stamp rotate-[-6deg] px-3 py-1.5 text-xs text-ink-faint">Tanpa kategori</span>
                @endif
            </div>
        </header>

        {{-- Isi --}}
        <dl class="grid sm:grid-cols-2">
            <div class="border-b border-line px-6 py-5 sm:px-10">
                <dt class="text-[11px] font-bold tracking-[0.14em] text-ink-faint uppercase">Tanggal</dt>
                <dd class="mt-1.5 font-semibold">{{ $surat->tanggal->format('d-m-Y') }}</dd>
            </div>
            <div class="border-b border-line px-6 py-5 sm:border-l sm:px-10">
                <dt class="text-[11px] font-bold tracking-[0.14em] text-ink-faint uppercase">{{ $pihakLabel }}</dt>
                <dd class="mt-1.5 font-semibold">{{ $pihak }}</dd>
            </div>
            <div class="border-b border-line px-6 py-5 sm:col-span-2 sm:px-10">
                <dt class="text-[11px] font-bold tracking-[0.14em] text-ink-faint uppercase">Keterangan</dt>
                <dd class="mt-1.5 leading-7 whitespace-pre-line text-ink-soft">{{ $surat->keterangan ?: 'Tidak ada keterangan.' }}</dd>
            </div>
            <div class="px-6 py-5 sm:col-span-2 sm:px-10">
                <dt class="text-[11px] font-bold tracking-[0.14em] text-ink-faint uppercase">Lampiran</dt>
                <dd class="mt-2">
                    @if ($surat->lampiran)
                        <a href="{{ asset('storage/' . $surat->lampiran) }}" target="_blank" rel="noopener" class="group inline-flex items-center gap-3 rounded-xl border border-line bg-paper/50 py-2.5 pr-4 pl-2.5 transition hover:border-accent">
                            <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-accent/10 font-mono text-[10px] font-medium text-accent uppercase">{{ pathinfo($surat->lampiran, PATHINFO_EXTENSION) }}</span>
                            <span class="text-sm font-semibold text-ink group-hover:text-accent">Lihat lampiran ↗</span>
                        </a>
                    @else
                        <p class="text-ink-soft">Tidak ada lampiran.</p>
                    @endif
                </dd>
            </div>
        </dl>

        <footer class="flex flex-col-reverse gap-3 border-t border-line bg-paper/50 px-6 py-4 sm:flex-row sm:justify-end sm:px-10">
            <a href="{{ route($route . '.index') }}" class="btn btn-outline">Kembali</a>
            @can('manage-letters')
                <a href="{{ route($route . '.edit', $surat->id) }}" class="btn btn-primary">Edit Surat</a>
            @endcan
        </footer>
    </article>
</div>
