<?php

use Illuminate\Database\Seeder;

class EmploymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employment_types')->insert([[
            'name' => 'Permanent',
        ]]);
        DB::table('employment_types')->insert([[
            'name' => 'Contract',
        ]]);
    }
}
