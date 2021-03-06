<?php

use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'name' => 'Admin',
            'email' => 'admin@ppp.com',
            'user_type' => 'admin',
            'phone' => '08161730129',
            'password' => bcrypt('password'),
        ],
        ]);
    }
}
