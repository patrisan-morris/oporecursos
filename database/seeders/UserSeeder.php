<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder for creating a demo user.
 */
class UserSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        // Create a demo user with a predefined email and password
        User::create([
            'name' => 'Demo User',
            'email' => 'demo@opo.com',
            'password' => Hash::make('password'),
        ]);
    }
}
