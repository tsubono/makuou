<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecreateOrderDetailssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('saved_designs');

        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->comment('受注ID');
            $table->integer('product_id')->comment('商品ID');
            $table->integer('product_type_id')->comment('商品種別ID')->nullable();
            $table->integer('price')->comment('金額');
            $table->integer('number')->comment('個数');
            $table->integer('tax_rate')->comment('税率')->nullable();
            $table->integer('sub_total')->comment('小計');
            $table->string('designed_filename')->comment('デザインファイル名（共通）')->nullable();
            $table->string('designed_image')->comment('デザイン画像ファイルパス')->nullable();
            $table->text('uploaded_files')->comment('デザインでアップロードされた画像')->nullable();
            $table->string('designed_json')->comment('デザインJsonファイルパス')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
