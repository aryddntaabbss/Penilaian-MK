@extends('layouts.main')

<x-slot name="title">
    Data Mata Kuliah Saya
</x-slot>

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <x-breadcrumb :items="[
            ['title' => 'Penilaian', 'url' => route('penilaian.index')]
        ]" />

        <div class="bg-white shadow-md border rounded-lg p-5">
            <h1 class="text-2xl font-bold mb-4">Daftar Mata Kuliah Saya</h1>

            <table id="simpledataTable" class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Kode</th>
                        <th class="px-4 py-2">Nama Mata Kuliah</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matakuliah as $mk)
                    <tr>
                        <td class="border-t px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border-t px-4 py-2">{{ $mk->kode }}</td>
                        <td class="border-t px-4 py-2">{{ $mk->nama }}</td>
                        <td class="border-t px-4 py-2">
                            <a href="{{ route('penilaian.detail', $mk->id) }}"
                                class="text-blue-600 hover:underline">Nilai Mahasiswa</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection