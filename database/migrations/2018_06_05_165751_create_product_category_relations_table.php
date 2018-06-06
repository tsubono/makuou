<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoryRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->comment('テンプレートID');
            $table->integer('product_category_id')->comment('カテゴリーID');
            $table->integer('category_type')->comment('カテゴリー種別 1:スポーツ 2:テイスト 3:シーン');
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
        Schema::dropIfExists('product_product_categories');
    }
}
