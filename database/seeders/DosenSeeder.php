<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nip'   => '19800101001',
                'name'  => 'Prof. Ahmad Subekti',
                'email' => 'ahmad@example.com',
                'jurusan' => 'Teknik Informatika',
                'jabatan' => '-',
            ],
            [
                'nip'   => '19820102002',
                'name'  => 'Dr. Rina Lestari',
                'email' => 'rina@example.com',
                'jurusan' => 'Sistem Informasi',
                'jabatan' => '-',
            ],
            [
                'nip'   => '19830503003',
                'name'  => 'Drs. Budi Haryono',
                'email' => 'haryono@example.com',
                'jurusan' => 'Teknik Komputer',
                'jabatan' => '-',
            ],
            [
                'nip'   => '19840604004',
                'name'  => 'Ir. Sri Wahyuni',
                'email' => 'sri@example.com',
                'jurusan' => 'Teknik Informatika',
                'jabatan' => '-',
            ],
        ];

        foreach ($data as $dosen) {
            // Buat user
            $user = User::create([
                'nip'      => $dosen['nip'],
                'name'     => $dosen['name'],
                'email'    => $dosen['email'],
                'role'     => 'dosen',
                'password' => Hash::make($dosen['nip']),
            ]);

            // Buat data dosen
            Dosen::create(
                [
                    'user_id' => $user->id,
                    'jurusan'   => $dosen['jurusan'],
                    'jabatan' => '-',
                ]
            );
        }
    }
}
