<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    public function index(){
        //return 'halaman surat masuk dari controller';
        $SuratMasuk= [
            [
            'id'            => 1,
            'nomor_surat'   => '001/ft//x/2026',
            'tanggal'       => '13-10-2026',
            'pengirim'      => 'BAA',
            'perihal'       => 'Fakultas teknik'
            ],

            [
            'id'            => 2,
            'nomor_surat'   => '002/lpm//x/2026',
            'tanggal'       => '18-10-2026',
            'pengirim'      => 'LPM',
            'perihal'       => 'Sosialisai Pedoman'
            ],

            [
            'id'            => 3,
            'nomor_surat'   => '004/prodi//x/2026',
            'tanggal'       => '21-10-2026',
            'pengirim'      => 'BLK',
            'perihal'       => 'Surat Izin'
            ]
        ];
        return view('surat-masuk.index', compact('SuratMasuk'));
    }

    public function show($id){

        $SuratMasukShow = [
        1 =>[
            'id'            => 1,
            'nomor_surat'   => '001/ft//x/2026',
            'tanggal'       => '13-10-2026',
            'pengirim'      => 'BAA',
            'perihal'       => 'Fakultas teknik'
            ],

        2 =>[
            'id'            => 2,
            'nomor_surat'   => '002/lpm//x/2026',
            'tanggal'       => '18-10-2026',
            'pengirim'      => 'LPM',
            'perihal'       => 'Sosialisai Pedoman'
            ],

        3 =>[
            'id'            => 3,
            'nomor_surat'   => '004/prodi//x/2026',
            'tanggal'       => '21-10-2026',
            'pengirim'      => 'BLK',
            'perihal'       => 'Surat Izin'
            ]
        ];
        $SuratMasukShow = $SuratMasukShow[$id] ?? null;
         return view('surat-masuk.show', compact('SuratMasukShow'));
    }
}
//mencari projek sistem informasi yang di pandu oleh 
//laravel kemudian di pelajari