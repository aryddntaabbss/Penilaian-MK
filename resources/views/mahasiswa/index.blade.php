@extends('layouts.main')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <x-breadcrumb :items="[
            ['title' => 'Manajemen Data', 'url' => route('dashboard')],
            ['title' => 'Mahasiswa', 'url' => route('mahasiswa.index')]
        ]" />

        <section class=" overflow-hidden mb-5">
            <div class="p-6">
                <div class="flex justify-between mb-4">
                    <h1 class="text-2xl font-bold">Data Mahasiswa</h1>
                    <!-- Action buttons -->
                    <div class="flex space-x-2 mb-4">
                        <a href="{{ route('mahasiswa.create') }}"
                            class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">+
                            Tambah Mahasiswa</a>
                        <a href="{{ route('mahasiswa.export') }}"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Export Excel</a>

                        <!-- Button to open modal -->
                        <button id="openImportModal" type="button"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Import
                        </button>

                        <!-- Modal -->
                        <div id="importModal"
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
                            <div class="bg-white rounded shadow-lg p-6 w-full max-w-md">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-lg font-bold">Import Mahasiswa</h2>
                                    <button id="closeImportModal"
                                        class="text-gray-500 hover:text-gray-700">&times;</button>
                                </div>
                                <form action="{{ route('mahasiswa.import') }}" method="POST"
                                    enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    <input type="file" name="file" required class="border rounded px-2 py-1 w-full">
                                    <div class="flex justify-end space-x-2">
                                        <button type="button" id="cancelImportModal"
                                            class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Batal</button>
                                        <button type="submit"
                                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Import</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End of action buttons -->
                </div>

                <div class="bg-white shadow-md border rounded-lg p-5">
                    <table id="simpledataTable" class="table-auto w-full pt-5 ">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">NPM</th>
                                <th class="px-4 py-2">Nama</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Jurusan</th>
                                <th class="px-4 py-2">Semester</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswa as $mhs)
                            <tr>
                                <td class="border-t px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border-t px-4 py-2">{{ $mhs->user->npm }}</td>
                                <td class="border-t px-4 py-2">{{ $mhs->user->name }}</td>
                                <td class="border-t px-4 py-2">{{ $mhs->user->email }}</td>
                                <td class="border-t px-4 py-2">{{ $mhs->jurusan ?? '-' }}</td>
                                <td class="border-t px-4 py-2">Semester {{ $mhs->semester ?? '-' }}</td>
                                <td class="border-t px-4 py-2">{{ $mhs->status() }}</td>
                                <td class="border-t px-4 py-2">
                                    <a href="{{ route('mahasiswa.edit', $mhs->id) }}"
                                        class="text-blue-600 hover:underline mr-2">Edit</a>
                                    <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST"
                                        class="inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Hapus data ini?')"
                                            class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <script>
        const openBtn = document.getElementById('openImportModal');
                                const modal = document.getElementById('importModal');
                                const closeBtn = document.getElementById('closeImportModal');
                                const cancelBtn = document.getElementById('cancelImportModal');
    
                                openBtn.addEventListener('click', () => modal.classList.remove('hidden'));
                                closeBtn.addEventListener('click', () => modal.classList.add('hidden'));
                                cancelBtn.addEventListener('click', () => modal.classList.add('hidden'));
    </script>
    @endsection