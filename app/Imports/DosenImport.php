<?php

namespace App\Imports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Dosen([
            'nip'    => $row['nip'],
            'nama'   => $row['nama'],
            'email'  => $row['email'],
            'prodi'  => $row['prodi'],
        ]);
    }
}
