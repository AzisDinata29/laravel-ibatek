<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('organizations')->insert([
            [
                'name' => 'Unit Kegiatan Mahasiswa Islam Universitas Teknokrat Indonesia',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Unit Kegiatan Mahasiswa Programming, Universitas Teknokrat Indonesia',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Unit Kegiatan Mahasiswa Tari Universitas Teknokrat Indonesia',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Unit Kegiatan Mahasiswa Pencak Silat Universitas Teknokrat Indonesia',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Asisten Dosen Komputer, Universitas Teknokrat Indonesia',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Badan Eksekutif Mahasiswa Fakultas Ekonomi dan Bisnis',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Badan Eksekutif Mahasiswa Fakultas Sastra dan Ilmu Pendidikan',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Badan Eksekutif Mahasiswa, Fakultas Teknik Ilmu Komputer, Universitas Teknokrat Indonesia',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bidang Unit Kegiatan Mahasiswa Band Universitas Teknokrat Indonesia',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Himpunan Mahasiswa D3 Sistem Informasi Akuntansi, Fakultas Teknik dan Ilmu Komputer, Universitas Teknokrat Indonesia',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Himpunan Mahasiswa Program Studi S1 Pendidikan Bahasa Inggris',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Himpunan Mahasiswa Program Studi S1 Pendidikan Matematika',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Himpunan Mahasiswa Program Studi S1 Pendidikan Olahraga',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Himpunan Mahasiswa Program Studi S1 Sastra Inggris',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Himpunan Mahasiswa S1 Akuntansi Universitas Teknokrat Indonesia',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Himpunan Mahasiswa S1 Informatika, Universitas Teknokrat Indonesia',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Himpunan Mahasiswa S1 Manajemen, Universitas Teknokrat Indonesia',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Himpunan Mahasiswa S1 Sistem Informasi, Universitas Teknokrat Indonesia',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Himpunan Mahasiswa S1 Teknik Elektro, Universitas Teknokrat Indonesia',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Himpunan Mahasiswa S1 Teknik Komputer, Universitas Teknokrat Indonesia',
                'description' => '-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
