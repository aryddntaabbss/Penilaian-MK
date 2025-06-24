<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;

class MahasiswaImport implements ToModel
{
    public function model(array $row)
    {
        return new Mahasiswa([
            'npm'     => $row['npm'],
            'nama'    => $row['nama'],
            'email'   => $row['email'],
            'jurusan' => $row['jurusan'],
        ]);
    }
}
