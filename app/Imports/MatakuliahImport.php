<?php

namespace App\Imports;

use App\Models\Matakuliah;
use Maatwebsite\Excel\Concerns\ToModel;

class MatakuliahImport implements ToModel
{
    public function model(array $row)
    {
        return new Matakuliah([
            'kode'     => $row[1],
            'nama'     => $row[2],
            'sks'      => $row[3],
            'semester' => $row[4],
        ]);
    }
}
