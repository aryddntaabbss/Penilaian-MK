<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;

class MahasiswaImport implements ToModel
{
    public function model(array $row)
    {
        return new Mahasiswa([
            'npm'     => $row[0],
            'nama'    => $row[1],
            'email'   => $row[2],
            'jurusan' => $row[3],
        ]);
    }
}
