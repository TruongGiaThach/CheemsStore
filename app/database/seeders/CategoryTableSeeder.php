<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('category')->delete();
        $category = [
            [
                'name' => "Điện máy - Điện gia dụng",
                'description' => "Điện máy - Điện gia dụng",
            ],
            [
                'name' => "Laptop & Macbook",
                'description' => "Laptop & Macbook",
            ],
            [
                'name' => "Điện thoại & Thiết bị thông minh",
                'description' => "Điện thoại & Thiết bị thông minh",
            ],
            [
                'name' => "PC - Máy tính đồng bộ",
                'description' => "PC - Máy tính đồng bộ",
            ],
        ];

        DB::table('category')->insert($category);
    }
}
