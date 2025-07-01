@extends('layouts.main')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['title' => 'Manajemen Data', 'url' => route('dashboard')],
        ['title' => 'Mahasiswa', 'url' => route('mahasiswa.index')],
        ['title' => 'Edit Mahasiswa']
    ]" />

    <section class=" overflow-hidden mb-5">
        <div class="p-6">

            <div class="bg-white shadow-md border rounded-lg p-5">
                <h1 class="text-2xl font-bold mb-4">Edit Mahasiswa</h1>
                <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" class="space-y-4">
                    @csrf @method('PUT')

                    <!-- NPM -->
                    <div>
                        <label for="npm" class="block font-medium text-gray-700">NPM</label>
                        <input type="text" name="npm" id="npm" value="{{ old('npm', $mahasiswa->user->npm) }}"
                            class="w-full border p-2 rounded" required>
                    </div>

                    <!-- Nama -->
                    <div>
                        <label for="name" class="block font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $mahasiswa->user->name) }}"
                            class="w-full border p-2 rounded" required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $mahasiswa->user->email) }}"
                            class="w-full border p-2 rounded" required>
                    </div>

                    <!-- Jurusan -->
                    <div>
                        <label for="jurusan" class="block font-medium text-gray-700">Jurusan</label>
                        <input type="text" name="jurusan" id="jurusan" value="{{ old('jurusan', $mahasiswa->jurusan) }}"
                            class="w-full border p-2 rounded" required>
                    </div>

                    <!-- Semester -->
                    <div>
                        <label for="semester" class="block font-medium text-gray-700">Semester</label>
                        <input type="number" name="semester" id="semester"
                            value="{{ old('semester', $mahasiswa->semester) }}" class="w-full border p-2 rounded"
                            required>
                    </div>

                    <!-- Tombol -->
                    <div class="flex items-center space-x-2">
                        <button type="submit"
                            class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">Update</button>
                        <a href="{{ route('mahasiswa.index') }}" class="text-gray-600 hover:underline">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection