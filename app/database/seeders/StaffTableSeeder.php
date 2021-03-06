<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('staff')->delete();

        DB::table('staff')->insert([
            'name' => "Admin",
            'email' => "admin@devtest.com",
            'role' => "admin",
            'cmnd' => '9999999',
            'NumOfDayOff' => '0',
            'salary' => '10000000',
            'dateBegin' => '2/2/2002',
        ]);
        
        DB::table('staff')->insert([
            'name' => "thach",
            'email' => "thach@staff.com",
            'role' => "staff",
            'cmnd' => '32132213',
            'NumOfDayOff' => '0',
            'salary' => '1000000',
            'dateBegin' => '2/2/2002',
        ]);

    }
}
