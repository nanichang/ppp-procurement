<?php

use Illuminate\Database\Seeder;

class AdvertSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(){
        DB::table('adverts')->insert([[
            'name' => 'PICTDA',
            'budget_year' => '2015',
            'advert_type' => 'private',
            'advert_mode' => 'active',
            'introduction' => 'hello please apply for this advert',
            'advert_publish_date' => '19/07/2019',
            'bid_opening_date' => '20/07/2019',
            'status' => 'disabled',
            'user_id' => '3',
        ],
        [
            'name' => 'PLPBA',
            'budget_year' => '2018',
            'advert_type' => 'public',
            'advert_mode' => 'active',
            'introduction' => 'hello please apply for this advert',
            'advert_publish_date' => '19/4/2019',
            'bid_opening_date' => '20/05/2019',
            'status' => 'disabled',
            'user_id' => '3',
        ]]);
    }
}
