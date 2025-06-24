<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\DosenExport;
use App\Imports\DosenImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Dosen;

class DosenController extends Controller
{

    public function index()
    {
        $dosen = Dosen::all();
        return view('dosen.index', compact('dosen'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:dosen',
            'nama' => 'required',
            'email' => 'required|email',
            'prodi' => 'required',
        ]);

        Dosen::create($request->all());

        return redirect()->route('dosen.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required|unique:dosen,nip,' . $id,
            'nama' => 'required',
            'email' => 'required|email',
            'prodi' => 'required',
        ]);

        $dosen = Dosen::findOrFail($id);
        $dosen->update($request->all());

        return redirect()->route('dosen.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Export the dosen data to an Excel file.
     *
     * @return \Illuminate\Http\Response
     */

    public function export()
    {
        return Excel::download(new DosenExport, 'data_dosen.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new DosenImport, $request->file('file'));

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diimport.');
    }
}
