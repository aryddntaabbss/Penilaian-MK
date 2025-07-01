@extends('layouts.main')

<x-slot name="title">
    Data Nilai
</x-slot>

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <x-breadcrumb :items="[
            ['title' => 'Data Nilai Mahasiswa', 'url' => route('nilai.index')]
        ]" />

        <section class="overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between mb-4">
                    <h1 class="text-2xl font-bold">Data Nilai Mahasiswa</h1>
                    <div class="flex space-x-2">
                        <a href="{{ route('nilai.create') }}"
                            class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">+ Input
                            Nilai</a>
                        <a href="{{ route('nilai.export') }}"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Export Excel</a>
                    </div>
                </div>
                <form method="GET" action="{{ route('nilai.index') }}">
                    <label for="matakuliah_id" class="mr-2">Filter Matakuliah:</label>
                    <select name="matakuliah_id" id="matakuliah_id" class="border p-1 rounded"
                        onchange="this.form.submit()">
                        <option value="">Semua</option>
                        @foreach($matakuliah as $mk)
                        <option value="{{ $mk->id }}" {{ request('matakuliah_id') == $mk->id ? 'selected' : '' }}>
                            {{ $mk->nama }}
                        </option>
                        @endforeach
                    </select>
                </form>
            </div>
            <!-- End of action buttons -->
    </div>

    <div class="bg-white shadow-md border rounded-lg p-5">
        <table id="simpledataTable" class="table-auto w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Mahasiswa</th>
                    <th class="px-4 py-2">Matakuliah</th>
                    <th class="px-4 py-2">Dosen</th>
                    <th class="px-4 py-2">Nilai</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nilai as $item)
                <tr>
                    <td class="border-t px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border-t px-4 py-2">{{ $item->mahasiswa->nama }}</td>
                    <td class="border-t px-4 py-2">{{ $item->matakuliah->nama }}</td>
                    <td class="border-t px-4 py-2">{{ $item->dosen->nama }}</td>
                    <td class="border-t px-4 py-2">{{ $item->nilai }} ({{ $item->huruf }})</td>
                    <td class="border-t px-4 py-2">
                        <a href="{{ route('nilai.mahasiswa', $item->mahasiswa->npm) }}"
                            class="text-blue-600 hover:underline mr-2">Lihat</a>
                        <a href="{{ route('nilai.edit', $item->id) }}"
                            class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('nilai.destroy', $item->id) }}" method="POST" class="inline">
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

</div>
@endsection