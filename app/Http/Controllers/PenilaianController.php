<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use App\Models\Nilai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    public function index()
    {
        $dosenId = Auth::id();
        $matakuliah = Matakuliah::where('dosen_id', $dosenId)->get();

        return view('penilaian.index', compact('matakuliah'));
    }

    public function detail($matakuliah_id)
    {
        $matakuliah = Matakuliah::findOrFail($matakuliah_id);

        // Cek dosen yang login harus pemilik matakuliah
        if ($matakuliah->dosen_id != Auth::id()) {
            abort(403);
        }

        $mahasiswa = Mahasiswa::whereHas('kontrak', function ($q) use ($matakuliah_id) {
            $q->where('matakuliah_id', $matakuliah_id);
        })->get();

        $nilai = Nilai::where('matakuliah_id', $matakuliah_id)->get()->keyBy('mahasiswa_id');

        return view('penilaian.detail', compact('matakuliah', 'mahasiswa', 'nilai'));
    }

    public function simpan(Request $request, $matakuliah_id)
    {
        foreach ($request->nilai as $mahasiswa_id => $nilai) {
            Nilai::updateOrCreate(
                ['matakuliah_id' => $matakuliah_id, 'mahasiswa_id' => $mahasiswa_id],
                [
                    'dosen_id' => Auth::user()->dosen->id, // ini yg aman
                    'nilai' => $nilai
                ]
            );
        }


        return redirect()->route('penilaian.index')->with('success', 'Nilai berhasil disimpan');
    }
}
