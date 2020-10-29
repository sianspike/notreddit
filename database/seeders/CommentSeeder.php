<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test_comment_one = new Comment;
        $test_comment_one->body = 'test body';
        $test_comment_one->user_id = 1;
        $test_comment_one->post_id = 1;
        $test_comment_one->save();

        factory(App\Models\Comment::class, 50)->create();
    }
}
