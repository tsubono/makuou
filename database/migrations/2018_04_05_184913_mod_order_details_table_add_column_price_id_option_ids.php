<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModOrderDetailsTableAddColumnPriceIdOptionIds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->string('option_ids')->comment('仕上げオプションID')->after('product_type_id')->nullable();
            $table->integer('price_id')->comment('値段設定ID')->after('product_type_id');
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
            $table->dropColumn('price_id');
            $table->dropColumn('option_ids');
        });
    }
}
