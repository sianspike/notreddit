<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence($nbWords=5, $variableNbWords = true),
            'body' => $this->faker->paragraph($nbSentences=1, $variableNbSentences = true),
            'image_url' => null,
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
