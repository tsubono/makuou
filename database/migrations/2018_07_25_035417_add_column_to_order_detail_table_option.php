<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToOrderDetailTableOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->string('nouki_id')->comment('納期')->after('price_id')->nullable();
            $table->string('pole')->comment('付属品（旗用ポール）')->after('price_id')->nullable();
            $table->boolean('pole_flg')->comment('付属品（旗用ポール）有無')->after('price_id')->nullable();
            $table->string('lope_2')->comment('付属品（ロープ）本数')->after('price_id')->nullable();
            $table->string('lope_1')->comment('付属品（ロープ）m')->after('price_id')->nullable();
            $table->boolean('lope_flg')->comment('付属品（ロープ）有無')->after('price_id')->nullable();
            $table->string('hatome')->comment('ハトメの位置')->after('price_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn('design_name');
            $table->dropColumn('note');
        });
    }
}
