<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('admins')->insert([
                [
                    'name' => 'admin',
                    'email' => 'tsubono@ga-design.jp',
                    'password' => \Hash::make('secret'),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            ]

        );
    }
}
