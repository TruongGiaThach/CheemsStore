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
                'name' => "Cheems1",
                'image' => "product.webp",
                'amount' => "10",
                'importPrice' => "100000",
                'outportPrice' => "900000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => "69",
                'category_id' => "0",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]"
            ],
            [
                'name' => "ĐIỆn thoại thông minh số 1 Việt Nam",
                'image' => "product(1).webp",
                'amount' => "10",
                'importPrice' => "100000",
                'outportPrice' => "900000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => "69",
                'category_id' => "0",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]"
            ],
            [
                'name' => "Cheems1",
                'image' => "product(2).webp",
                'amount' => "10",
                'importPrice' => "100000",
                'outportPrice' => "800000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => "69",
                'category_id' => "0",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]"
            ],
            [
                'name' => "Cheems1",
                'image' => "product(3).webp",
                'amount' => "10",
                'importPrice' => "100000",
                'outportPrice' => "700000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => "69",
                'category_id' => "0",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]"
            ],
            [
                'name' => "Cheems1",
                'image' => "product(4).webp",
                'amount' => "10",
                'importPrice' => "100000",
                'outportPrice' => "900000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => "69",
                'category_id' => "0",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]"
            ],
            [
                'name' => "Cheems1",
                'image' => "product(5).webp",
                'amount' => "10",
                'importPrice' => "100000",
                'outportPrice' => "600000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => "69",
                'category_id' => "0",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]"
            ],
            [
                'name' => "XÚC XÍCH PONIE",
                'image' => "product(6).webp",
                'amount' => "10",
                'importPrice' => "100000",
                'outportPrice' => "500000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => "69",
                'category_id' => "0",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]"
            ],
            [
                'name' => "88% THỊT",
                'image' => "product(7).webp",
                'amount' => "10",
                'importPrice' => "100000",
                'outportPrice' => "88",
                'manufacture' => "Cheems",
                'warrantyPeriod' => "69",
                'category_id' => "0",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]"
            ],
            [
                'name' => "Cheems1",
                'image' => "product(8).webp",
                'amount' => "10",
                'importPrice' => "100000",
                'outportPrice' => "900000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => "69",
                'category_id' => "0",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]"
            ],
            [
                'name' => "Cheems1",
                'image' => "product(9).webp",
                'amount' => "10",
                'importPrice' => "100000",
                'outportPrice' => "900000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => "69",
                'category_id' => "0",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]"
            ],
            [
                'name' => "Cheems1",
                'image' => "product(10).webp",
                'amount' => "10",
                'importPrice' => "100000",
                'outportPrice' => "900000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => "69",
                'category_id' => "0",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]"
            ],
            [
                'name' => "Cheems1",
                'image' => "product(11).webp",
                'amount' => "10",
                'importPrice' => "100000",
                'outportPrice' => "900000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => "69",
                'category_id' => "0",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]"
            ],
            [
                'name' => "Cheems1",
                'image' => "product(12).webp",
                'amount' => "10",
                'importPrice' => "100000",
                'outportPrice' => "900000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => "69",
                'category_id' => "0",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]"
            ],
            [
                'name' => "Cheems1",
                'image' => "category.webp",
                'amount' => "10",
                'importPrice' => "100000",
                'outportPrice' => "900000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => "69",
                'category_id' => "0",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]"
            ],
            [
                'name' => "Cheems1",
                'image' => "brand-1.webp",
                'amount' => "10",
                'importPrice' => "100000",
                'outportPrice' => "900000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => "69",
                'category_id' => "0",
                'description' => "Hàng fake",
                'tag' => "[pc, điện thoại, laptop]"
            ],
            [
                'name' => "Cheems1",
                'image' => "1.webp",
                'amount' => "10",
                'importPrice' => "100000",
                'outportPrice' => "900000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => "69",
                'category_id' => "0",
                'description' => "Hàng fake",
                'tag' => "[pc, laptop]"
            ],
        ];

        DB::table('products')->insert($products);
    }
}
