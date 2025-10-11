<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TipeAktifitasMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar item dengan label & label_detail (silakan ubah sesuai kebutuhan)
        $items = [
            ['name' => 'Organisasi',  'label' => 'Nama Organisasi', 'label_detail' => 'Deskripsi'],
            ['name' => 'Kepanitiaan', 'label' => 'Nama Acara', 'label_detail' => 'Nama Kepanitian'],
            ['name' => 'Magang',      'label' => 'Nama Perusahaan', 'label_detail' => 'Posisi'],
            ['name' => 'Tridharma',   'label' => 'Judul', 'label_detail' => 'Nama Penelitian'],
            ['name' => 'Lomba',       'label' => 'Nama Lomba', 'label_detail' => 'Penyelenggara'],
        ];

        $now = Carbon::now();
        $data = collect($items)->map(function ($item) use ($now) {
            $slug = Str::slug($item['name'], '-');

            return [
                'name'         => $item['name'],
                'label'        => $item['label'] ?? $item['name'],
                'label_detail' => $item['label_detail'] ?? null,
                'slug'         => $slug,
                'created_at'   => $now,
                'updated_at'   => $now,
            ];
        })->all();

        DB::table('tipe_aktifitas_mahasiswas')->upsert(
            $data,
            ['slug'],
            ['name', 'label', 'label_detail', 'updated_at']
        );
    }
}
