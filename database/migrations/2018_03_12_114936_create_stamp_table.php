<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStampTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stamps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('スタンプ名');
            $table->string('stamp_category_id')->comment('スタンプカテゴリID');
            $table->string('image')->comment('画像');
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
        Schema::dropIfExists('stamps');
    }
}
