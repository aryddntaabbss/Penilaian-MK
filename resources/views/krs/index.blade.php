@extends('layouts.main')

@section('content')
<div class="py-6 max-w-5xl mx-auto">

    <x-breadcrumb :items="[
                ['title' => 'Kontrak Mata Kuliah (KRS)', 'url' => route('krs.index')]
            ]" />


    <form action="{{ route('krs.store') }}" method="POST">
        @csrf

        <div class="bg-white shadow-md border rounded-lg p-5">
            <h1 class="text-2xl font-bold mb-4">Kontrak Mata Kuliah (KRS)</h1>
            <table class="table-auto w-full border-gray-300 pt-5" id="simpledataTable">
                <thead class="bg-gray-50 ">
                    <tr class="bg-gray-100">
                        <th class="border-b px-4 py-2 text-left">No</th>
                        <th class="border-b px-4 py-2 text-left">Kode</th>
                        <th class="border-b px-4 py-2 text-left">Nama Matakuliah</th>
                        <th class="border-b px-4 py-2 text-left">Semester</th>
                        <th class="border-b px-4 py-2 text-left">SKS</th>
                        <th class="border-b px-4 py-2 text-center">Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matakuliah as $mk)
                    <tr>
                        <td class="border-b px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border-b px-4 py-2">{{ $mk->kode }}</td>
                        <td class="border-b px-4 py-2">{{ $mk->nama }}</td>
                        <td class="border-b px-4 py-2">{{ $mk->semester }}</td>
                        <td class="border-b px-4 py-2">{{ $mk->sks }}</td>
                        <td class="border-b px-4 py-2 text-center">
                            <input type="checkbox" name="matakuliah_id[]" value="{{ $mk->id }}"
                                {{ in_array($mk->id, $krs) ? 'checked' : '' }}>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <button type="submit" class="mt-4 bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">Simpan
            KRS</button>
    </form>
</div>
@endsection