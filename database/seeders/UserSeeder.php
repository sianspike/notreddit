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
    public function run()
    {
        $test_user_one = new User;
        $test_user_one->username = 'sian';
        $test_user_one->email = '950574@swansea.ac.uk';
        $test_user_one->password = '1234';
        $test_user_one->save();

        $users = User::factory()->count(50)->create();
    }
}
