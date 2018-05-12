<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModSavedDesignsTableAddColumnImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saved_designs', function (Blueprint $table) {
            $table->string('image')->comment('ファイルパス')->nullable()->after('filename');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('saved_designs')) {
            Schema::table('saved_designs', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
    }
}
