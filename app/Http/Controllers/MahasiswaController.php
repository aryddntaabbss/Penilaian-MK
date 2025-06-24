<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'npm' => 'required|unique:mahasiswa',
            'nama' => 'required',
            'email' => 'required|email|unique:mahasiswa',
            'jurusan' => 'required',
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'npm' => 'required|unique:mahasiswa,npm,' . $mahasiswa->id,
            'nama' => 'required',
            'email' => 'required|email|unique:mahasiswa,email,' . $mahasiswa->id,
            'jurusan' => 'required',
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus');
    }

    // Export and Import Methods

    public function export()
    {
        return Excel::download(new MahasiswaExport, 'data_mahasiswa.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new MahasiswaImport, $request->file('file'));

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil diimport.');
    }
}
