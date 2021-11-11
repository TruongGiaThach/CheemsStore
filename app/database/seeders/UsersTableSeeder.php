<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\
        DB::table('users')->delete();
        
        DB::table('users')->insert([
            'name' => "Admin",
            'email' => "admin@devtest.com",
            'password' => bcrypt('secret'),
            'role' => "admin",
        ]);
        DB::table('users')->insert([    
            'name' => "thach",
            'email' => "thach@staff.com",
            'password' => bcrypt('secret'),
            'role' => "staff",
        ]);
    }
}
