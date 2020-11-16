<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ReaderAccessRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reader_access_roles')->insert(['role_name' => 'Free User']);
        DB::table('reader_access_roles')->insert(['role_name' => 'Premium User']);
    }
}
