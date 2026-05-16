<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('12345678'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@test.com',
            'password' => '12345678',
        ]);

        $response->assertRedirect('/posts');

        $this->assertAuthenticated();
    }

    public function test_user_cannot_login_with_wrong_password()
    {
        $user = User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('12345678'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@test.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors();

        $this->assertGuest();
    }

    public function test_login_requires_email()
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => '12345678',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_login_requires_password()
    {
        $response = $this->post('/login', [
            'email' => 'test@test.com',
            'password' => '',
        ]);

        $response->assertSessionHasErrors('password');
    }
}