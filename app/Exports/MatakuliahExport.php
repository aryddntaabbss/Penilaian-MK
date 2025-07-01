<?php

namespace App\Exports;

use App\Models\Matakuliah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MatakuliahExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Matakuliah::with('dosen')
            ->get()
            ->map(function ($mk) {
                return [
                    'kode'      => $mk->kode,
                    'nama'      => $mk->nama,
                    'sks'       => $mk->sks,
                    'semester'  => $mk->semester,
                    'dosen'     => $mk->dosen->name ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return ['Kode', 'Nama', 'SKS', 'Semester', 'Dosen Pengampu'];
    }
}
