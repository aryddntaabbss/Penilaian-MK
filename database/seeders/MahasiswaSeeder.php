<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua user yang role-nya mahasiswa
        $mahasiswaUsers = User::where('role', 'mahasiswa')->get();

        foreach ($mahasiswaUsers as $user) {
            Mahasiswa::create([
                'user_id'  => $user->id,
                'jurusan'  => 'Teknik Informatika',
                'semester' => rand(1, 14),
            ]);
        }
    }
}
