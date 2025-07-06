@extends('layouts.main')

@section('title', 'Data Dosen')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <x-breadcrumb :items="[
            ['title' => 'Manajemen Data', 'url' => route('dashboard')],
            ['title' => 'Dosen']
        ]" />

        <section class=" overflow-hidden mb-5">
            <div class="p-6">
                <div class="flex justify-between mb-4">
                    <h1 class="text-2xl font-bold">Data Dosen</h1>
                    <!-- Action buttons -->
                    <div class="flex space-x-2 mb-4">
                        <a href="{{ route('dosen.create') }}"
                            class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">+
                            Tambah Dosen</a>
                        <a href="{{ route('dosen.export') }}"
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
                                    <h2 class="text-lg font-bold">Import Dosen</h2>
                                    <button id="closeImportModal"
                                        class="text-gray-500 hover:text-gray-700">&times;</button>
                                </div>
                                <form action="{{ route('dosen.import') }}" method="POST" enctype="multipart/form-data"
                                    class="space-y-4">
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
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">NIP</th>
                                <th class="px-4 py-2">Nama</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Jurusan</th>
                                <th class="px-4 py-2">Jabatan</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dosen as $index => $item)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $index + 1 }}</td>
                                <td class="px-4 py-2">{{ $item->user->nip }}</td>
                                <td class="px-4 py-2">{{ $item->user->name }}</td>
                                <td class="px-4 py-2">{{ $item->user->email }}</td>
                                <td class="px-4 py-2">{{ $item->jurusan }}</td>
                                <td class="px-4 py-2">{{ $item->jabatan }}</td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <a href="{{ route('dosen.edit', $item->id) }}"
                                        class="text-blue-600 hover:underline">Edit</a>

                                    <form action="{{ route('dosen.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
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