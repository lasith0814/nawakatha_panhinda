<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_access_role_id' => 1,
            'first_name' => 'System',
            'last_name' => '',
            'nic'=> 'system',
            'password' => Hash::make('pZ4${?$x9(2z$.ZE'),
            'email' => '',
            'mobile' => '',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'user_access_role_id' => 1,
            'first_name' => 'Dyan',
            'last_name' => 'Rusiru',
            'nic'=> '962912133V',
            'password' => Hash::make('abc@12345'),
            'email' => 'dyanrusiru@gmail.com',
            'mobile' => '0771756072',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
