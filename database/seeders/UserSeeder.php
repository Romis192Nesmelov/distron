<?php

namespace Database\Seeders;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['email' => 'romis.nesmelov@gmail.com', 'password' => bcrypt('apg192')]
        ];

        foreach ($data as $user) {
            User::create($user);
        }
    }
}
