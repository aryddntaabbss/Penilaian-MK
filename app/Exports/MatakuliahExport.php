<?php

namespace App\Exports;

use App\Models\Matakuliah;
use Maatwebsite\Excel\Concerns\FromCollection;

class MatakuliahExport implements FromCollection
{
    public function collection()
    {
        return Matakuliah::all();
    }
}
