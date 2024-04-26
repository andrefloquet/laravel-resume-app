<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(5, true);

        return [
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title, '-'),
            'excerpt' => fake()->sentence(12, true),
            'body' => fake()->paragraph(8, true),
        ];
    }
}
