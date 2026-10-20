<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $suratKeluar = [
            [
                'id' => 1,
                'nomor' => '001/SK/X/2026',
                'tanggal' => '2026-10-20',
                'tujuan' => 'Dinas Pendidikan',
                'perihal' => 'Permohonan Kerja Sama',
                'status' => 'Terkirim',
            ],
        ];

        return view('surat-keluar.index', compact('suratKeluar'));
    }
}