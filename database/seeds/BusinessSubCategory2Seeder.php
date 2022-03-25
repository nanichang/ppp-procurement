<?php

use Illuminate\Database\Seeder;

class BusinessSubCategory2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_sub_category2s')->insert([[
            'name' => 'Building lease and Rent',
        ]]);
        DB::table('business_sub_category2s')->insert([[
            'name' => 'Estate Management',
        ]]);
    }
}
