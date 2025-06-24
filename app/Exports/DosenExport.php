<?php

namespace App\Exports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DosenExport implements FromCollection, WithHeadings
{
    /**
     * Ambil data dosen dari database
     */
    public function collection()
    {
        return Dosen::select('nip', 'nama', 'email', 'prodi')->get();
    }

    /**
     * Header kolom di file Excel
     */
    public function headings(): array
    {
        return [
            'NIP',
            'Nama',
            'Email',
            'Prodi',
        ];
    }
}
