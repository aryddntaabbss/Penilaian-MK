<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::whereHas('user', function ($query) {
            $query->where('role', 'mahasiswa');
        })->with('user')->get();

        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'npm' => 'required|unique:users,npm',
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'jurusan' => 'required',
            'semester' => 'required|integer|between:1,14'
        ]);

        // Buat akun user dulu
        $user = \App\Models\User::create([
            'npm' => $request->npm,
            'name' => $request->nama,
            'email' => $request->email,
            'role' => 'mahasiswa',
            'password' => Hash::make($request->npm), // default password = npm
        ]);

        // Buat data mahasiswa
        Mahasiswa::create([
            'user_id' => $user->id,
            'jurusan' => $request->jurusan,
            'semester' => $request->semester,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa & Akun berhasil dibuat.');
    }


    public function edit(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('user');
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'npm' => 'required|unique:users,npm,' . $mahasiswa->user_id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $mahasiswa->user_id,
            'jurusan' => 'required',
            'semester' => 'required|integer|between:1,14',
        ]);

        // Update data user
        $mahasiswa->user->update([
            'npm' => $request->npm,
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update data mahasiswa
        $mahasiswa->update([
            'jurusan' => $request->jurusan,
            'semester' => $request->semester,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }


    public function destroy(Mahasiswa $mahasiswa)
    {
        // Hapus user-nya juga
        $mahasiswa->user->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus');
    }

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

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diimport.');
    }
}
