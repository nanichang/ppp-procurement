<?php

use Illuminate\Database\Seeder;

class ContractorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contractors')->insert([[
            'company_name' => 'Facebook',
            'cac_number' => '00000000',
            'address' => 'home',
            'city' => 'Jos',
            'country' => 'Congo',
            'email' => 'nani@gmail.com',
            'website' => 'wwww',
            'user_id' => '2'
        ]]);
    }
}
