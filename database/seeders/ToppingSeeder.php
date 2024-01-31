<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('toppings')->insert([
                ['tenant_id' => 1,
                'topping_name' => 'Lettuce'
                ],
                ['tenant_id' => 1,
                'topping_name' => 'Tomato'
                ],
                ['tenant_id' => 1,
                'topping_name' => 'Oil and Viniger'
                ],
                ['tenant_id' => 1,
                'topping_name' => 'Mayo'
                ],
                ['tenant_id' => 1,
                'topping_name' => 'Chipotle Sauce'
                ],
                ['tenant_id' => 1,
                'topping_name' => 'Hot Sauce'
                ],
                ['tenant_id' => 1,
                'topping_name' => 'Caesar Dressing'
                ],
                ['tenant_id' => 1,
                'topping_name' => 'Ranch'
                ],
                ['tenant_id' => 1,
                'topping_name' => 'Onions'
                ],
                ['tenant_id' => 1,
                'topping_name' => 'Banana Peppers'
                ],
                ['tenant_id' => 1,
                'topping_name' => 'Spinach Wrap'
                ],
                ['tenant_id' => 1,
                'topping_name' => 'Garlic Pesto Wrap'
                ],
                ['tenant_id' => 1,
                'topping_name' => 'Sundried Tomato Basil'
                ],
                ['tenant_id' => 1,
                'topping_name' => 'Plain Wrap'
                ],
                ['tenant_id' => 1,
                'topping_name' => 'Wheat Wrap'
                ],
                ['tenant_id' => 1,
                'topping_name' => 'Hoagie'
                ],
                ['tenant_id' => 1,
                'topping_name' => 'Extra Chicken Additional $1.00'
                ],
            ]);
    }
}
