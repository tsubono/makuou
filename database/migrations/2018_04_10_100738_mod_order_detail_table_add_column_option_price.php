<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModOrderDetailTableAddColumnOptionPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->integer('option_price')->comment('オプション金額')->after('option_ids')->nullable();
            $table->dropColumn('number');
        });
        Schema::table('order_details', function (Blueprint $table) {
            $table->integer('quantity')->comment('数量')->after('price');
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
            $table->dropColumn('option_price');
            $table->dropColumn('quantity');
        });
        Schema::table('order_details', function (Blueprint $table) {
            $table->integer('number')->comment('数量')->after('price');
        });
    }
}
