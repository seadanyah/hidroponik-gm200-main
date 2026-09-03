<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Owner GM200',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('owner'),
            'role' => 'owner',
        ]);

        // ADMIN
        User::create([
            'name' => 'Admin GM200',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        // CUSTOMER
        User::create([
            'name' => 'Customer GM200',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('customer'),
            'role' => 'customer',
        ]);
    }
}
