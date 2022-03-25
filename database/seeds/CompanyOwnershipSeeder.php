<?php

use Illuminate\Database\Seeder;

class CompanyOwnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_ownerships')->insert([[
            'name' => "Public",    
            ], 
            [
             'name' => "Private",     
            ], 
            [
                'name' => "Joint",       
            ]
        ]);    }
}
