<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([[
            'name' => "Nigeria",    
            ], 
            [
             'name' => "Italy",     
            ], 
            [
                'name' => "Germany",       
            ],
            [
                'name' => "Canada",       
            ]
        ]);
    }
}
