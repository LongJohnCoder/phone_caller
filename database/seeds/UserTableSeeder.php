<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([[
            'name' => 'Jon Vaughn',
            'password' => '$2y$10$28wH3Ae/pMvJy/z.n8ysF.om14MbtTnHKRr9kRgiQ6z..2k.6Gsny',
            'email'	   => 'jon@gmail.com',
            
        ],[
            'name' => 'Super Admin',
            'password' => '$2y$10$28wH3Ae/pMvJy/z.n8ysF.om14MbtTnHKRr9kRgiQ6z..2k.6Gsny',
            'email'	   => 'admin@gmail.com',
            
        ]]);
    }
}
