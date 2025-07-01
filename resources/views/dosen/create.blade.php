@extends('layouts.main')

@section('title', 'Tambah Dosen')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <x-breadcrumb :items="[
            ['title' => 'Manajemen Data', 'url' => route('dashboard')],
            ['title' => 'Dosen', 'url' => route('dosen.index')],
            ['title' => 'Tambah Dosen']
        ]" />

        <section class="overflow-hidden mb-5">
            <div class="p-6">

                <div class="bg-white shadow-md border rounded-lg p-5">
                    <h1 class="text-2xl font-bold mb-4">Tambah Dosen</h1>

                    <form action="{{ route('dosen.store') }}" method="POST" class="space-y-2">
                        @csrf

                        <!-- NIP -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIP</label>
                            <input type="number" name="nip" placeholder="Misal: 197201011998031001"
                                value="{{ old('nip') }}" class="w-full border p-2 rounded" required>
                            <p class="text-xs text-gray-500 mt-1">NIP harus unik untuk tiap dosen.</p>
                        </div>

                        <!-- Nama -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Dosen</label>
                            <input type="text" name="nama" placeholder="Misal: Dr. Aryaddinata Abbas, S.Kom., M.Kom."
                                value="{{ old('nama') }}" class="w-full border p-2 rounded" required>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}"
                                class="w-full border p-2 rounded" required>
                        </div>

                        <!-- jurusan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jurusan</label>
                            <input type="text" name="jurusan" placeholder="Misal: Teknik Informatika"
                                value="{{ old('jurusan') }}" class="w-full border p-2 rounded" required>
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                            <input type="text" name="jabatan" placeholder="Misal: Lektor" value="{{ old('jabatan') }}"
                                class="w-full border p-2 rounded" required>
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="flex items-center justify-end space-x-3">
                            <button type="submit"
                                class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">Simpan</button>
                            <a href="{{ route('dosen.index') }}" class="text-gray-600 hover:underline">Kembali</a>
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
            </div>
        </section>

    </div>
</div>
@endsection