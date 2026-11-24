{{-- Form cari & filter kategori (dipakai Surat Masuk dan Surat Keluar) --}}
<form method="GET" action="{{ route($route) }}" class="card mb-5 flex flex-col gap-3 p-3 sm:flex-row sm:items-center">
    <label class="relative flex-1">
        <span class="sr-only">Kata kunci</span>
        <svg class="pointer-events-none absolute top-1/2 left-3.5 h-4 w-4 -translate-y-1/2 text-ink-faint" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="{{ $placeholder }}" class="field pl-10">
    </label>
    <label>
        <span class="sr-only">Kategori</span>
        <select name="category_id" class="field sm:w-48">
            <option value="">Semua kategori</option>
            @foreach ($categories as $kategori)
                <option value="{{ $kategori->id }}" @selected(request('category_id') == $kategori->id)>
                    {{ $kategori->nama }}
                </option>
            @endforeach
        </select>
    </label>
    <div class="flex gap-2">
        <button type="submit" class="btn btn-primary flex-1 sm:flex-none">Cari / Filter</button>
        @if (request()->filled('q') || request()->filled('category_id'))
            <a href="{{ route($route) }}" class="btn btn-outline flex-1 sm:flex-none">Reset</a>
        @endif
    </div>
</form>
