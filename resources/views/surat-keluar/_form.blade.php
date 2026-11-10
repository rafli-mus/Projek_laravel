@if ($errors->any())
    <div role="alert" class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800">
        <p class="font-bold">Periksa kembali data yang dimasukkan:</p>
        <ul class="mt-2 list-inside list-disc space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ $action }}" class="space-y-5">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div>
        <label for="nomor_surat" class="mb-2 block text-sm font-semibold text-slate-700">Nomor Surat <span class="text-rose-500">*</span></label>
        <input id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $surat?->nomor_surat) }}" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
        @error('nomor_surat') <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="tanggal" class="mb-2 block text-sm font-semibold text-slate-700">Tanggal <span class="text-rose-500">*</span></label>
        <input id="tanggal" type="date" name="tanggal" value="{{ old('tanggal', $surat?->tanggal?->format('Y-m-d')) }}" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
        @error('tanggal') <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="tujuan" class="mb-2 block text-sm font-semibold text-slate-700">Tujuan <span class="text-rose-500">*</span></label>
        <input id="tujuan" name="tujuan" value="{{ old('tujuan', $surat?->tujuan) }}" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
        @error('tujuan') <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="perihal" class="mb-2 block text-sm font-semibold text-slate-700">Perihal <span class="text-rose-500">*</span></label>
        <input id="perihal" name="perihal" value="{{ old('perihal', $surat?->perihal) }}" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
        @error('perihal') <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="keterangan" class="mb-2 block text-sm font-semibold text-slate-700">Keterangan <span class="font-normal text-slate-400">(opsional)</span></label>
        <textarea id="keterangan" name="keterangan" rows="4" class="w-full resize-y rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">{{ old('keterangan', $surat?->keterangan) }}</textarea>
        @error('keterangan') <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p> @enderror
    </div>
    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
        <a href="{{ route('surat-keluar.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-bold text-slate-600 transition hover:bg-slate-50">Batal</a>
        <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700">Simpan Surat</button>
    </div>
</form>
