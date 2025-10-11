<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Sistem Informasi', 'fakultas_id' => 1],
            ['name' => 'Teknologi Informasi', 'fakultas_id' => 1],
            ['name' => 'Teknik Komputer', 'fakultas_id' => 1],
            ['name' => 'Teknik Elektro', 'fakultas_id' => 1],
            ['name' => 'Teknik Sipil', 'fakultas_id' => 1],
            ['name' => 'Sistem Informasi Akuntansi', 'fakultas_id' => 1],
            ['name' => 'Sastra Inggris', 'fakultas_id' => 2],
            ['name' => 'Pendidikan Bahasa Inggris', 'fakultas_id' => 2],
            ['name' => 'Pendidikan Olahraga', 'fakultas_id' => 2],
            ['name' => 'Pendidikan Matematika', 'fakultas_id' => 2],
            ['name' => 'Manajemen', 'fakultas_id' => 3],
            ['name' => 'Akuntansi', 'fakultas_id' => 3],
        ];

        DB::table('prodis')->insert($data);
    }
}
