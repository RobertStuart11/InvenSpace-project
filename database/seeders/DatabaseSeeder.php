<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::create(['nama_role' => 'admin']);
        $guruRole = Role::create(['nama_role' => 'guru']);
        $siswaRole = Role::create(['nama_role' => 'siswa']);

        User::factory()->create([
            'role_id' => $adminRole->id_role,
            'nama' => 'Admin InvenSpace',
            'username' => 'admin',
        ]);

        User::factory()->guru()->create([
            'role_id' => $guruRole->id_role,
            'nama' => 'Budi Guru',
            'username' => 'budiguru',
        ]);

        User::factory()->siswa()->create([
            'role_id' => $siswaRole->id_role,
            'nama' => 'Siti Siswa',
            'username' => 'sitisiswa',
        ]);
    }
}
