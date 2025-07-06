@extends('layouts.main')

@section('content')
<div class="py-6 max-w-5xl mx-auto">

    <x-breadcrumb :items="[
                    ['title' => 'Kartu Hasil Studi (KHS)', 'url' => route('khs.saya')]
                ]" />

    <div class="bg-white shadow-md border rounded-lg p-5">
        <h1 class="text-2xl font-bold mb-4">Kartu Hasil Studi (KHS)</h1>
        <table id="simpledataTable" class="table-auto w-full pt-5">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-4 py-2">Mata Kuliah</th>
                    <th class="px-4 py-2">Dosen</th>
                    <th class="px-4 py-2">Nilai</th>
                    <th class="px-4 py-2">Grade</th>
                </tr>
            </thead>
            <tbody>
                @forelse($nilai as $item)
                <tr>
                    <td class="border-t px-4 py-2">{{ $item->matakuliah->nama }}</td>
                    <td class="border-t px-4 py-2">{{ $item->dosen->user->name ?? '-' }}</td>
                    <td class="border-t px-4 py-2">{{ $item->nilai ?? 'Belum Dinilai' }}</td>
                    <td class="border-t px-4 py-2">
                        {{ $item->nilai ? $item->huruf : 'E' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-2">Belum ada KHS.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection