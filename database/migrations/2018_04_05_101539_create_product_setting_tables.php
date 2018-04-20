<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSettingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名前');
            $table->text('note')->comment('備考')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('ratios', function (Blueprint $table) {
            $table->increments('id');
            $table->float('height')->comment('縦');
            $table->float('width')->comment('横');
            $table->text('note')->comment('備考')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('clothes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名前');
            $table->text('note')->comment('備考')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名前');
            $table->smallInteger('type')->comment('種別 1:固定 2:選択');
            $table->integer('price')->comment('値段')->nullable();
            $table->text('note')->comment('備考')->nullable();
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
        Schema::dropIfExists('sizes');
        Schema::dropIfExists('ratios');
        Schema::dropIfExists('clothes');
        Schema::dropIfExists('options');
    }
}
