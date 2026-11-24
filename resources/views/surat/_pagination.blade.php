{{-- Navigasi halaman sederhana (query string filter ikut terbawa lewat withQueryString) --}}
@if ($paginator->hasPages())
    <nav class="flex items-center justify-between gap-3 border-t border-line px-6 py-4 text-sm" aria-label="Navigasi halaman">
        @if ($paginator->previousPageUrl())
            <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-outline py-1.5">← Sebelumnya</a>
        @else
            <span class="btn border border-line py-1.5 text-ink-faint/60">← Sebelumnya</span>
        @endif
        <span class="text-ink-soft">Halaman {{ $paginator->currentPage() }} dari {{ $paginator->lastPage() }}</span>
        @if ($paginator->nextPageUrl())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-outline py-1.5">Berikutnya →</a>
        @else
            <span class="btn border border-line py-1.5 text-ink-faint/60">Berikutnya →</span>
        @endif
    </nav>
@endif
