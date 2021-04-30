<?php

namespace Database\Seeders;

use App\User;
use App\Appointment;
use App\MedicalHistory;
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
            'role' => 'Admin',
            'remember_token' => Null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        \App\Models\User::factory(300)->create();

        DB::table('appointments')->insert([
            'patientID' => 2,
            'doctorID' => 1,
            'reason' => 'Pain in my head.',
            'startDate' => '2022-02-03 09:00:00',
            'endDate' => '2022-02-03 09:30:00'
        ]);

        DB::table('appointments')->insert([
            'patientID' => 2,
            'doctorID' => 1,
            'reason' => 'Pain in my throat.',
            'startDate' => '2022-02-04 09:00:00',
            'endDate' => '2022-02-04 09:30:00'
        ]);

        DB::table('appointments')->insert([
            'patientID' => 2,
            'doctorID' => 1,
            'reason' => 'Corona test.',
            'startDate' => '2022-02-05 09:00:00',
            'endDate' => '2022-02-05 09:30:00'
        ]);

        DB::table('medical_histories')->insert([
            'appointmentID' => 1,
            'condition' => 'Migraine',
            'date' => '2022-02-03 09:30:00'
        ]);

        DB::table('medical_histories')->insert([
            'appointmentID' => 3,
            'condition' => 'Corona',
            'date' => '2022-02-05 11:00:00'
        ]);

        DB::table('users')->insert([
            'name' => 'Ayse Asig',
            'birthdate' => now(),
            'phonenumber' => '0494 44 77 05',
            'email' => 'ayse.asig@outlook.com',
            'email_verified_at' => now(),
            'password' => bcrypt('$admin123'),
            'role' => 'Doctor',
            'remember_token' => Null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Semi Vittel',
            'birthdate' => now(),
            'phonenumber' => '0494 66 55 03',
            'email' => 'semi.vittel@outlook.com',
            'email_verified_at' => now(),
            'password' => bcrypt('$admin123'),
            'role' => 'Doctor',
            'remember_token' => Null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Rettita Schulist',
            'birthdate' => now(),
            'phonenumber' => '0494 22 23 09',
            'email' => 'retitta.schulist@outlook.com',
            'email_verified_at' => now(),
            'password' => bcrypt('$admin123'),
            'role' => 'Doctor',
            'remember_token' => Null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Joe Schulist',
            'birthdate' => now(),
            'phonenumber' => '0494 33 23 09',
            'email' => 'joe.schulist@outlook.com',
            'email_verified_at' => now(),
            'password' => bcrypt('$admin123'),
            'role' => 'Doctor',
            'remember_token' => Null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
