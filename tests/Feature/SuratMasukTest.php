<?php

namespace Tests\Feature;

use App\Models\IncomingLetter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SuratMasukTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_incoming_letters(): void
    {
        IncomingLetter::create([
            'nomor_surat' => '001/IN/X/2026',
            'tanggal' => '2026-10-27',
            'pengirim' => 'Fakultas Teknik',
            'perihal' => 'Undangan Rapat',
        ]);

        $this->get(route('surat-masuk.index'))
            ->assertOk()
            ->assertSee('001/IN/X/2026')
            ->assertSee('Fakultas Teknik')
            ->assertSee('Undangan Rapat');
    }

    public function test_show_displays_an_incoming_letter(): void
    {
        $surat = IncomingLetter::create([
            'nomor_surat' => '002/IN/X/2026',
            'tanggal' => '2026-10-28',
            'pengirim' => 'BAA',
            'perihal' => 'Pemberitahuan Akademik',
            'keterangan' => 'Informasi kegiatan',
        ]);

        $this->get(route('surat-masuk.show', $surat))
            ->assertOk()
            ->assertSee('002/IN/X/2026')
            ->assertSee('BAA')
            ->assertSee('Pemberitahuan Akademik')
            ->assertSee('Informasi kegiatan');
    }

    public function test_show_returns_not_found_for_a_missing_letter(): void
    {
        $this->get(route('surat-masuk.show', 999))
            ->assertNotFound();
    }
}
