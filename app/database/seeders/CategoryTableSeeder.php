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
            [
                '_id' => 'cate5',
                'name' => "Màn hình máy tính",
                'description' => "Màn hình máy tính",
            ],
            [
                '_id' => 'cate6',
                'name' => "Linh kiện máy tính",
                'description' => "Linh kiện máy tính",
            ],
            [
                '_id' => 'cate7',
                'name' => "High end Gaming",
                'description' => "High end Gaming",
            ],
            [
                '_id' => 'cate8',
                'name' => "Phụ kiện & thiết bị ngoại vi",
                'description' => "Phụ kiện & thiết bị ngoại vi",
            ],
            [
                '_id' => 'cate9',
                'name' => "Thiết bị âm thanh",
                'description' => "Thiết bị âm thanh",
            ],
            [
                '_id' => 'cate10',
                'name' => "Máy ảnh - Máy quay phim",
                'description' => "Máy ảnh - Máy quay phim",
            ],
            [
                '_id' => 'cate11',
                'name' => "Thiết bị văn phòng",
                'description' => "Thiết bị văn phòng",
            ],
            [
                '_id' => 'cate12',
                'name' => "Thiết bị mạng - An ninh",
                'description' => "Thiết bị mạng - An ninh",
            ],
            [
                '_id' => 'cate13',
                'name' => "Giải pháp doanh nghiệp",
                'description' => "Giải pháp doanh nghiệp",
            ],
        ];

        DB::table('category')->insert($category);
    }
}