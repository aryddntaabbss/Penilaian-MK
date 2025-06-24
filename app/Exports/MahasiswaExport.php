<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MahasiswaExport implements FromCollection, WithHeadings
{
    /**
     * Ambil data mahasiswa dari database
     */
    public function collection()
    {
        return Mahasiswa::select('npm', 'nama', 'email', 'jurusan')->get();
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
            'Jurusan',
        ];
    }
}
