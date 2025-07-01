<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TU
        User::create([
            'npm' => null,
            'nip' => '198001012005011001',
            'name' => 'Admin TU',
            'email' => 'tu@example.com',
            'role' => 'tu',
            'password' => Hash::make('password'),
        ]);

        // Mahasiswa 1
        User::create([
            'npm' => '07352111101',
            'nip' => null,
            'name' => 'Andi Wijaya',
            'email' => 'andi@example.com',
            'role' => 'mahasiswa',
            'password' => Hash::make('password'),
        ]);

        // Mahasiswa 2
        User::create([
            'npm' => '07352111102',
            'nip' => null,
            'name' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'role' => 'mahasiswa',
            'password' => Hash::make('password'),
        ]);
    }
}
