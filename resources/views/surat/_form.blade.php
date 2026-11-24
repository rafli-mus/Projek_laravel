{{--
    Form surat (dipakai create & edit Surat Masuk / Surat Keluar).
    Variabel: $action, $method, $surat (null saat create), $categories,
              $route ('surat-masuk' / 'surat-keluar'), $pihakField ('pengirim' / 'tujuan'), $pihakLabel
--}}
@if ($errors->any())
    <div role="alert" class="mb-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800">
        <p class="font-bold">Periksa kembali data yang dimasukkan:</p>
        <ul class="mt-2 list-inside list-disc space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="nomor_surat" class="label">Nomor Surat <span class="text-rose-600">*</span></label>
            <input id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $surat?->nomor_surat) }}" required placeholder="mis. 001/IN/XI/2026" class="field font-mono">
            @error('nomor_surat') <p class="field-error">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="tanggal" class="label">Tanggal <span class="text-rose-600">*</span></label>
            <input id="tanggal" type="date" name="tanggal" value="{{ old('tanggal', $surat?->tanggal?->format('Y-m-d')) }}" required class="field">
            @error('tanggal') <p class="field-error">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="{{ $pihakField }}" class="label">{{ $pihakLabel }} <span class="text-rose-600">*</span></label>
            <input id="{{ $pihakField }}" name="{{ $pihakField }}" value="{{ old($pihakField, $surat?->{$pihakField}) }}" required class="field">
            @error($pihakField) <p class="field-error">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="category_id" class="label">Kategori <span class="font-normal text-ink-faint">(opsional)</span></label>
            <select id="category_id" name="category_id" class="field">
                <option value="">-- Tanpa kategori --</option>
                @foreach ($categories as $kategori)
                    <option value="{{ $kategori->id }}" @selected(old('category_id', $surat->category_id ?? '') == $kategori->id)>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <p class="field-error">{{ $message }}</p> @enderror
        </div>
        <div class="sm:col-span-2">
            <label for="perihal" class="label">Perihal <span class="text-rose-600">*</span></label>
            <input id="perihal" name="perihal" value="{{ old('perihal', $surat?->perihal) }}" required class="field">
            @error('perihal') <p class="field-error">{{ $message }}</p> @enderror
        </div>
        <div class="sm:col-span-2">
            <label for="keterangan" class="label">Keterangan <span class="font-normal text-ink-faint">(opsional)</span></label>
            <textarea id="keterangan" name="keterangan" rows="4" class="field resize-y">{{ old('keterangan', $surat?->keterangan) }}</textarea>
            @error('keterangan') <p class="field-error">{{ $message }}</p> @enderror
        </div>
        <div class="sm:col-span-2">
            <label for="lampiran" class="label">Lampiran <span class="font-normal text-ink-faint">(PDF/JPG/PNG, maks. 2 MB)</span></label>
            <div class="rounded-xl border-2 border-dashed border-line bg-paper/40 p-4 transition focus-within:border-accent">
                <input id="lampiran" type="file" name="lampiran" accept=".pdf,.jpg,.jpeg,.png" class="block w-full text-sm text-ink-soft file:mr-4 file:rounded-lg file:border-0 file:bg-accent file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-accent/90">
                @if ($surat?->lampiran)
                    <p class="mt-3 text-xs text-ink-soft">Lampiran saat ini: <a href="{{ asset('storage/' . $surat->lampiran) }}" target="_blank" rel="noopener" class="font-semibold text-accent hover:underline">lihat file</a>. Pilih file baru untuk mengganti.</p>
                @endif
            </div>
            @error('lampiran') <p class="field-error">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="mt-8 flex flex-col-reverse gap-3 border-t border-line pt-6 sm:flex-row sm:justify-end">
        <a href="{{ route($route . '.index') }}" class="btn btn-outline">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan Surat</button>
    </div>
</form>
