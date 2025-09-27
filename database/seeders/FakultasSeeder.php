<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'FTIK'],
            ['name' => 'FSIP'],
            ['name' => 'FEB']
        ];

        DB::table('fakultas')->insert($data);
    }
}
