<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';


    protected $fillable = ['mahasiswa_id', 'matakuliah_id', 'dosen_id', 'nilai'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function getHurufAttribute()
    {
        $nilai = $this->nilai;

        if ($nilai >= 90 && $nilai <= 100) {
            return 'A';
        } elseif ($nilai >= 75 && $nilai <= 89) {
            return 'AB';
        } elseif ($nilai >= 65 && $nilai <= 74) {
            return 'B';
        } elseif ($nilai >= 55 && $nilai <= 64) {
            return 'BC';
        } elseif ($nilai >= 45 && $nilai <= 54) {
            return 'C';
        } elseif ($nilai >= 35 && $nilai <= 44) {
            return 'D';
        } else {
            return 'E';
        }
    }
}
