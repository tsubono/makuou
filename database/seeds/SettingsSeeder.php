<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("sizes")->truncate();

        $now = Carbon::now();

        DB::table('sizes')->insert([
                [
                    'name' => '縦180cm',
                    'value' => '180',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => '縦150cm',
                    'value' => '150',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => '縦120cm',
                    'value' => '120',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => '縦90cm',
                    'value' => '90',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => '縦60cm',
                    'value' => '60',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            ]

        );

        DB::table("clothes")->truncate();

        DB::table('clothes')->insert([
                [
                    'name' => '通常生地',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'メッシュ生地',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'サテン生地',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => '強化ビニール生地',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            ]

        );

        DB::table("clothes")->truncate();

        DB::table('clothes')->insert([
                [
                    'name' => '通常生地',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'メッシュ生地',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'サテン生地',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => '強化ビニール生地',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            ]

        );

        DB::table("ratios")->truncate();

        DB::table('ratios')->insert([
                [
                    'height' => '1',
                    'width' => '1',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'height' => '1',
                    'width' => '1.5',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'height' => '1',
                    'width' => '2',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'height' => '1',
                    'width' => '3',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'height' => '1',
                    'width' => '4',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            ]
        );

        DB::table("payments")->truncate();

        DB::table('payments')->insert([
                [
                    'name' => 'クレジットカード',
                    'commission' => '0',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => '銀行振込',
                    'commission' => '0',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'コンビニ決済',
                    'commission' => '0',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ]
        );
    }
}
