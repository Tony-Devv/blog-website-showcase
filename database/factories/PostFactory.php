<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            // Uses a fake image URL or path
            'image' => fake()->imageUrl(1280, 720, 'business'), 
            'description' => fake()->paragraphs(3, true),
            // Automatically creates a new User or picks an existing one
            'user_id' => User::factory(), 
        ];
    }
}