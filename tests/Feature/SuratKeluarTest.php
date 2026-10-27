<?php

namespace Tests\Feature;

use App\Models\OutgoingLetter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SuratKeluarTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_outgoing_letters(): void
    {
        OutgoingLetter::create([
            'nomor_surat' => '001/OUT/X/2026',
            'tanggal' => '2026-10-27',
            'tujuan' => 'Fakultas Teknik',
            'perihal' => 'Undangan Rapat',
            'keterangan' => 'Surat undangan rapat.',
        ]);

        $this->get(route('surat-keluar.index'))
            ->assertOk()
            ->assertSee('001/OUT/X/2026')
            ->assertSee('27-10-2026')
            ->assertSee('Fakultas Teknik')
            ->assertSee('Undangan Rapat')
            ->assertSee('Surat undangan rapat.');
    }

    public function test_show_displays_an_outgoing_letter(): void
    {
        $surat = OutgoingLetter::create([
            'nomor_surat' => '002/OUT/X/2026',
            'tanggal' => '2026-10-28',
            'tujuan' => 'Bagian Akademik',
            'perihal' => 'Pemberitahuan',
            'keterangan' => 'Informasi akademik.',
        ]);

        $this->get(route('surat-keluar.show', $surat))
            ->assertOk()
            ->assertSee('002/OUT/X/2026')
            ->assertSee('28-10-2026')
            ->assertSee('Bagian Akademik')
            ->assertSee('Pemberitahuan')
            ->assertSee('Informasi akademik.');
    }

    public function test_show_returns_not_found_for_a_missing_letter(): void
    {
        $this->get(route('surat-keluar.show', 999))
            ->assertNotFound();
    }
}
