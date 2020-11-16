<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRoleActionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_access_role_user_action')
            ->insert([
                ['user_access_role_id' => 2 , 'user_action_id' => 1 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 2 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 3 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 4 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 5 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 6 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 7 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 8 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 9 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 10 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 11 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 12 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 13, 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 14 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 15 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 16 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 17 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 18 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 19 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 20 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 21 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 22 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 23 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 24 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 25 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 2 , 'user_action_id' => 26 , 'created_at' => now(), 'updated_at' => now()],]);

        DB::table('user_access_role_user_action')
            ->insert([
                ['user_access_role_id' => 1 , 'user_action_id' => 1 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 2 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 3 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 4 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 5 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 6 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 7 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 8 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 9 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 10 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 11 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 12 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 13, 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 14 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 15 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 16 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1, 'user_action_id' => 17 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 18 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 19 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 20 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 21 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 22 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 23 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 24 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 25 , 'created_at' => now(), 'updated_at' => now()],
                ['user_access_role_id' => 1 , 'user_action_id' => 26 , 'created_at' => now(), 'updated_at' => now()],
            ]);
    }
}
