<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavedDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saved_designs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->comment('テンプレートID');
            $table->string('filename')->comment('ファイル名');
            $table->text('json')->comment('Json');
            $table->integer('user_id')->comment('会員ID');
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
        Schema::dropIfExists('saved_designs');
    }
}
