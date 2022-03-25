<?php

use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sales')->insert([[
            'advert_lot_id' => '1',
            'lot_description' => 'mda@logicaladdress.com',
            'advert_id' => '1',
            'advert_introduction' => '08161730129',
            'advert_name' => 'contractor1',
            'amount' => "4000",
            'payment_status' => 'Pending',
            'payment_date' => '2000/1/12',
            'user_id' => "4000",
            'user_name' => 'Pending',
            'mda_id' => '4',
            'mda_name' => 'mda section',
            'transaction_id' => '11111343',
        ]]);

        DB::table('sales')->insert([[
            'advert_lot_id' => '2',
            'lot_description' => 'mda@logicaladdress.com',
            'advert_id' => '2',
            'advert_introduction' => '08161730129',
            'advert_name' => 'contractor2',
            'amount' => "4000",
            'payment_status' => 'Pending',
            'payment_date' => '2000/1/12',
            'user_id' => "4000",
            'user_name' => 'Pending',
            'mda_id' => '4',
            'mda_name' => 'mda section',
            'transaction_id' => '11111300',
        ]]);

        DB::table('sales')->insert([[
            'advert_lot_id' => '1',
            'lot_description' => 'mda@logicaladdress.com',
            'advert_id' => '1',
            'advert_introduction' => '08161730129',
            'advert_name' => 'contractor3',
            'amount' => "4000",
            'payment_status' => 'Pending',
            'payment_date' => '2000/1/12',
            'user_id' => "4000",
            'user_name' => 'Pending',
            'mda_id' => '4',
            'mda_name' => 'mda section',
            'transaction_id' => '0000343',
        ]]);
    }
}
