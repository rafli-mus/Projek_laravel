<?php

namespace Tests\Feature;

use App\Models\IncomingLetter;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_from_letter_pages(): void
    {
        $this->get(route('surat-masuk.index'))->assertRedirect(route('login'));
        $this->get(route('surat-keluar.index'))->assertRedirect(route('login'));
    }

    public function test_user_can_log_in_and_log_out(): void
    {
        User::factory()->create([
            'email' => 'petugas@example.test',
            'password' => Hash::make('local-password'),
            'role' => 'petugas',
        ]);

        $this->post(route('login.submit'), [
            'email' => 'petugas@example.test',
            'password' => 'local-password',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticated();

        $this->post(route('logout'))->assertRedirect(route('login'));

        $this->assertGuest();
    }

    public function test_invalid_credentials_return_to_login_with_an_error(): void
    {
        $this->from(route('login'))->post(route('login.submit'), [
            'email' => 'nobody@example.test',
            'password' => 'wrong-password',
        ])->assertRedirect(route('login'))->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_reader_can_view_letters_but_cannot_manage_them(): void
    {
        $reader = User::factory()->create(['role' => 'pembaca']);
        $letter = IncomingLetter::create([
            'nomor_surat' => '001/IN/XI/2026',
            'tanggal' => '2026-11-03',
            'pengirim' => 'Fakultas Teknik',
            'perihal' => 'Undangan Rapat',
        ]);

        $this->actingAs($reader)
            ->get(route('surat-masuk.index'))
            ->assertOk()
            ->assertSee('001/IN/XI/2026');

        $this->get(route('surat-masuk.show', $letter))->assertOk();
        $this->get(route('surat-masuk.create'))->assertForbidden();
        $this->get(route('surat-masuk.edit', $letter))->assertForbidden();
        $this->post(route('surat-masuk.store'), [])->assertForbidden();
        $this->put(route('surat-masuk.update', $letter), [])->assertForbidden();
        $this->delete(route('surat-masuk.destroy', $letter))->assertForbidden();
    }

    public function test_staff_can_manage_letters_and_reader_cannot_manage_outgoing_letters(): void
    {
        $staff = User::factory()->create(['role' => 'petugas']);

        $this->actingAs($staff)
            ->get(route('surat-masuk.create'))
            ->assertOk();

        $this->post(route('surat-masuk.store'), [
            'nomor_surat' => '002/IN/XI/2026',
            'tanggal' => '2026-11-03',
            'pengirim' => 'BAA',
            'perihal' => 'Pemberitahuan',
            'keterangan' => 'Informasi akademik',
        ])->assertRedirect(route('surat-masuk.index'));

        $reader = User::factory()->create(['role' => 'pembaca']);

        $this->actingAs($reader)
            ->get(route('surat-keluar.create'))
            ->assertForbidden();
    }

    public function test_missing_letter_returns_not_found_for_authenticated_user(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'pembaca']))
            ->get(route('surat-masuk.show', 999))
            ->assertNotFound();
    }
}
