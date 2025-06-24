@extends('layouts.main')

@section('title', 'Edit Matakuliah')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <x-breadcrumb :items="[
            ['title' => 'Manajemen Data', 'url' => route('dashboard')],
            ['title' => 'Matakuliah', 'url' => route('matakuliah.index')],
            ['title' => 'Edit Matakuliah']
        ]" />

        <section class="overflow-hidden mb-5">
            <div class="p-6">

                <div class="bg-white shadow-md border rounded-lg p-5">
                    <h1 class="text-2xl font-bold mb-4">Edit Matakuliah</h1>

                    <form action="{{ route('matakuliah.update', $matakuliah->id) }}" method="POST" class="space-y-2">
                        @csrf
                        @method('PUT')

                        <!-- Kode Matakuliah -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kode Matakuliah</label>
                            <input type="text" name="kode" value="{{ old('kode', $matakuliah->kode) }}"
                                class="w-full border p-2 rounded" required>
                            <p class="text-xs text-gray-500 mt-1">Kode harus unik untuk tiap matakuliah.</p>
                        </div>

                        <!-- Nama Matakuliah -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Matakuliah</label>
                            <input type="text" name="nama" value="{{ old('nama', $matakuliah->nama) }}"
                                class="w-full border p-2 rounded" required>
                        </div>

                        <!-- SKS -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">SKS</label>
                            <input type="number" name="sks" value="{{ old('sks', $matakuliah->sks) }}"
                                class="w-full border p-2 rounded" required>
                            <p class="text-xs text-gray-500 mt-1">Isi jumlah SKS matakuliah (angka).</p>
                        </div>

                        <!-- Semester -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Semester</label>
                            <input type="number" name="semester" value="{{ old('semester', $matakuliah->semester) }}"
                                class="w-full border p-2 rounded" required>
                            <p class="text-xs text-gray-500 mt-1">Masukkan semester matakuliah diadakan.</p>
                        </div>

                        <!-- Tombol -->
                        <div class="flex items-center justify-end space-x-3">
                            <button type="submit"
                                class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">Update</button>
                            <a href="{{ route('matakuliah.index') }}" class="text-gray-600 hover:underline">Kembali</a>
                        </div>

                        <!-- Error Validation -->
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
            </div>
        </section>

    </div>
</div>
@endsection