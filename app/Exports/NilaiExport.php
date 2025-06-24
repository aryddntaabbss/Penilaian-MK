<?php

namespace App\Exports;

use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NilaiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Nilai::with('mahasiswa', 'matakuliah', 'dosen')->get()->map(function ($item) {
            return [
                'No'          => $item->id,
                'NPM'         => $item->mahasiswa->npm,
                'Mahasiswa'   => $item->mahasiswa->nama,
                'Matakuliah'  => $item->matakuliah->nama,
                'Kode MK'     => $item->matakuliah->kode,
                'Dosen'       => $item->dosen->nama,
                'NIDN'        => $item->dosen->nidn,
                'Nilai Angka' => $item->nilai,
                'Nilai Huruf' => $this->konversiHuruf($item->nilai),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'NPM',
            'Mahasiswa',
            'Matakuliah',
            'Kode MK',
            'Dosen',
            'NIDN',
            'Nilai Angka',
            'Nilai Huruf',
        ];
    }

    private function konversiHuruf($nilai)
    {
        if ($nilai >= 90) return 'A';
        if ($nilai >= 75) return 'AB';
        if ($nilai >= 65) return 'B';
        if ($nilai >= 55) return 'BC';
        if ($nilai >= 45) return 'C';
        if ($nilai >= 35) return 'D';
        return 'E';
    }
}
