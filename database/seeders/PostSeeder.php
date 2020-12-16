<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test_post_one = new Post;
        $test_post_one->title = 'test title';
        $test_post_one->body = 'test body';
        $test_post_one->user_id = 1;
        $test_post_one->save();

        $posts = Post::factory()->count(10)->create();
    }
}
