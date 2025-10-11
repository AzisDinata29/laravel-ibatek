<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admins = [
            [
                'npm'   => 'admin',
                'role'  => 'admin',
                'name'  => 'admin',
                'nomor_telpon'  => '085783390072',
                'email' => 'admin@teknokrat.ac.id',
            ],
        ];

        foreach ($admins as $admin) {
            User::factory()->create($admin);
        }

        $users = [
            [
                'npm'   => '22312056',
                'fakultas'  => '1',
                'prodi'  => '1',
                'angkatan'  => '2023',
                'nomor_telpon'  => '085783390072',
                'role'  => 'user',
                'name'  => 'Azis Dinata',
                'email' => 'azis_dinata@teknokrat.ac.id',
            ],
        ];

        foreach ($users as $user) {
            User::factory()->create($user);
        }

        DB::table('aktifitas_mahasiswas')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'tipe_aktifitas_mahasiswa_id' => 1,
                'label' => 'Himpunan Mahasiswa S1 Informatika, Universitas Teknokrat Indonesia',
                'label_detail' => 'Deskripsi',
                'tanggal_mulai' => '2025-10-01',
                'tanggal_selesai' => '2025-10-18',
                'semester' => '1',
                'durasi' => '180',
                'file' => 'aktifitas/dZgmuAMg8SbkhoO9ByXE7Br3nDSnF2iIfMlh7ZYD.png',
                'keterangan' => 'Keterangan',
                'status' => 'Menunggu Validasi',
                'validasi_user_id' => null,
                'keterangan_validasi' => null,
                'created_at' => '2025-10-11 18:10:53',
                'updated_at' => '2025-10-11 18:10:53',
            ],
        ]);

        $this->call([
            TipeAktifitasMahasiswaSeeder::class,
            FakultasSeeder::class,
            ProdiSeeder::class,
            OrganisasiSeeder::class,
        ]);
    }
}
