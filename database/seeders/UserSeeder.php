<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'Test Org', 'email' => 'testorg@email.com', 'password' => Hash::make('testpassword'), 'type' => 'Organization'],
            ['name' => 'Test Student', 'email' => 'teststud@email.com', 'password' => Hash::make('testpassword'), 'type' => 'Student']
        ]);
    }
}
