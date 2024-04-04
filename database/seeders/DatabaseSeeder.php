<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Guru;
use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use App\Models\JenisNilai;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username'  => 'admin',
            'password'  => bcrypt('1234'),
        ]);
        User::create([
            'username'  => '937163846275162036',
            'password'  => bcrypt('1234'),
        ]);
        User::create([
            'username'  => '9828303092',
            'password'  => bcrypt('1234'),
        ]);
        User::create([
            'username'  => '1414155555',
            'password'  => bcrypt('1234'),
        ]);

        Admin::create([
            'user_id'   => 1,
            'name'      => 'Admin'
        ]);
        Guru::create([
            'nip'           => 937163846275162036,
            'nm_guru'       => 'Budiono Siregar',
            'j_kelamin'     => 'laki-laki',
            'alamat'        => 'Karangmulyo, Purwodadi',
            'no_hp'         => '081229098124',
            'user_id'       => 2,
        ]);


        Kelas::create([
            'kelas'     => '7A',
            'guru_id'   => 1
        ]);

        Siswa::create([
            'nis'           => 9828303092,
            'nm_siswa'      => 'Robert Davis Chaniago',
            'j_kelamin'     => 'laki-laki',
            'alamat'        => 'Karangmulyo, Purwodadi',
            'no_hp'         => '081229098124',
            'user_id'       => 3,
            'kelas_id'      => 1
        ]);
        Siswa::create([
            'nis'           => 9828303093,
            'nm_siswa'      => 'Alex',
            'j_kelamin'     => 'laki-laki',
            'alamat'        => 'Karangmulyo, Purwodadi',
            'no_hp'         => '0812290924124',
            'user_id'       => 4,
            'kelas_id'      => 1
        ]);

        MataPelajaran::create([
            'mata_pelajaran'     => 'B. Indonesia'
        ]);
        MataPelajaran::create([
            'mata_pelajaran'     => 'B. Inggris'
        ]);
        MataPelajaran::create([
            'mata_pelajaran'     => 'Matematika'
        ]);
        MataPelajaran::create([
            'mata_pelajaran'     => 'PPKn'
        ]);
        MataPelajaran::create([
            'mata_pelajaran'     => 'Pend. Agama'
        ]);
        MataPelajaran::create([
            'mata_pelajaran'     => 'IPA'
        ]);
        MataPelajaran::create([
            'mata_pelajaran'     => 'IPS'
        ]);
        MataPelajaran::create([
            'mata_pelajaran'     => 'Olahraga'
        ]);

        TahunAjaran::create([
            'tahun_ajaran'  => '2023/2024',
            'semester'      => 'ganjil',
            'status'        => 'tidak aktif'
        ]);
        TahunAjaran::create([
            'tahun_ajaran'  => '2023/2024',
            'semester'      => 'genap',
            'status'        => 'aktif'
        ]);

        JenisNilai::create([
            'jenis_nilai'   => 'UH 1'
        ]);
        JenisNilai::create([
            'jenis_nilai'   => 'UH 2'
        ]);
        // JenisNilai::create([
        //     'jenis_nilai'   => 'UH 3'
        // ]);
        // JenisNilai::create([
        //     'jenis_nilai'   => 'UH 4'
        // ]);
        JenisNilai::create([
            'jenis_nilai'   => 'UTS'
        ]);
        JenisNilai::create([
            'jenis_nilai'   => 'UAS'
        ]);
    }
}