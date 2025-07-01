<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Dosen;
use App\Exports\NilaiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $matakuliah = Matakuliah::all();

        $nilai = Nilai::with('mahasiswa', 'dosen', 'matakuliah')
            ->when($request->matakuliah_id, function ($query) use ($request) {
                $query->where('matakuliah_id', $request->matakuliah_id);
            })
            ->get();

        return view('nilai.index', compact('nilai', 'matakuliah'));
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

    public function show($id)
    {
        $nilai = Nilai::with('mahasiswa', 'matakuliah', 'dosen')->findOrFail($id);
        return view('nilai.show', compact('nilai'));
    }

    public function nilaiMahasiswa($npm)
    {
        $nilai = Nilai::with('matakuliah', 'dosen')
            ->whereHas('mahasiswa', function ($query) use ($npm) {
                $query->where('npm', $npm);
            })
            ->get();

        return view('nilai.nilai-mahasiswa', compact('nilai'));
    }


    public function nilaiSaya()
    {
        $mahasiswa_id = Auth::user()->id;
        $nilai = Nilai::with('matakuliah', 'dosen')
            ->where('mahasiswa_id', $mahasiswa_id)
            ->get();

        return view('nilai.nilai-mahasiswa', compact('nilai'));
    }
    /**
     * Export data to Excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return Excel::download(new NilaiExport, 'data_nilai.xlsx');
    }
}
