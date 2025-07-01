<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;
use App\Models\User;
use App\Exports\MatakuliahExport;
use App\Imports\MatakuliahImport;
use Maatwebsite\Excel\Facades\Excel;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matakuliah = Matakuliah::with('dosen')->get();

        return view('matakuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        $dosen = User::where('role', 'dosen')->get();
        return view('matakuliah.create', compact('dosen'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:matakuliah',
            'nama' => 'required',
            'sks' => 'required|integer',
            'semester' => 'required',
            'dosen_id' => 'required|exists:users,id',
        ]);


        Matakuliah::create($request->all());

        return redirect()->route('matakuliah.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $dosen = User::where('role', 'dosen')->get();
        return view('matakuliah.edit', compact('matakuliah', 'dosen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode'     => 'required|unique:matakuliah,kode,' . $id,
            'nama'     => 'required',
            'sks'      => 'required|integer',
            'semester' => 'required',
            'dosen_id' => 'required|exists:users,id',
        ]);

        $matakuliah = Matakuliah::findOrFail($id);
        $matakuliah->update($request->all());

        return redirect()->route('matakuliah.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $matakuliah->delete();

        return redirect()->route('matakuliah.index')->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Export the matakuliah data to an Excel file.
     */
    public function export()
    {
        return Excel::download(new MatakuliahExport, 'data_matakuliah.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new MatakuliahImport, $request->file('file'));

        return redirect()->route('matakuliah.index')->with('success', 'Data berhasil diimport.');
    }
}
