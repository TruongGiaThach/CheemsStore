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
                '_id' => 'cate1',
                'name' => "Điện máy - Điện gia dụng",
                'description' => "Điện máy - Điện gia dụng",
            ],
            [
                '_id' => 'cate2',
                'name' => "Laptop & Macbook",
                'description' => "Laptop & Macbook",
            ],
            [
                '_id' => 'cate3',
                'name' => "Điện thoại & Thiết bị thông minh",
                'description' => "Điện thoại & Thiết bị thông minh",
            ],
            [
                '_id' => 'cate4',
                'name' => "PC - Máy tính đồng bộ",
                'description' => "PC - Máy tính đồng bộ",
            ],
        ];

        DB::table('category')->insert($category);
    }
}