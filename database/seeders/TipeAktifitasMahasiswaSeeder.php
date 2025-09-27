<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TipeAktifitasMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            'Organisasi',
            'Kepanitiaan',
            'Magang',
            'Tridharma',
            'Lomba',
            'UKM',
        ];

        $data = [];
        foreach ($items as $item) {
            $data[] = [
                'name' => $item,
                'slug' => Str::slug($item, '-'),
            ];
        }

        DB::table('tipe_aktifitas_mahasiswas')->insert($data);
    }
}
