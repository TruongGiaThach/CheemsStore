<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
