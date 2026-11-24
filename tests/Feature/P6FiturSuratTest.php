<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\IncomingLetter;
use App\Models\OutgoingLetter;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class P6FiturSuratTest extends TestCase
{
    use RefreshDatabase;

    private User $petugas;

    private User $pembaca;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        $this->seed(CategorySeeder::class);
        $this->petugas = User::factory()->create(['role' => 'petugas']);
        $this->pembaca = User::factory()->create(['role' => 'pembaca']);
    }

    private function dataSurat(array $override = []): array
    {
        return array_merge([
            'nomor_surat' => '010/IN/XI/2026',
            'tanggal' => '2026-11-24',
            'pengirim' => 'Dinas Pendidikan',
            'perihal' => 'Undangan Workshop',
            'keterangan' => 'Contoh',
        ], $override);
    }

    public function test_category_seeder_is_idempotent(): void
    {
        $this->seed(CategorySeeder::class);

        $this->assertSame(3, Category::count());
    }

    public function test_relations_belongs_to_and_has_many(): void
    {
        $kategori = Category::where('nama', 'Undangan')->first();
        $surat = IncomingLetter::create($this->dataSurat(['category_id' => $kategori->id]));

        $this->assertTrue($surat->category->is($kategori));
        $this->assertTrue($kategori->incomingLetters->first()->is($surat));
    }

    public function test_staff_can_store_letter_with_category_and_pdf(): void
    {
        $kategori = Category::first();

        $this->actingAs($this->petugas)
            ->post(route('surat-masuk.store'), $this->dataSurat([
                'category_id' => $kategori->id,
                'lampiran' => UploadedFile::fake()->create('surat.pdf', 500, 'application/pdf'),
            ]))
            ->assertRedirect(route('surat-masuk.index'));

        $surat = IncomingLetter::first();
        $this->assertSame($kategori->id, $surat->category_id);
        Storage::disk('public')->assertExists($surat->lampiran);

        $this->get(route('surat-masuk.show', $surat->id))
            ->assertOk()
            ->assertSee($kategori->nama)
            ->assertSee('Lihat lampiran');
    }

    public function test_staff_can_store_letter_without_category(): void
    {
        $this->actingAs($this->petugas)
            ->post(route('surat-masuk.store'), $this->dataSurat())
            ->assertRedirect(route('surat-masuk.index'));

        $this->assertNull(IncomingLetter::first()->category_id);
    }

    public function test_invalid_attachment_and_category_are_rejected(): void
    {
        $this->actingAs($this->petugas)
            ->post(route('surat-masuk.store'), $this->dataSurat([
                'lampiran' => UploadedFile::fake()->create('virus.exe', 10),
            ]))
            ->assertSessionHasErrors('lampiran');

        $this->post(route('surat-masuk.store'), $this->dataSurat([
            'lampiran' => UploadedFile::fake()->create('besar.pdf', 3000, 'application/pdf'),
        ]))->assertSessionHasErrors('lampiran');

        $this->post(route('surat-masuk.store'), $this->dataSurat(['category_id' => 999]))
            ->assertSessionHasErrors('category_id');

        $this->assertSame(0, IncomingLetter::count());
    }

    public function test_search_filter_and_pagination_keep_query_string(): void
    {
        $undangan = Category::where('nama', 'Undangan')->first();
        $lain = Category::where('nama', 'Permohonan')->first();

        foreach (range(1, 7) as $i) {
            IncomingLetter::create($this->dataSurat([
                'nomor_surat' => "U-{$i}",
                'pengirim' => "Pengirim Undangan {$i}",
                'category_id' => $undangan->id,
            ]));
        }
        IncomingLetter::create($this->dataSurat([
            'nomor_surat' => 'P-1',
            'pengirim' => 'Kampus Lain',
            'perihal' => 'Permohonan Data',
            'category_id' => $lain->id,
        ]));

        $this->actingAs($this->pembaca)
            ->get(route('surat-masuk.index', ['q' => 'Kampus Lain']))
            ->assertOk()
            ->assertSee('P-1')
            ->assertDontSee('U-1');

        $response = $this->get(route('surat-masuk.index', ['category_id' => $undangan->id]));
        $response->assertOk()
            ->assertSee('Halaman 1 dari 2')
            ->assertDontSee('P-1');
        $this->assertStringContainsString('category_id='.$undangan->id, $response->viewData('suratMasuk')->nextPageUrl());

        $this->get(route('surat-masuk.index', ['category_id' => $undangan->id, 'page' => 2]))
            ->assertOk()
            ->assertSee('Halaman 2 dari 2')
            ->assertDontSee('P-1');
    }

    public function test_update_replaces_attachment_and_keeps_old_one_when_no_new_file(): void
    {
        $this->actingAs($this->petugas)->post(route('surat-masuk.store'), $this->dataSurat([
            'lampiran' => UploadedFile::fake()->image('lama.jpg'),
        ]));
        $surat = IncomingLetter::first();
        $pathLama = $surat->lampiran;

        $kategori = Category::where('nama', 'Pemberitahuan')->first();
        $this->put(route('surat-masuk.update', $surat->id), $this->dataSurat(['category_id' => $kategori->id]))
            ->assertRedirect(route('surat-masuk.index'));
        $this->assertSame($pathLama, $surat->fresh()->lampiran);
        $this->assertSame($kategori->id, $surat->fresh()->category_id);

        $this->put(route('surat-masuk.update', $surat->id), $this->dataSurat([
            'lampiran' => UploadedFile::fake()->create('baru.pdf', 100, 'application/pdf'),
        ]));
        $pathBaru = $surat->fresh()->lampiran;
        $this->assertNotSame($pathLama, $pathBaru);
        Storage::disk('public')->assertMissing($pathLama);
        Storage::disk('public')->assertExists($pathBaru);
    }

    public function test_destroy_deletes_record_and_attachment(): void
    {
        $this->actingAs($this->petugas)->post(route('surat-masuk.store'), $this->dataSurat([
            'lampiran' => UploadedFile::fake()->create('hapus.pdf', 100, 'application/pdf'),
        ]));
        $surat = IncomingLetter::first();

        $this->delete(route('surat-masuk.destroy', $surat->id))->assertRedirect(route('surat-masuk.index'));

        $this->assertModelMissing($surat);
        Storage::disk('public')->assertMissing($surat->lampiran);
    }

    public function test_reader_can_view_but_cannot_manage_and_guest_is_redirected(): void
    {
        $surat = IncomingLetter::create($this->dataSurat());

        $this->actingAs($this->pembaca);
        $this->get(route('surat-masuk.index'))->assertOk()->assertDontSee('Tambah Surat');
        $this->get(route('surat-masuk.show', $surat->id))->assertOk();
        $this->get(route('surat-masuk.create'))->assertForbidden();
        $this->get(route('surat-masuk.edit', $surat->id))->assertForbidden();
        $this->post(route('surat-masuk.store'), $this->dataSurat())->assertForbidden();
        $this->get(route('surat-keluar.create'))->assertForbidden();

        auth()->logout();
        $this->get(route('surat-masuk.index'))->assertRedirect(route('login'));
        $this->get(route('surat-masuk.show', $surat->id))->assertRedirect(route('login'));
    }

    public function test_old_letter_without_category_still_displays(): void
    {
        $surat = IncomingLetter::create($this->dataSurat());

        $this->actingAs($this->pembaca)
            ->get(route('surat-masuk.index'))
            ->assertOk()
            ->assertSee('Tanpa kategori');
        $this->get(route('surat-masuk.show', $surat->id))
            ->assertOk()
            ->assertSee('Tanpa kategori')
            ->assertSee('Tidak ada lampiran.');
    }

    public function test_dashboard_shows_statistics_and_latest_letters(): void
    {
        IncomingLetter::create($this->dataSurat([
            'category_id' => Category::where('nama', 'Undangan')->value('id'),
        ]));

        $this->actingAs($this->pembaca)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Sebaran kategori')
            ->assertSee('Undangan Workshop')
            ->assertSee('Dari Dinas Pendidikan')
            ->assertViewHas('statistik', fn ($s) => $s['masuk'] === 1 && $s['keluar'] === 0);
    }

    public function test_outgoing_letters_support_category_search_and_attachment(): void
    {
        $kategori = Category::where('nama', 'Undangan')->first();

        $this->actingAs($this->petugas)
            ->post(route('surat-keluar.store'), [
                'nomor_surat' => '020/OUT/XI/2026',
                'tanggal' => '2026-11-24',
                'tujuan' => 'Rektorat',
                'perihal' => 'Undangan Rapat',
                'category_id' => $kategori->id,
                'lampiran' => UploadedFile::fake()->create('keluar.pdf', 100, 'application/pdf'),
            ])
            ->assertRedirect(route('surat-keluar.index'));

        $surat = OutgoingLetter::first();
        $this->assertSame($kategori->id, $surat->category_id);
        Storage::disk('public')->assertExists($surat->lampiran);

        $this->get(route('surat-keluar.index', ['q' => 'Rektorat', 'category_id' => $kategori->id]))
            ->assertOk()
            ->assertSee('020/OUT/XI/2026');
        $this->get(route('surat-keluar.index', ['q' => 'Tidak Ada']))
            ->assertOk()
            ->assertSee('Tidak ada surat yang cocok');

        $this->delete(route('surat-keluar.destroy', $surat->id));
        Storage::disk('public')->assertMissing($surat->lampiran);
    }
}
