@extends('layouts.main')

@section('title', 'Nilai Saya')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">Daftar Nilai Mahasiswa</h1>

        <div class="bg-white shadow-md p-5 rounded">
            <table class="table-auto w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Matakuliah</th>
                        <th class="border px-4 py-2">Dosen</th>
                        <th class="border px-4 py-2">SKS</th>
                        <th class="border px-4 py-2">Semester</th>
                        <th class="border px-4 py-2">Nilai Angka</th>
                        <th class="border px-4 py-2">Nilai Huruf</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilai as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $item->matakuliah->nama }}</td>
                        <td class="border px-4 py-2">{{ $item->dosen->nama }}</td>
                        <td class="border px-4 py-2">{{ $item->matakuliah->sks }}</td>
                        <td class="border px-4 py-2">{{ $item->matakuliah->semester }}</td>
                        <td class="border px-4 py-2">{{ $item->nilai }}</td>
                        <td class="border px-4 py-2">
                            @php
                            $n = $item->nilai;
                            if ($n >= 90) $huruf = 'A';
                            elseif ($n >= 75) $huruf = 'AB';
                            elseif ($n >= 65) $huruf = 'B';
                            elseif ($n >= 55) $huruf = 'BC';
                            elseif ($n >= 45) $huruf = 'C';
                            else $huruf = 'E';
                            @endphp
                            {{ $huruf }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection