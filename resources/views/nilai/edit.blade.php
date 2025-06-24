@extends('layouts.main')

@section('title', 'Edit Nilai')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <x-breadcrumb :items="[
            ['title' => 'Data Nilai Mahasiswa', 'url' => route('nilai.index')],
            ['title' => 'Edit Nilai']
        ]" />

        <div class="bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-6">Edit Nilai Mahasiswa</h1>

            <div class="md:flex md:space-x-6">
                <!-- Kolom Form -->
                <div class="w-full md:w-2/3 space-y-4">
                    <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Hidden ID -->
                        <input type="hidden" name="mahasiswa_id" value="{{ $nilai->mahasiswa_id }}">
                        <input type="hidden" name="matakuliah_id" value="{{ $nilai->matakuliah_id }}">
                        <input type="hidden" name="dosen_id" value="{{ $nilai->dosen_id }}">

                        <!-- Mahasiswa -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mahasiswa</label>
                            <select class="w-full border p-2 rounded bg-gray-100" disabled>
                                <option>
                                    {{ $nilai->mahasiswa->npm }} - {{ $nilai->mahasiswa->nama }}
                                </option>
                            </select>
                        </div>

                        <!-- Matakuliah -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Matakuliah</label>
                            <select class="w-full border p-2 rounded bg-gray-100" disabled>
                                <option>
                                    {{ $nilai->matakuliah->kode }} - {{ $nilai->matakuliah->nama }}
                                </option>
                            </select>
                        </div>

                        <!-- Dosen -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Dosen</label>
                            <select class="w-full border p-2 rounded">
                                <option>
                                    {{ $nilai->dosen->nidn }} - {{ $nilai->dosen->nama }}
                                </option>
                            </select>
                        </div>

                        <!-- Nilai Angka -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nilai Angka</label>
                            <input type="number" name="nilai" value="{{ old('nilai', $nilai->nilai) }}" min="0"
                                max="100" class="w-full border p-2 rounded">
                            <p class="text-xs text-gray-500 mt-1">Masukkan nilai angka (0-100)</p>
                        </div>

                        <div class="flex items-center space-x-3 pt-4">
                            <button type="submit"
                                class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">Update</button>
                            <a href="{{ route('nilai.index') }}" class="text-gray-600 hover:underline">Kembali</a>
                        </div>

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
</div>
@endsection