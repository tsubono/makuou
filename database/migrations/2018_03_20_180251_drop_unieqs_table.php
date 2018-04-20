<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUnieqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function(Blueprint $table)
        {
            $table->dropUnique('admins_email_unique');
        });
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropUnique('users_email_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function(Blueprint $table)
        {
            $table->unique('email');
        });
        Schema::table('users', function(Blueprint $table)
        {
            $table->unique('email');
        });
    }
}
