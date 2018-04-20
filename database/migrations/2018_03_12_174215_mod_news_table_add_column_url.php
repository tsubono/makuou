<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModNewsTableAddColumnUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->boolean('blank_flg')->comment('別ウィンドウで開くフラグ')->nullable()->after('title');
            $table->string('url')->comment('URL')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('news', 'url')) ;
        {
            Schema::table('news', function (Blueprint $table) {
                $table->dropColumn('url');
                $table->dropColumn('blank_flg');
            });
        }
    }
}
