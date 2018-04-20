<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table("product_categories")->truncate();

        DB::table("product_categories")->insert([
            ['id'=>1, 'name'=>'スポーツ', 'path'=>NULL, 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>2, 'name'=>'テイスト', 'path'=>NULL, 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>3, 'name'=>'シーン', 'path'=>NULL, 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>4, 'name'=>'サッカー・フットサル', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>5, 'name'=>'野球・ソフトボール', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>6, 'name'=>'バスケットボール', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>7, 'name'=>'バレーボール', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>8, 'name'=>'テニス', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>9, 'name'=>'バドミントン', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>10, 'name'=>'ラグビー', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>11, 'name'=>'ハンドボール', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>12, 'name'=>'ドッジボール', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>13, 'name'=>'卓球', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>14, 'name'=>'剣道', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>15, 'name'=>'弓道', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>16, 'name'=>'空手道・柔道', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>17, 'name'=>'陸上競技', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>18, 'name'=>'水泳', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>19, 'name'=>'体操', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>20, 'name'=>'スキー・スノーボード', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>21, 'name'=>'スケート', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>22, 'name'=>'レスリング', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>23, 'name'=>'ダンス', 'path'=>'1', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>24, 'name'=>'シンプル', 'path'=>'2', 'description' => '装飾少なめの定番柄', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>25, 'name'=>'熱血', 'path'=>'2', 'description' => '応援幕らしい炎モチーフ', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>26, 'name'=>'スポーティー', 'path'=>'2', 'description' => 'スポーツ幕らしいデザイン', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>27, 'name'=>'ナチュラル', 'path'=>'2', 'description' => '自然モチーフ', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>28, 'name'=>'インパクト', 'path'=>'2', 'description' => 'とにかく目立ちたい人向け', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>29, 'name'=>'かわいい', 'path'=>'2', 'description' => 'イラスト多めでポップなイメージ', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>30, 'name'=>'ヴィンテージ', 'path'=>'2', 'description' => '古風柄で大人向け', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>31, 'name'=>'ゴージャス', 'path'=>'2', 'description' => 'キラキラや幻想的なデザイン', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>32, 'name'=>'和風', 'path'=>'2', 'description' => '日本柄', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>33, 'name'=>'スポーツ応援', 'path'=>'3', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>34, 'name'=>'お祝い・式典', 'path'=>'3', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>35, 'name'=>'学校行事', 'path'=>'3', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>36, 'name'=>'イベント・フェス', 'path'=>'3', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>37, 'name'=>'ホームパーティー', 'path'=>'3', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
            ['id'=>38, 'name'=>'商売繁盛', 'path'=>'3', 'description' => NULL, 'created_at' => $now, 'updated_at' => $now],
        ]);

    }
}
