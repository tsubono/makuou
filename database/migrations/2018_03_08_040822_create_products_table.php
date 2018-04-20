<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('タイトル');
            $table->integer('ratio_id')->comment('比率ID');
            $table->string('category_1')->comment('カテゴリーID(スポーツ)')->nullable();
            $table->string('category_2')->comment('カテゴリーID(テイスト)')->nullable();
            $table->string('category_3')->comment('カテゴリーID(シーン)')->nullable();
            $table->string('image_600_layout')->comment('サイズ：600　レイアウト用画像')->nullable();
            $table->string('image_600_copy')->comment('サイズ：600　印刷用データ')->nullable();
            $table->string('image_900_layout')->comment('サイズ：900　レイアウト用画像')->nullable();
            $table->string('image_900_copy')->comment('サイズ：900　印刷用データ')->nullable();
            $table->string('image_1200_layout')->comment('サイズ：1200　レイアウト用画像')->nullable();
            $table->string('image_1200_copy')->comment('サイズ：1200　印刷用データ')->nullable();
            $table->string('image_1500_layout')->comment('サイズ：1500　レイアウト用画像')->nullable();
            $table->string('image_1500_copy')->comment('サイズ：1500　印刷用データ')->nullable();
            $table->string('image_1800_layout')->comment('サイズ：1800　レイアウト用画像')->nullable();
            $table->string('image_1800_copy')->comment('サイズ：1800　印刷用データ')->nullable();
            $table->boolean('status')->comment('true: 公開, false: 非公開')->nullable();
            $table->text('note')->comment('備考・メモ')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
