<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;

class MahasiswaImport implements ToModel
{
    public function model(array $row)
    {
        return new Mahasiswa([
            'npm'     => $row[1],
            'nama'    => $row[2],
            'email'   => $row[3],
            'jurusan' => $row[4],
        ]);
    }
}
