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
                'prodi'  => '2',
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

        $this->call([
            TipeAktifitasMahasiswaSeeder::class,
            FakultasSeeder::class,
            ProdiSeeder::class,
        ]);
    }
}
