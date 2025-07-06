<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'jurusan',
        'semester',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->semester > 14 ? 'Drop Out' : 'Aktif';
    }

    public function kontrak()
    {
        return $this->belongsToMany(Matakuliah::class, 'kontrak_matakuliah', 'mahasiswa_id', 'matakuliah_id');
    }
}
