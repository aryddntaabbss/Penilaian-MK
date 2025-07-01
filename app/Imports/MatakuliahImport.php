<?php

namespace App\Imports;

use App\Models\Matakuliah;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MatakuliahImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cari ID dosen berdasarkan nama
        $dosen = User::where('name', $row['dosen'])->first();

        return new Matakuliah([
            'kode'      => $row['kode'],
            'nama'      => $row['nama'],
            'sks'       => $row['sks'],
            'semester'  => $row['semester'],
            'dosen_id'  => $dosen ? $dosen->id : null,
        ]);
    }
}
