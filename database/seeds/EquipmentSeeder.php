<?php

use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipments')->insert([[
            'equipment_type' => "Trailer",    
            ], 
            [
             'equipment_type' => "BullDozer",     
            ], 
            [
                'equipment_type' => "Payloader",       
            ],
            [
                'equipment_type' => "Tipper",       
            ]
        ]);
    }
}
