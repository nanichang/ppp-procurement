<?php

use Illuminate\Database\Seeder;

class BusinessCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_categories')->insert([[
            'name' => 'Construction | Works',
            'id' => 1,
        ]]);
        DB::table('business_categories')->insert([[
            'name' => 'Consultancy | Services',
            'id' => 2,
        ]]);
        DB::table('business_categories')->insert([[
            'name' => 'Goods | Supply',
            'id' => 3,
        ]]);
    }
}
