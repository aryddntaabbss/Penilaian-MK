<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\DosenExport;
use App\Imports\DosenImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            'nip'   => 'required|unique:users,nip',
            'nama'  => 'required',
            'email' => 'required|email|unique:users,email',
            'jurusan' => 'required',
            'jabatan' => 'nullable',
        ]);

        // Buat akun user dosen dulu
        $user = \App\Models\User::create([
            'nip'      => $request->nip,
            'name'     => $request->nama,
            'email'    => $request->email,
            'role'     => 'dosen',
            'password' => \Illuminate\Support\Facades\Hash::make($request->nip),
        ]);

        // Lanjut buat data dosen-nya
        Dosen::create([
            'user_id' => $user->id,
            'jurusan'   => $request->jurusan,
            'jabatan'   => $request->jabatan,
        ]);

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::with('user')->findOrFail($id);

        // Update user
        $dosen->user->update([
            'nip'  => $request->nip,
            'name' => $request->nama,
            'email' => $request->email,
        ]);

        // Update dosen
        $dosen->update([
            'jurusan' => $request->jurusan,
            'jabatan' => $request->jabatan,
        ]);


        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);

        // Hapus user terkait
        $dosen->user->delete();
        // Hapus data dosen
        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus.');
    }

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
