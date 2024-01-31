<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SandwicheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sandwiches')->insert([
            ['tenant_id' => 1,
            'sandwich_name' => 'Italian'
            ],
            ['tenant_id' => 1,
            'sandwich_name' => 'Chicken Bacon Ranch'
            ],
            ['tenant_id' => 1,
            'sandwich_name' => 'Turkey and Cheese'
            ],
            ['tenant_id' => 1,
            'sandwich_name' => 'Ham and Cheese'
            ],
            ['tenant_id' => 1,
            'sandwich_name' => 'Cheese Only'
            ],
            ['tenant_id' => 1,
            'sandwich_name' => 'Buffalo Chicken'
            ],
        ]);
    }
}
