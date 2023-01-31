<?php

namespace Database\Seeders;

use App\Models\Options;
use Illuminate\Database\Seeder;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Options::create([
            'name' => 'lokasi_lab',
            'value' => json_encode([
                'Lab. Household',
                'Lab. Audio Video',
                'Lab. EMC',
                'Lab Radio Frequency',
                'Lab. AC',
            ]),
        ]);
    }
}
