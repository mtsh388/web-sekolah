<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@smaislamassyafiiyah01.sch.id',
            'password' => Hash::make('password123'), // Kata sandi yang di-hash agar aman
        ]);
    }
}
