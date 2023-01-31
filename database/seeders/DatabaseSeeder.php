<?php

namespace Database\Seeders;

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
        $this->call(OptionsSeeder::class);
        User::create([
            'name' => 'Admin',
            'username' => 'AdminSidak12',
            'password' => bcrypt('AdminSidak12!'),
            'is_admin' => '1',
        ]);
    }
}
