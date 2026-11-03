@if ($errors->any())
    <div role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ $action }}">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <p>
        <label for="nomor_surat">Nomor Surat</label><br>
        <input id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $surat?->nomor_surat) }}" required>
    </p>
    <p>
        <label for="tanggal">Tanggal</label><br>
        <input id="tanggal" type="date" name="tanggal" value="{{ old('tanggal', $surat?->tanggal?->format('Y-m-d')) }}" required>
    </p>
    <p>
        <label for="tujuan">Tujuan</label><br>
        <input id="tujuan" name="tujuan" value="{{ old('tujuan', $surat?->tujuan) }}" required>
    </p>
    <p>
        <label for="perihal">Perihal</label><br>
        <input id="perihal" name="perihal" value="{{ old('perihal', $surat?->perihal) }}" required>
    </p>
    <p>
        <label for="keterangan">Keterangan</label><br>
        <textarea id="keterangan" name="keterangan">{{ old('keterangan', $surat?->keterangan) }}</textarea>
    </p>
    <button type="submit">Simpan</button>
    <a href="{{ route('surat-keluar.index') }}">Batal</a>
</form>
