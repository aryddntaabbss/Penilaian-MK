@extends('layouts.main')

<x-slot name="title">
    Tambah Matakuliah
</x-slot>

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <x-breadcrumb :items="[
            ['title' => 'Manajemen Data', 'url' => route('dashboard')],
            ['title' => 'Matakuliah', 'url' => route('matakuliah.index')],
            ['title' => 'Tambah Matakuliah']
        ]" />

        <section class="overflow-hidden mb-5">
            <div class="p-6">

                <div class="bg-white shadow-md border rounded-lg p-5">
                    <h1 class="text-2xl font-bold mb-4">Tambah Matakuliah</h1>

                    <form action="{{ route('matakuliah.store') }}" method="POST" class="space-y-2">
                        @csrf

                        <!-- Kode Matakuliah -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kode Matakuliah</label>
                            <input type="text" name="kode" placeholder="Misal: MK001" value="{{ old('kode') }}"
                                class="w-full border p-2 rounded" required>
                        </div>

                        <!-- Nama Matakuliah -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Matakuliah</label>
                            <input type="text" name="nama" placeholder="Misal: Pemrograman Web"
                                value="{{ old('nama') }}" class="w-full border p-2 rounded" required>
                        </div>

                        <!-- SKS -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">SKS</label>
                            <input type="number" name="sks" placeholder="Misal: 3" value="{{ old('sks') }}"
                                class="w-full border p-2 rounded" required>
                        </div>

                        <!-- Semester -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Semester</label>
                            <input type="number" name="semester" placeholder="Misal: 2" value="{{ old('semester') }}"
                                class="w-full border p-2 rounded" required>
                        </div>

                        <!-- Dosen Pengampu -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Dosen Pengampu</label>
                            <select name="dosen_id" required class="w-full border p-2 rounded">
                                <option value="">-- Pilih Dosen --</option>
                                @foreach ($dosen as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tombol -->
                        <div class="flex items-center justify-end space-x-3">
                            <button type="submit"
                                class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">Simpan</button>
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