<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::firstOrCreate(
            ['email' => 'admin@aeroges.com'],
            [
            'name' => 'Admin',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]); 

        User::firstOrCreate(
            ['email' => 'develop@gmail.com'],
            [
            'name' => 'Carlos Lezama',
            'email_verified_at' => now(),
            'password' => Hash::make('develop'),
            'remember_token' => Str::random(10),
        ]); 

    }
}
