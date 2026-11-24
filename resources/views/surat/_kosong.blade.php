{{-- Baris tabel saat data kosong --}}
<tr>
    <td colspan="{{ $colspan }}" class="px-6 py-16 text-center">
        <span class="stamp mx-auto -rotate-3 px-3 py-1 text-xs">Kosong</span>
        @if (request()->filled('q') || request()->filled('category_id'))
            <p class="mt-5 font-display text-lg font-semibold text-ink">Tidak ada surat yang cocok</p>
            <p class="mt-1 text-sm text-ink-soft">Coba kata kunci atau kategori lain.</p>
        @else
            <p class="mt-5 font-display text-lg font-semibold text-ink">Belum ada {{ $jenis }}</p>
            <p class="mt-1 text-sm text-ink-soft">Surat yang ditambahkan akan muncul di daftar ini.</p>
        @endif
    </td>
</tr>
