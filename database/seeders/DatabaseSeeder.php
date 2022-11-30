<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create()->each(function ($user) {
            Post::factory()->create([
                'user_id' => $user->id,
            ])->each(function ($post) {
                Category::factory(3)->create([
                    'post_id' => $post->id,
                ]);

                Comment::factory(3)->create([
                    'post_id' => $post->id,
                    'user_id' => $post->user_id,
                ]);

                Like::factory(2)->create([
                    'post_id' => $post->id,
                    'user_id' => $post->user_id,
                ]);
            });
        });
    }
}
