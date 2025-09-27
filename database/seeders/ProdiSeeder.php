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
            ['name' => 'Informatika', 'fakultas_id' => 1],
        ];

        DB::table('prodis')->insert($data);
    }
}
