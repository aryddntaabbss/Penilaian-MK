<?php

namespace App\Imports;

use App\Models\Matakuliah;
use Maatwebsite\Excel\Concerns\ToModel;

class MatakuliahImport implements ToModel
{
    public function model(array $row)
    {
        return new Matakuliah([
            'kode'     => $row['kode'],
            'nama'     => $row['nama'],
            'sks'      => $row['sks'],
            'semester' => $row['semester'],
        ]);
    }
}
