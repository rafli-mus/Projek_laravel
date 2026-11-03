<?php

namespace Tests\Feature;

use App\Models\IncomingLetter;
use App\Models\OutgoingLetter;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LetterCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_staff_can_create_edit_and_delete_incoming_letters_with_validation(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'petugas']));

        $this->get(route('surat-masuk.index'))->assertOk();
        $this->get(route('surat-masuk.create'))->assertOk();

        $this->from(route('surat-masuk.create'))
            ->post(route('surat-masuk.store'), [
                'tanggal' => '2026-11-03',
                'pengirim' => 'Fakultas Teknik',
                'perihal' => 'Undangan Seminar',
            ])
            ->assertRedirect(route('surat-masuk.create'))
            ->assertSessionHasErrors('nomor_surat');

        $this->assertDatabaseCount('incoming_letters', 0);

        $this->post(route('surat-masuk.store'), [
            'nomor_surat' => '004/FT/X/2026',
            'tanggal' => '2026-10-25',
            'pengirim' => 'Fakultas Teknik',
            'perihal' => 'Undangan Seminar',
            'keterangan' => 'Seminar tahunan',
        ])->assertRedirect(route('surat-masuk.index'))
            ->assertSessionHas('success', 'Surat masuk berhasil ditambahkan.');

        $letter = IncomingLetter::where('nomor_surat', '004/FT/X/2026')->firstOrFail();

        $this->get(route('surat-masuk.show', $letter))->assertOk()->assertSee('Undangan Seminar');
        $this->get(route('surat-masuk.edit', $letter))->assertOk()->assertSee('Undangan Seminar');

        $this->put(route('surat-masuk.update', $letter), [
            'nomor_surat' => '004/FT/X/2026',
            'tanggal' => '2026-10-25',
            'pengirim' => 'Fakultas Teknik',
            'perihal' => 'Undangan Seminar Nasional',
            'keterangan' => 'Jadwal diperbarui',
        ])->assertRedirect(route('surat-masuk.index'))
            ->assertSessionHas('success', 'Surat masuk berhasil diperbarui.');

        $this->assertDatabaseHas('incoming_letters', [
            'id' => $letter->id,
            'perihal' => 'Undangan Seminar Nasional',
        ]);

        $this->delete(route('surat-masuk.destroy', $letter))
            ->assertRedirect(route('surat-masuk.index'))
            ->assertSessionHas('success', 'Surat masuk berhasil dihapus.');

        $this->assertDatabaseMissing('incoming_letters', ['id' => $letter->id]);
    }

    public function test_staff_can_create_edit_and_delete_outgoing_letters_with_validation(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'petugas']));

        $this->get(route('surat-keluar.index'))->assertOk();
        $this->get(route('surat-keluar.create'))->assertOk();

        $this->from(route('surat-keluar.create'))
            ->post(route('surat-keluar.store'), [
                'tanggal' => '2026-11-03',
                'tujuan' => 'Fakultas Teknik',
                'perihal' => 'Pemberitahuan',
            ])
            ->assertRedirect(route('surat-keluar.create'))
            ->assertSessionHasErrors('nomor_surat');

        $this->assertDatabaseCount('outgoing_letters', 0);

        $this->post(route('surat-keluar.store'), [
            'nomor_surat' => '004/OUT/XI/2026',
            'tanggal' => '2026-11-03',
            'tujuan' => 'Fakultas Teknik',
            'perihal' => 'Pemberitahuan',
            'keterangan' => 'Informasi seminar',
        ])->assertRedirect(route('surat-keluar.index'))
            ->assertSessionHas('success', 'Surat keluar berhasil ditambahkan.');

        $letter = OutgoingLetter::where('nomor_surat', '004/OUT/XI/2026')->firstOrFail();

        $this->get(route('surat-keluar.show', $letter))->assertOk()->assertSee('Pemberitahuan');
        $this->get(route('surat-keluar.edit', $letter))->assertOk()->assertSee('Pemberitahuan');

        $this->put(route('surat-keluar.update', $letter), [
            'nomor_surat' => '004/OUT/XI/2026',
            'tanggal' => '2026-11-03',
            'tujuan' => 'Fakultas Teknik',
            'perihal' => 'Pemberitahuan Seminar',
            'keterangan' => 'Informasi seminar terbaru',
        ])->assertRedirect(route('surat-keluar.index'))
            ->assertSessionHas('success', 'Surat keluar berhasil diperbarui.');

        $this->assertDatabaseHas('outgoing_letters', [
            'id' => $letter->id,
            'perihal' => 'Pemberitahuan Seminar',
        ]);

        $this->delete(route('surat-keluar.destroy', $letter))
            ->assertRedirect(route('surat-keluar.index'))
            ->assertSessionHas('success', 'Surat keluar berhasil dihapus.');

        $this->assertDatabaseMissing('outgoing_letters', ['id' => $letter->id]);
    }
}
