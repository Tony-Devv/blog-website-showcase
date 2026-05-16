<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    
    public function test_authenticated_user_can_create_a_post()
    {
        $user = User::factory()->create();

        $postData = [
            'title' => 'My First Blog Post',
            'description' => 'This is the content of my first post.',
        ];

        $response = $this->actingAs($user)
            ->post(route('posts.store'), $postData);

        $response->assertRedirect(route('posts.index'));

        $this->assertDatabaseHas('posts', [
            'title' => 'My First Blog Post',
            'user_id' => $user->id,
        ]);
    }


    public function test_non_authenticated_user_cannot_create_a_post()
    {
        $postData = [
            'title' => 'My First Blog Post',
            'description' => 'This is the content of my first post.',
        ];

        $response = $this->post(route('posts.store'), $postData);

        
        $response->assertRedirect('/login');

        $this->assertDatabaseMissing('posts', [
            'title' => 'My First Blog Post',
            'description' => 'This is the content of my first post.'
        ]);
    }
}