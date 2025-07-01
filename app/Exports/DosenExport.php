<?php

namespace App\Exports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DosenExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Dosen::with('user')->get()->map(function ($dosen) {
            return [
                'nip'      => $dosen->user->nip,
                'nama'     => $dosen->user->name,
                'email'    => $dosen->user->email,
                'jurusan'  => $dosen->jurusan,
                'jabatan'  => $dosen->jabatan,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NIP',
            'Nama',
            'Email',
            'Jurusan',
            'Jabatan',
        ];
    }
}
