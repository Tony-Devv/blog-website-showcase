<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Ahmed',
            'username' => 'ahmed',
            'email' => 'ahmed@test.com',
            'password' => 'Ahmed@1234',
            'password_confirmation' => 'Ahmed@1234',
            'terms' => true,
        ]);

        $response->assertRedirect('/login');

        $this->assertDatabaseHas('users', [
            'email' => 'ahmed@test.com'
        ]);

    }

    public function test_register_requires_name()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'ahmed@test.com',
            'username' => 'ahmed',
            'password' => 'Ahmed@1234',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_register_requires_email()
    {
        $response = $this->post('/register', [
            'username' => 'ahmed',
            'name' => 'Ahmed',
            'email' => '',
            'password' => '12345678',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_register_requires_password()
    {
        $response = $this->post('/register', [
            'name' => 'Ahmed',
            'email' => 'ahmed@test.com',
            'password' => '',
        ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_register_requires_username()
    {
        $response = $this->post('/register', [
            'name' => 'Ahmed',
            'email' => 'ahmed@test.com',
            'username' => '',
            'password' => '12345678',
        ]);

        $response->assertSessionHasErrors('username');
    }
}
      