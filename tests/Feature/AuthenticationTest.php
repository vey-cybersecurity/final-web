<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertSee('Sign In');
    }

    public function test_register_screen_can_be_rendered(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
        $response->assertSee('Create Account');
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create([
            'email' => 'teacher@example.com',
            'password' => Hash::make('Secret123!'),
        ]);

        $response = $this->post(route('login'), [
            'email' => 'teacher@example.com',
            'password' => 'Secret123!',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard'));
    }

    public function test_users_cannot_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'email' => 'teacher@example.com',
            'password' => Hash::make('Secret123!'),
        ]);

        $response = $this->from(route('login'))->post(route('login'), [
            'email' => 'teacher@example.com',
            'password' => 'WrongPassword',
        ]);

        $this->assertGuest();
        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
    }

    public function test_users_can_register(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'Kosal Chan',
            'email' => 'kosal@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'kosal@example.com']);
        $response->assertRedirect(route('dashboard'));
    }

    public function test_authenticated_user_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $this->assertGuest();
        $response->assertRedirect(route('login'));
    }

    public function test_unauthenticated_users_are_redirected_to_login(): void
    {
        $this->get(route('dashboard'))->assertRedirect(route('login'));
        $this->get(route('departments.index'))->assertRedirect(route('login'));
        $this->get(route('students.index'))->assertRedirect(route('login'));
    }
}
