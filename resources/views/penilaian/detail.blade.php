@extends('layouts.main')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-breadcrumb :items="[
            ['title' => 'Penilaian', 'url' => route('penilaian.index')],
            ['title' => $matakuliah->nama , 'url' => route('penilaian.detail', $matakuliah->id)]
        ]" />
        <h1 class="text-2xl font-bold mb-4">Penilaian Mata Kuliah {{ $matakuliah->nama }}</h1>

        <form action="{{ route('penilaian.simpan', $matakuliah->id) }}" method="POST">
            @csrf
            <div class="bg-white shadow-md border rounded-lg p-5">

                <table id="simpledataTable" class="table-auto w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-2">NPM</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa as $mhs)
                        <tr>
                            <td class="border-t px-4 py-2">{{ $mhs->user->npm }}</td>
                            <td class="border-t px-4 py-2">{{ $mhs->user->name }}</td>
                            <td class="border-t px-4 py-2">
                                <input type="number" name="nilai[{{ $mhs->id }}]"
                                    value="{{ $nilai[$mhs->id]->nilai ?? '' }}" class="border p-1 w-20 rounded" min="0"
                                    max="100" required>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-2">Belum ada mahasiswa kontrak.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">Simpan
                        Nilai</button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection