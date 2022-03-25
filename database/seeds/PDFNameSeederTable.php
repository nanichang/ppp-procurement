<?php

use Illuminate\Database\Seeder;

class PDFNameSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('p_d_f_certificate_names')->insert([[
            'category_type' => 'Electrical | Mechanical Engineering',
             'certification_type' => 'Interim Registration Request',
        ],
        [
            'category_type' => 'Building | Construction',
            'certification_type' => 'Interim Registration Request',
       
        ],
        [
            'category_type' => 'Good | Supply',
            'certification_type' => 'Interim Registration Request',
        ]]);
    }
}
