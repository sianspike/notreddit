<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $user = new User;
        $user -> username = 'Sian';
        $user -> email = 'sian.pike@icloud.com';
        $user -> password = 'test1234';
        $user -> role = 'admin';
        $user -> save();

        User::factory()->count(10)->create();
    }
}
