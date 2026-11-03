<?php

namespace App\Http\Controllers;

use App\Models\OutgoingLetter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $suratKeluar = OutgoingLetter::latest('tanggal')->get();

        return view('surat-keluar.index', compact('suratKeluar'));
    }

    public function create()
    {
        return view('surat-keluar.create');
    }

    public function store(Request $request)
    {
        OutgoingLetter::create($this->validatedData($request));

        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil ditambahkan.');
    }

    public function show($id)
    {
        $surat = OutgoingLetter::findOrFail($id);

        return view('surat-keluar.show', compact('surat'));
    }

    public function edit($id)
    {
        $surat = OutgoingLetter::findOrFail($id);

        return view('surat-keluar.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $surat = OutgoingLetter::findOrFail($id);
        $surat->update($this->validatedData($request, $surat->id));

        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        OutgoingLetter::findOrFail($id)->delete();

        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil dihapus.');
    }

    private function validatedData(Request $request, ?int $ignoreId = null): array
    {
        $uniqueNumber = Rule::unique('outgoing_letters', 'nomor_surat');

        if ($ignoreId !== null) {
            $uniqueNumber->ignore($ignoreId);
        }

        return $request->validate([
            'nomor_surat' => ['required', 'string', 'max:255', $uniqueNumber],
            'tanggal' => ['required', 'date'],
            'tujuan' => ['required', 'string', 'max:255'],
            'perihal' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);
    }
}
