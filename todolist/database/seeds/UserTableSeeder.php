<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $users = array(
        	array(
        		'name' => 'earlqq',
        		'email' => 'earlqq@gmail.com',
        		'password' => Hash::make('14051996')
        	)
        );

        DB::table('users')->insert($users);
    }
}
