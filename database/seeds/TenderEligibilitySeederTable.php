<?php

use Illuminate\Database\Seeder;

class TenderEligibilitySeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tender_eligibilities')->insert([[
            'certificate_name' => 'CAC Certificate',
        ]]);
        DB::table('tender_eligibilities')->insert([[
            'certificate_name' => 'ITF Certifcate',
        ]]);
        DB::table('tender_eligibilities')->insert([[
            'certificate_name' => 'Google Certifcate',
        ]]);
        DB::table('tender_eligibilities')->insert([[
            'certificate_name' => 'Facebook Certifcate',
        ]]);
        
    }
}
