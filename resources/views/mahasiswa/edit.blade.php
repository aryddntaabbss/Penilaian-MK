@extends('layouts.main')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <section class=" overflow-hidden mb-5">
        <div class="p-6">

            <div class="bg-white shadow-md border rounded-lg p-5">
                <h1 class="text-2xl font-bold mb-4">Edit Mahasiswa</h1>

                <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" class="space-y-4">
                    @csrf @method('PUT')

                    <input type="text" name="npm" value="{{ old('npm', $mahasiswa->npm) }}"
                        class="w-full border p-2 rounded" required>
                    <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}"
                        class="w-full border p-2 rounded" required>
                    <input type="email" name="email" value="{{ old('email', $mahasiswa->email) }}"
                        class="w-full border p-2 rounded" required>
                    <input type="text" name="jurusan" value="{{ old('jurusan', $mahasiswa->jurusan) }}"
                        class="w-full border p-2 rounded" required>

                    <button type="submit"
                        class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">Update</button>
                    <a href="{{ route('mahasiswa.index') }}" class="ml-2 text-gray-600 hover:underline">Kembali</a>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection