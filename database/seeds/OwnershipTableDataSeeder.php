<?php

use Illuminate\Database\Seeder;

class OwnershipTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   
        DB::table('ownership_structures')->insert([[
            'name' => "Public",    
            ], 
            [
             'name' => "Private",     
            ], 
            [
                'name' => "Joint",       
            ]
        ]);
    
    }
}
