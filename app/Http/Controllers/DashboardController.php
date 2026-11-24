<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\IncomingLetter;
use App\Models\OutgoingLetter;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $awalBulan = now()->startOfMonth();
        $akhirBulan = now()->endOfMonth();

        $statistik = [
            'masuk' => IncomingLetter::count(),
            'keluar' => OutgoingLetter::count(),
            'bulanIni' => IncomingLetter::whereBetween('tanggal', [$awalBulan, $akhirBulan])->count()
                + OutgoingLetter::whereBetween('tanggal', [$awalBulan, $akhirBulan])->count(),
            'lampiran' => IncomingLetter::whereNotNull('lampiran')->count()
                + OutgoingLetter::whereNotNull('lampiran')->count(),
        ];

        $categories = Category::withCount(['incomingLetters', 'outgoingLetters'])
            ->orderBy('nama')
            ->get();

        $tanpaKategori = [
            'masuk' => IncomingLetter::whereNull('category_id')->count(),
            'keluar' => OutgoingLetter::whereNull('category_id')->count(),
        ];

        $terbaruMasuk = IncomingLetter::with('category')->latest('tanggal')->latest('id')->take(5)->get();
        $terbaruKeluar = OutgoingLetter::with('category')->latest('tanggal')->latest('id')->take(5)->get();

        return view('dashboard', compact(
            'statistik', 'categories', 'tanpaKategori', 'terbaruMasuk', 'terbaruKeluar'
        ));
    }
}
