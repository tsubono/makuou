<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModOrderDetailsTableAddColumnDesignNameNo9te extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->text('note')->comment('備考')->after('designed_json')->nullable();
            $table->string('design_name')->comment('デザイン名')->after('designed_json')->nullable();
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
