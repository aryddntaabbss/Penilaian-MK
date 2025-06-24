<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Dosen;
use App\Exports\NilaiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = Nilai::with('mahasiswa', 'matakuliah', 'dosen')->get();
        return view('nilai.index', compact('nilai'));
    }

    public function create()
    {
        return view('nilai.create', [
            'mahasiswa' => Mahasiswa::all(),
            'matakuliah' => Matakuliah::all(),
            'dosen' => Dosen::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required',
            'matakuliah_id' => 'required',
            'dosen_id' => 'required',
            'nilai' => 'required|integer|between:0,100'
        ]);

        Nilai::create($request->all());
        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);
        return view('nilai.edit', [
            'nilai' => $nilai,
            'mahasiswa' => Mahasiswa::all(),
            'matakuliah' => Matakuliah::all(),
            'dosen' => Dosen::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mahasiswa_id' => 'required',
            'matakuliah_id' => 'required',
            'dosen_id' => 'required',
            'nilai' => 'required|integer|between:0,100'
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update($request->all());

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(new NilaiExport, 'data_nilai.xlsx');
    }
}
