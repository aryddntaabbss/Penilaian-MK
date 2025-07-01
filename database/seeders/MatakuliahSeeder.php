<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matakuliah;

class MatakuliahSeeder extends Seeder
{
    public function run(): void
    {
        Matakuliah::create([
            'kode' => 'MK001',
            'nama' => 'Pemrograman Web',
            'sks' => 3,
            'semester' => 4,
            'dosen_id' => 5
        ]);

        Matakuliah::create([
            'kode' => 'MK002',
            'nama' => 'Basis Data',
            'sks' => 3,
            'semester' => 3,
            'dosen_id' => 6
        ]);
    }
}
