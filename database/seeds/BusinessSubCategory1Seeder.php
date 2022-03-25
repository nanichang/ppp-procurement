<?php

use Illuminate\Database\Seeder;

class BusinessSubCategory1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_sub_category1s')->insert([[
            'name' => 'Consultancy and Professional Services',
        ]]);
        DB::table('business_sub_category1s')->insert([[
            'name' => 'Communications Services',
        ]]);
        DB::table('business_sub_category1s')->insert([[
            'name' => 'Facilities Rental',
        ]]);
        DB::table('business_sub_category1s')->insert([[
            'name' => 'Financial Services',
        ]]);
        DB::table('business_sub_category1s')->insert([[
            'name' => 'Maintenance Services',
        ]]);
        DB::table('business_sub_category1s')->insert([[
            'name' => 'Media & Communications Services',
        ]]);
        DB::table('business_sub_category1s')->insert([[
            'name' => 'Security Services',
        ]]);
        DB::table('business_sub_category1s')->insert([[
            'name' => 'Travel and Hospitality Services',
        ]]);
        DB::table('business_sub_category1s')->insert([[
            'name' => 'Utilities Services',
        ]]);
    }
}
