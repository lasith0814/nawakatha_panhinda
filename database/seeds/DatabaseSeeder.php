<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        $this->call([UserActionTableSeeder::class]);
        $this->call([UserAccessRoleTableSeeder::class]);
        $this->call([ReaderAccessRoleTableSeeder::class]);
        $this->call([UserRoleActionTableSeeder::class]);
        $this->call([UserActionCategoryTableSeeder::class]);
    }
}
