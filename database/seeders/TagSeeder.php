<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $funnyTag = new Tag;
        $funnyTag -> name = "Funny";
        $funnyTag -> save();
        $funnyTag -> posts()->attach(1);
        $funnyTag -> posts()->attach(3);

        $seriousTag = new Tag;
        $seriousTag -> name = "Serious";
        $seriousTag -> save();

        $generalTag = new Tag;
        $generalTag -> name = "General";
        $generalTag -> save();

        $sadTag = new Tag;
        $sadTag -> name = "Sad";
        $sadTag -> save();

    }
}
