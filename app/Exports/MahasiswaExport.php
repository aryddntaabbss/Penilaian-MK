<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MahasiswaExport implements FromCollection, WithHeadings
{
    /**
     * Ambil semua data mahasiswa dan relasi user
     */
    public function collection()
    {
        return Mahasiswa::with('user')
            ->get()
            ->map(function ($mhs) {
                return [
                    'npm'        => $mhs->user->npm,
                    'nama'       => $mhs->user->name,
                    'email'      => $mhs->user->email,
                    'role'       => $mhs->user->role,
                    'created_at' => $mhs->user->created_at->format('Y-m-d H:i:s'),
                    'jurusan'    => $mhs->jurusan,
                    'semester'   => $mhs->semester,
                    'status'     => $mhs->status(),
                ];
            });
    }

    /**
     * Header kolom di file Excel
     */
    public function headings(): array
    {
        return [
            'NPM',
            'Nama',
            'Email',
            'Role',
            'Dibuat Pada',
            'Jurusan',
            'Semester',
            'Status',
        ];
    }
}
