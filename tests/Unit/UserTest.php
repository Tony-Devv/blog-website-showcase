<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;


class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_posts_relationship_returns_has_many()
    {
        $user = new User();

        $this->assertInstanceOf(HasMany::class, $user->posts());
    }

    public function test_user_factory_creates_user_and_password_is_hashed()
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', ['email' => $user->email]);
        $this->assertTrue(Hash::check('password', $user->password));
    }

}
