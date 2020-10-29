<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {

    [
        'title' => $faker->sentence($nbWords=5, $variableNbWords = true),
        'body' => $faker->paragraph($nbSentences=3, $variableNbSentences = true),
        'user_id' => $faker->numberBetween($min = 1, $max = 50)
    ];
});

// class PostFactory extends Factory
// {
//     /**
//      * The name of the factory's corresponding model.
//      *
//      * @var string
//      */
//     protected $model = Post::class;

//     /**
//      * Define the model's default state.
//      *
//      * @return array
//      */
//     public function definition()
//     {
//         return [
//             //
//         ];
//     }
// }
