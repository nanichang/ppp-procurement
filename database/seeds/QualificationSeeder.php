<?php

use Illuminate\Database\Seeder;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('qualifications')->insert([[
            'name' => "Phd",    
            ], 
            [
             'name' => "Msc",     
            ], 
            [
                'name' => "Bsc",       
            ],
            [
                'name' => "HND",       
            ]
        ]);    
    }
}
