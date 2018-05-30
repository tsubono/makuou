<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModSavedDesignsTableAddColumnUploadFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saved_designs', function (Blueprint $table) {
            $table->text('uploaded_files')->comment('アップロードされた画像')->nullable()->after('image');
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
                $table->dropColumn('uploaded_files');
            });
        }
    }
}
