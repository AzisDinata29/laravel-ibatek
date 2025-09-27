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
        $users = [
            [
                'npm'   => '22312056',
                'role'  => 'user',
                'name'  => 'Azis Dinata',
                'email' => 'azis_dinata@teknokrat.ac.id',
            ],
            [
                'npm'   => 'admin',
                'role'  => 'admin',
                'name'  => 'admin',
                'email' => 'admin@teknokrat.ac.id',
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
