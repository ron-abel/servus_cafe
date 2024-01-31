<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pickup_times')->insert([
            ['tenant_id' => 1,
            'name' => 'Main Cafe @Snack Line'
            ],
            ['tenant_id' => 1,
            'name' => 'Thunderbird Cafe'
            ],
            ['tenant_id' => 1,
            'name' => 'Thunderbird Cafe'
            ],
        ]);
    }
}
