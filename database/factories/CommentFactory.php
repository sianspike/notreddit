<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body' => $this->faker->sentence($nbWords=10, $variableNbWords = true),
            'user_id' => User::inRandomOrder()->first()->id,//$this->faker->numberBetween($min = 1, $max = 50),
            'post_id' => Post::inRandomOrder()->first()->id,//$this->faker->numberBetween($min = 1, $max = 50),
        ];
    }
}
