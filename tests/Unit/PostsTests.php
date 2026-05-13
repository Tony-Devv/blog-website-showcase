<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTests extends TestCase
{


    public function authenticated_user_can_create_a_post()
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

  
    public function non_authenticated_user_cannot_edit_a_post()
    {
       
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        
        
        $response = $this->get(route('posts.edit', $post));
        
        // // Should redirect to login (not 403)
        // $response->assertRe;
    }
    
    
}