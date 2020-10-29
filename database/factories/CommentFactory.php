<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {

    [
        'body' => $faker->sentence($nbWords=10, $variableNbWords = true),
        'user_id' => $faker->numberBetween($min = 1, $max = 50),
        'post_id' => $faker->numberBetween($min = 1, $max = 50)
    ];
});

// class CommentFactory extends Factory
// {
//     /**
//      * The name of the factory's corresponding model.
//      *
//      * @var string
//      */
//     protected $model = Comment::class;

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
