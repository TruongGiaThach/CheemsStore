<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();
        $products = [
            [
                'name' => "Cheems0",
                'image' => "product.webp",
                'amount' => 10,
                'importPrice' => 10000,
                'outportPrice' => 900000,
                'manufacture' => "Cheems",
                'warrantyPeriod' => 69,
                'category_id' => "cate2",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]",
                'created_at' => "12/8/2021"
            ],
            [
                'name' => "ĐIỆn thoại thông minh số 1 Việt Nam",
                'image' => "product(1).webp",
                'amount' => 10,
                'importPrice' => 10000,
                'outportPrice' => 900000,
                'manufacture' => "Cheems",
                'warrantyPeriod' => 69,
                'category_id' => "cate2",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]",
                'created_at' => "12/8/2021"
            ],
            [
                'name' => "Cheems111",
                'image' => "product(2).webp",
                'amount' => 10,
                'importPrice' => 10000,
                'outportPrice' => "800000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => 69,
                'category_id' => "cate2",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]",
                'created_at' => "12/8/2021"
            ],
            [
                'name' => "Cheems3",
                'image' => "product(3).webp",
                'amount' => 10,
                'importPrice' => 10000,
                'outportPrice' => "700000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => 69,
                'category_id' => "cate2",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]",
                'created_at' => "12/8/2021"
            ],
            [
                'name' => "Cheems1",
                'image' => "product(4).webp",
                'amount' => 10,
                'importPrice' => 10000,
                'outportPrice' => 900000,
                'manufacture' => "Cheems",
                'warrantyPeriod' => 69,
                'category_id' => "cate4",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]"
                ,
                'created_at' => "12/10/2021"
            ],
            [
                'name' => "Cheems4",
                'image' => "product(5).webp",
                'amount' => 10,
                'importPrice' => 10000,
                'outportPrice' => "600000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => 69,
                'category_id' => "cate2",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]",
                'created_at' => "12/8/2021"
            ],
            [
                'name' => "XÚC XÍCH PONIE",
                'image' => "product(6).webp",
                'amount' => 10,
                'importPrice' => 10000,
                'outportPrice' => "500000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => 69,
                'category_id' => "cate3",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]",
                'created_at' => "12/9/2021"
            ],
            [
                'name' => "88% THỊT",
                'image' => "product(7).webp",
                'amount' => 10,
                'importPrice' => 10000,
                'outportPrice' => "88",
                'manufacture' => "Cheems",
                'warrantyPeriod' => 69,
                'category_id' => "cate4",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]",
                'created_at' => "12/10/2021"
            ],
            [
                'name' => "Cheems5",
                'image' => "product(8).webp",
                'amount' => 10,
                'importPrice' => 10000,
                'outportPrice' => 900000,
                'manufacture' => "Cheems",
                'warrantyPeriod' => 69,
                'category_id' => "cate3",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]",
                'created_at' => "12/9/2021"
            ],
            [
                'name' => "Cheems6",
                'image' => "product(9).webp",
                'amount' => 10,
                'importPrice' => 10000,
                'outportPrice' => 900000,
                'manufacture' => "Cheems",
                'warrantyPeriod' => 69,
                'category_id' => "cate1",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]",
                'created_at' => "12/11/2021"
            ],
            [
                'name' => "Cheems7",
                'image' => "product(10).webp",
                'amount' => 10,
                'importPrice' => 10000,
                'outportPrice' => 900000,
                'manufacture' => "Cheems",
                'warrantyPeriod' => 69,
                'category_id' => "cate3",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]",
                'created_at' => "12/9/2021"
            ],
            [
                'name' => "Cheems8",
                'image' => "product(11).webp",
                'amount' => 10,
                'importPrice' => 10000,
                'outportPrice' => 900000,
                'manufacture' => "Cheems",
                'warrantyPeriod' => 69,
                'category_id' => "cate1",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]",
                'created_at' => "12/11/2021"
            ],
            [
                'name' => "Cheems9",
                'image' => "product(12).webp",
                'amount' => 10,
                'importPrice' => 10000,
                'outportPrice' => 900000,
                'manufacture' => "Cheems",
                'warrantyPeriod' => 70,
                'category_id' => "cate3",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]",
                'created_at' => "12/9/2021"
            ],
            [
                'name' => "Cheems10",
                'image' => "category.webp",
                'amount' => 10,
                'importPrice' => 10000,
                'outportPrice' => 900000,
                'manufacture' => "Cheems",
                'warrantyPeriod' => 69,
                'category_id' => "cate3",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]",
                'created_at' => "12/9/2021"
            ],
            [
                'name' => "Cheems11",
                'image' => "brand-1.webp",
                'amount' => 10,
                'importPrice' => 10000,
                'outportPrice' => 900000,
                'manufacture' => "Cheems",
                'warrantyPeriod' => 69,
                'category_id' => "cate3",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]",
                'created_at' => "12/9/2021"
            ],
            [
                'name' => "Cheems12",
                'image' => "1.webp",
                'amount' => 11,
                'importPrice' => 10000,
                'outportPrice' => 900000,
                'manufacture' => "Cheems",
                'warrantyPeriod' => 69,
                'category_id' => "cate3",
                'description' => "Hàng fake",
                'tag' => "[pc, laptop]",
                'created_at' => "12/9/2021"
            ],
        ];

        DB::table('products')->insert($products);
    }
}
