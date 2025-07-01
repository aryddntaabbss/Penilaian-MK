<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Buat akun User dulu
        $user = User::create([
            'nip'      => $row['nip'],
            'name'     => $row['nama'],
            'email'    => $row['email'],
            'role'     => 'dosen',
            'password' => Hash::make($row['nip']),
        ]);

        // Baru buat datanya di tabel dosen
        return new Dosen([
            'user_id' => $user->id,
            'jurusan' => $row['jurusan'],
            'jabatan' => $row['jabatan'],
        ]);
    }
}
