<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    
    
    public function test_registeration_form_displayed()
    {
        $response = $this->get(route('register'));
        
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
        $response->assertSee('Create Account');
    }

    public function test_can_register_a_new_user()
    {
        $userData = [
            'name' => 'John Doe',
            
            'email' => 'john@example.com',
            'username' => 'johndoe',
            'password' => 'Ahmed@1234'
        ];

        $response = $this->post(route('register.store'), $userData);
        
        
        $response->assertRedirect(route('login'));
        $response->assertSessionHas('success', 'Account Created Successfully');
        
  
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
        
      
        $user = User::where('email', 'john@example.com')->first();
        $this->assertTrue(Hash::check('Ahmed@1234', $user->password));
    }

    public function test_requires_name_email_and_password_for_registration()
    {
        $response = $this->post(route('register.store'), []);
        
        $response->assertSessionHasErrors(['name', 'email', 'password', 'username']);
        
        
        $this->assertEquals(0, User::count());
    }

    public function test_displays_the_login_form()
    {
        $response = $this->get(route('login'));
        
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
        $response->assertSee('Login');
    }


    public function test_can_login_a_user_with_valid_credentials()
    {
        
        $user = User::factory()->create([
            'username' => 'johndoe',
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
        ]);
        
        $response = $this->post(route('login.check'), [
             'email' => 'john@example.com',
            'password' => 'password123'
        ]);
        
     
        $response->assertRedirect(route('posts.index'));
        $response->assertSessionHas('success', 'Logged in successfully');
        
   
        $this->assertAuthenticated();
        $this->assertAuthenticatedAs($user);
    }

}