<?php

use Illuminate\Database\Seeder;

class MDATableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mdas')->insert([[
            'name' => 'The Federal Politechnic Nasarawa',
            'profile_pic' => 'logo',
            'mda_code' => '378273',
            'mda_shortcode' => '378273',
            'subsector' => 'Economic Sector',
            'address' => 'Economic Sector',
            'email' => 'sector@gmail.com',
            'password' => 'password',
            'mandate' => 'mandate',
            'bank_name' => 'GTB',
            'bank_account' => '1234567890',
            'split_percentage' => '0.5'
        ]]);
    }
}
