<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {

        User::create([
            'name' => 'admin',
            'email' =>'codelab@gmail.com',
            'phone' => '+959751025121',
            'gender' => 'male',
            'address' => 'Yangon',
            'role' => 'admin',
            'password' => Hash::make('admin12345'),
        ]);

    }
}
