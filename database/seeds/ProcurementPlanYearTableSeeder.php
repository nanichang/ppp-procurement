<?php

use Illuminate\Database\Seeder;

class ProcurementPlanYearTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('procurement_years')->insert([[
            'year' => 2021,
            'active' => true
        ]]);
    }
}
