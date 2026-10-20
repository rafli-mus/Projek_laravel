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
    
        public function show($id)
        {
            $SuratKeluarShow = [
                1 => [
                    'nomor_surat' => '001/SK/X/2026',
                    'tanggal' => '2026-10-20',
                    'tujuan' => 'Dinas Pendidikan',
                    'perihal' => 'Permohonan Kerja Sama',
                ],
            ];

            if (!isset($SuratKeluarShow[$id])) {
                abort(404);
            }

            return view('surat-keluar.show', [
                'SuratKeluarShow' => $SuratKeluarShow[$id],
            ]);
        }

}