<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStampCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stamp_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('カテゴリー名');
            $table->string('path')->nullable()->comment('カテゴリーパス');
            $table->string('image')->nullable()->comment('カテゴリーイメージ');
            $table->text('description')->nullable()->comment('説明');
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
        Schema::dropIfExists('stamp_categories');
    }
}
