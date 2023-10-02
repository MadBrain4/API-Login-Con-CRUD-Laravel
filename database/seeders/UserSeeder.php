<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->count(50)->create();
        User::create([
            'name' => 'Daisy',
            'email' => 'Daisy@gmail.com',
            'password' => '12345678',
        ]);
    }
}
