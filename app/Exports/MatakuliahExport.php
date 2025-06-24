<?php

namespace App\Exports;

use App\Models\Matakuliah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MatakuliahExport implements FromCollection, WithHeadings
{
    /**
     * Ambil data matakuliah dari database
     */
    public function collection()
    {
        return Matakuliah::select('kode', 'nama', 'sks', 'semester')->get();
    }

    /**
     * Header kolom di file Excel
     */
    public function headings(): array
    {
        return [
            'Kode',
            'Nama',
            'SKS',
            'Semester',
        ];
    }
}
