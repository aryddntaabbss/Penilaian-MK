@extends('layouts.main')

@section('title', 'Tambah Mahasiswa')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <x-breadcrumb :items="[
            ['title' => 'Manajemen Data', 'url' => route('dashboard')],
            ['title' => 'Mahasiswa', 'url' => route('mahasiswa.index')],
            ['title' => 'Tambah Mahasiswa']
        ]" />

        <section class="overflow-hidden mb-5">
            <div class="p-6">

                <div class="bg-white shadow-md border rounded-lg p-5">
                    <h1 class="text-2xl font-bold mb-4">Tambah Mahasiswa</h1>

                    <form action="{{ route('mahasiswa.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <label>NPM</label>
                        <input type="number" name="npm" value="{{ old('npm') }}" class="w-full border p-2 rounded"
                            required>

                        <label>Nama</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border p-2 rounded"
                            required>

                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full border p-2 rounded"
                            required>

                        <label>Jurusan</label>
                        <input type="text" name="jurusan" value="{{ old('jurusan') }}" class="w-full border p-2 rounded"
                            required>

                        <label>Semester</label>
                        <input type="number" name="semester" value="{{ old('semester') }}"
                            class="w-full border p-2 rounded" required>

                        <button type="submit"
                            class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">Simpan</button>
                        <a href="{{ route('mahasiswa.index') }}" class="ml-2 text-gray-600 hover:underline">Kembali</a>

                        @if ($errors->any())
                        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
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