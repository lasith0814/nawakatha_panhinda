<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserActionCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_action_categories')->insert(['name' => 'User']); // 1
        DB::table('user_action_categories')->insert(['name' => 'Role']); // 2
        DB::table('user_action_categories')->insert(['name' => 'Reader']); // 3
        DB::table('user_action_categories')->insert(['name' => 'Ebook']); // 4
        DB::table('user_action_categories')->insert(['name' => 'Page']); // 5
        DB::table('user_action_categories')->insert(['name' => 'Category']); // 6
        DB::table('user_action_categories')->insert(['name' => 'Author']); // 7

    }
}
