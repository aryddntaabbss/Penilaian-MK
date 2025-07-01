<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nilai;

class NilaiTableSeeder extends Seeder
{
    public function run(): void
    {
        Nilai::create([
            'mahasiswa_id' => 1,
            'matakuliah_id' => 1,
            'dosen_id' => 1,
            'nilai' => 85
        ]);

        Nilai::create([
            'mahasiswa_id' => 2,
            'matakuliah_id' => 2,
            'dosen_id' => 2,
            'nilai' => 90
        ]);
    }
}
