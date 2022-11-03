<?php

namespace Database\Seeders;

use App\Models\Alat;
use App\Models\JadwalKalibrasi;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Admin',
            'username' => 'AdminSidak12',
            'password' => bcrypt('AdminSidak12!'),
            'is_admin' => '1',
        ]);
        User::create([
            'name' => 'Lutfi Ainun Najih',
            'username' => 'sukundev',
            'password' => bcrypt('LutfiAN32!'),
        ]);
    }
}
