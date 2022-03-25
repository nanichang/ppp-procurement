<?php

use Illuminate\Database\Seeder;

class ComplianceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('compliances')->insert([[
            'company_name' => 'PTDD',
            'parent_company' => 'PPTDD',
            'cac_date_of_reg' => '2019/2/3',
            'cac_number' => '101010w',
            'tcc_no' => '234321',
            'tcc_tin_no' => '3456789',
            'tcc_ownership_structure' => 'Public Limited',
            'tcc_company_ownership' => 'Private',
            'pension_employer_code' => '234321as',
            'pension_certificate_number' => '345678934sd',
            'pension_expiring_date' => '2018/2/3',
            'pension_no_of_employee' => '4',
            'itf_registration_no' => '234321asww',
            'itf_certificate_no' => '345678934sd',
            'itf_payment_date' => '2018/2/3',
            // 'pension_no_of_employee' => '4',
        ]]);
    }
}
