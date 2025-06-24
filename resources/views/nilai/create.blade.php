@extends('layouts.main')

<x-slot name="title">
    Tambah Nilai
</x-slot>

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <x-breadcrumb :items="[
            ['title' => 'Data Nilai Mahasiswa', 'url' => route('nilai.index')],
            ['title' => 'Tambah Nilai']
        ]" />

        <section class="overflow-hidden mb-5">
            <div class="p-6">

                <div class="bg-white shadow-md border rounded-lg p-5">
                    <h1 class="text-2xl font-bold mb-4">Tambah Nilai</h1>

                    <div class="md:flex md:space-x-6">
                        <!-- Kolom Form -->
                        <div class="w-full md:w-2/3 space-y-4">
                            <form action="{{ route('nilai.store') }}" method="POST">
                                @csrf

                                <!-- Mahasiswa -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Mahasiswa</label>
                                    <select name="mahasiswa_id" class="w-full border p-2 rounded" required>
                                        <option value="">-- Pilih Mahasiswa --</option>
                                        @foreach ($mahasiswa as $mhs)
                                        <option value="{{ $mhs->id }}"
                                            {{ old('mahasiswa_id') == $mhs->id ? 'selected' : '' }}>
                                            {{ $mhs->npm }} - {{ $mhs->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Matakuliah -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Matakuliah</label>
                                    <select name="matakuliah_id" class="w-full border p-2 rounded" required>
                                        <option value="">-- Pilih Matakuliah --</option>
                                        @foreach ($matakuliah as $mk)
                                        <option value="{{ $mk->id }}"
                                            {{ old('matakuliah_id') == $mk->id ? 'selected' : '' }}>
                                            {{ $mk->kode }} - {{ $mk->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Dosen -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Dosen Pengampu</label>
                                    <select name="dosen_id" class="w-full border p-2 rounded" required>
                                        <option value="">-- Pilih Dosen --</option>
                                        @foreach ($dosen as $dsn)
                                        <option value="{{ $dsn->id }}"
                                            {{ old('dosen_id') == $dsn->id ? 'selected' : '' }}>
                                            {{ $dsn->nidn }} - {{ $dsn->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Nilai Angka -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nilai Angka</label>
                                    <input type="number" name="nilai" placeholder="Misal: 85" min="0" max="100"
                                        value="{{ old('nilai') }}" class="w-full border p-2 rounded" required>
                                    <p class="text-xs text-gray-500 mt-1">Masukkan nilai angka antara 0 - 100.</p>
                                </div>

                                <!-- Tombol -->
                                <div class="flex items-center space-x-3 pt-4">
                                    <button type="submit"
                                        class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">Simpan</button>
                                    <a href="{{ route('nilai.index') }}"
                                        class="text-gray-600 hover:underline">Kembali</a>
                                </div>

                                <!-- Tampilkan Validasi Error -->
                                @if ($errors->any())
                                <div class="bg-red-100 text-red-700 p-2 rounded mt-4">
                                    <ul class="list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </form>
                        </div>

                        <!-- Kolom Panduan -->
                        <div class="w-full md:w-1/3 mt-8 md:mt-0">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Konversi Nilai</label>
                            <table class="table-auto text-sm border border-gray-300 w-full">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border px-2 py-1">Angka</th>
                                        <th class="border px-2 py-1">Huruf</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border px-2 py-1 text-center">90 - 100</td>
                                        <td class="border px-2 py-1 text-center">A</td>
                                    </tr>
                                    <tr>
                                        <td class="border px-2 py-1 text-center">75 - 89</td>
                                        <td class="border px-2 py-1 text-center">AB</td>
                                    </tr>
                                    <tr>
                                        <td class="border px-2 py-1 text-center">65 - 74</td>
                                        <td class="border px-2 py-1 text-center">B</td>
                                    </tr>
                                    <tr>
                                        <td class="border px-2 py-1 text-center">55 - 64</td>
                                        <td class="border px-2 py-1 text-center">BC</td>
                                    </tr>
                                    <tr>
                                        <td class="border px-2 py-1 text-center">45 - 54</td>
                                        <td class="border px-2 py-1 text-center">C</td>
                                    </tr>
                                    <tr>
                                        <td class="border px-2 py-1 text-center">0 - 44</td>
                                        <td class="border px-2 py-1 text-center">E</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>
</div>
@endsection