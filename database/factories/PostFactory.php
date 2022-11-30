<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->unique()->sentence(),
            'slug' => $this->faker->unique()->slug(),
            'excerpt' => $this->faker->paragraph(),
            'body' => $this->faker->paragraphs(5, true),
            'image_path' => $this->faker->imageUrl('1920', '1080'),
            'status' => $this->faker->randomElement([
                'draft',
                'published',
                'deleted',
            ]),
            'published_at' => $this->faker->dateTime(),
        ];
    }
}
