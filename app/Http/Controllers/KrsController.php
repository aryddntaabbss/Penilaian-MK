<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KrsController extends Controller
{
    public function index()
    {
        $matakuliah = Matakuliah::all();
        $mahasiswa = Auth::user()->mahasiswa;
        $krs = $mahasiswa->kontrak()->pluck('matakuliah_id')->toArray();

        return view('krs.index', compact('matakuliah', 'krs'));
    }

    public function store(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $request->validate([
            'matakuliah_id' => 'required|array'
        ]);

        $mahasiswa->kontrak()->sync($request->matakuliah_id);

        return redirect()->route('krs.index')->with('success', 'KRS berhasil disimpan.');
    }
}
