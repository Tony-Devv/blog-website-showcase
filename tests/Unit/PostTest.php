<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_user_relationship_returns_belongs_to()
    {
        $post = new Post();

        $this->assertInstanceOf(BelongsTo::class, $post->user());
    }

   
    public function test_post_has_expected_fillable_fields()
    {
        $post = new Post();

        $this->assertEquals(
            ['title', 'image', 'description', 'user_id'],
            $post->getFillable()
        );
    }
}
