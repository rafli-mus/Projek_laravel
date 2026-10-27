<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OutgoingLetterSeeder extends Seeder
{
    public function run(): void
    {
        $letters = [
            [
                'nomor_surat' => '001/OUT/X/2026',
                'tanggal' => '2026-10-10',
                'tujuan' => 'Fakultas Teknik',
                'perihal' => 'Undangan Rapat Koordinasi',
                'keterangan' => 'Surat undangan rapat koordinasi fakultas.',
            ],
            [
                'nomor_surat' => '002/OUT/X/2026',
                'tanggal' => '2026-10-15',
                'tujuan' => 'Bagian Akademik',
                'perihal' => 'Pemberitahuan Jadwal Ujian',
                'keterangan' => 'Pemberitahuan jadwal ujian semester.',
            ],
            [
                'nomor_surat' => '003/OUT/X/2026',
                'tanggal' => '2026-10-20',
                'tujuan' => 'LPPM',
                'perihal' => 'Permohonan Data Penelitian',
                'keterangan' => 'Permohonan data untuk keperluan penelitian.',
            ],
        ];

        foreach ($letters as $letter) {
            DB::table('outgoing_letters')->updateOrInsert(
                ['nomor_surat' => $letter['nomor_surat']],
                $letter + [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
