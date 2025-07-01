<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cek apakah user dengan NPM itu sudah ada
        $existingUser = \App\Models\User::where('npm', $row['npm'])->first();

        if (!$existingUser) {
            $user = User::create([
                'npm'      => $row['npm'],
                'name'     => $row['nama'],
                'email'    => $row['email'],
                'role'     => 'mahasiswa',
                'password' => Hash::make($row['npm']),
            ]);
        } else {
            $user = $existingUser;
        }

        // Cek apakah mahasiswa-nya juga sudah ada
        $existingMahasiswa = \App\Models\Mahasiswa::where('user_id', $user->id)->first();

        if (!$existingMahasiswa) {
            return new Mahasiswa([
                'user_id'  => $user->id,
                'jurusan'  => $row['jurusan'],
                'semester' => 1,
            ]);
        }

        // Kalau mahasiswa sudah ada, return null supaya baris di-skip
        return null;
    }
}
