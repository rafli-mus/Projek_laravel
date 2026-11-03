<?php

namespace App\Http\Controllers;

use App\Models\IncomingLetter;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    public function index()
    {
        $suratMasuk = IncomingLetter::latest('tanggal')->get();

        return view('surat-masuk.index', compact('suratMasuk'));
    }

    public function create()
    {
        return view('surat-masuk.create');
    }

    public function store(Request $request)
    {
        IncomingLetter::create($this->validatedData($request));

        return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil ditambahkan.');
    }

    public function show(int $id)
    {
        $surat = IncomingLetter::findOrFail($id);

        return view('surat-masuk.show', compact('surat'));
    }

    public function edit(int $id)
    {
        $surat = IncomingLetter::findOrFail($id);

        return view('surat-masuk.edit', compact('surat'));
    }

    public function update(Request $request, int $id)
    {
        $surat = IncomingLetter::findOrFail($id);
        $surat->update($this->validatedData($request));

        return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        IncomingLetter::findOrFail($id)->delete();

        return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'nomor_surat' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'pengirim' => ['required', 'string', 'max:255'],
            'perihal' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);
    }
}
