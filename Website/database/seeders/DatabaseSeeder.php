<?php

namespace Database\Seeders;

use App\User;
use DB;
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
        DB::table('users')->insert([
            'name' => 'Tim Van den Borre',
            'birthdate' => now(),
            'phonenumber' => '0494 45 29 05',
            'email' => 'tim.vandenborre@outlook.com',
            'email_verified_at' => now(),
            'password' => bcrypt('$admin123'),
            'role' => 'Doctor',
            'remember_token' => Null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        \App\Models\User::factory(18)->create();
    }
}
