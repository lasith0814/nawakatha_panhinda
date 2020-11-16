<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserActionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_actions')->insert(['action_name' => 'View user', 'user_action_category_id'=> 1 , 'font_text' => 'View' , 'div_id' => 'userview']);
        DB::table('user_actions')->insert(['action_name' => 'Add user', 'user_action_category_id'=> 1 , 'font_text' => 'Add' , 'div_id' => 'usercreate']);
        DB::table('user_actions')->insert(['action_name' => 'Update user/Password reset', 'user_action_category_id'=> 1 , 'font_text' => 'Update' , 'div_id' => 'userupdate']);
        DB::table('user_actions')->insert(['action_name' => 'Activate/Deactivate user', 'user_action_category_id'=> 1 , 'font_text' => 'On/Off' , 'div_id' => 'useronoff']);
        DB::table('user_actions')->insert(['action_name' => 'View Access Role', 'user_action_category_id'=> 2 , 'font_text' => 'View' , 'div_id' => 'roleview']);
        DB::table('user_actions')->insert(['action_name' => 'Add Access Role', 'user_action_category_id'=> 2 , 'font_text' => 'Add' , 'div_id' => 'roleadd']);
        DB::table('user_actions')->insert(['action_name' => 'Update Access Role', 'user_action_category_id'=> 2 , 'font_text' => 'Update' , 'div_id' => 'roleupdate']);

        DB::table('user_actions')->insert(['action_name' => 'View reader', 'user_action_category_id'=> 3 , 'font_text' => 'View' , 'div_id' => 'readerview']);
        DB::table('user_actions')->insert(['action_name' => 'Add reader', 'user_action_category_id'=> 3 , 'font_text' => 'Add' , 'div_id' => 'readercreate']);
        DB::table('user_actions')->insert(['action_name' => 'Update reader', 'user_action_category_id'=> 3 , 'font_text' => 'Update' , 'div_id' => 'readerupdate']);
        DB::table('user_actions')->insert(['action_name' => 'Activate/Deactivate reader', 'user_action_category_id'=> 3 , 'font_text' => 'On/Off' , 'div_id' => 'readeronoff']);

        DB::table('user_actions')->insert(['action_name' => 'View book', 'user_action_category_id'=> 4 , 'font_text' => 'View' , 'div_id' => 'bookview']);
        DB::table('user_actions')->insert(['action_name' => 'Add book', 'user_action_category_id'=> 4 , 'font_text' => 'Add' , 'div_id' => 'bookcreate']);
        DB::table('user_actions')->insert(['action_name' => 'Update book', 'user_action_category_id'=> 4 , 'font_text' => 'Update' , 'div_id' => 'bookupdate']);
        DB::table('user_actions')->insert(['action_name' => 'Activate/Deactivate book', 'user_action_category_id'=> 4 , 'font_text' => 'On/Off' , 'div_id' => 'bookonoff']);
        DB::table('user_actions')->insert(['action_name' => 'Remove book', 'user_action_category_id'=> 4 , 'font_text' => 'Delete' , 'div_id' => 'bookdelete']);

        DB::table('user_actions')->insert(['action_name' => 'View page', 'user_action_category_id'=> 5 , 'font_text' => 'View' , 'div_id' => 'pageview']);
        DB::table('user_actions')->insert(['action_name' => 'Add page', 'user_action_category_id'=> 5 , 'font_text' => 'Add' , 'div_id' => 'pageadd']);
        DB::table('user_actions')->insert(['action_name' => 'Update page', 'user_action_category_id'=> 5 , 'font_text' => 'Update' , 'div_id' => 'pageupdate']);
        DB::table('user_actions')->insert(['action_name' => 'Remove page', 'user_action_category_id'=> 5 , 'font_text' => 'Delete' , 'div_id' => 'pagedelete']);

        DB::table('user_actions')->insert(['action_name' => 'View book category', 'user_action_category_id'=> 6 , 'font_text' => 'View' , 'div_id' => 'categoryview']);
        DB::table('user_actions')->insert(['action_name' => 'Add book category', 'user_action_category_id'=> 6, 'font_text' => 'Add' , 'div_id' => 'categoryadd']);
        DB::table('user_actions')->insert(['action_name' => 'Update book category', 'user_action_category_id'=> 6 , 'font_text' => 'Update' , 'div_id' => 'categoryupdate']);
        DB::table('user_actions')->insert(['action_name' => 'View author', 'user_action_category_id'=> 7 , 'font_text' => 'View' , 'div_id' => 'authorview']);
        DB::table('user_actions')->insert(['action_name' => 'Add author', 'user_action_category_id'=> 7 , 'font_text' => 'Add' , 'div_id' => 'authoradd']);
        DB::table('user_actions')->insert(['action_name' => 'Update author', 'user_action_category_id'=> 7 , 'font_text' => 'Update' , 'div_id' => 'authorupdate']);
    }
}
