<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名前');
            $table->string('name_kana')->comment('名前カナ');
            $table->string('company_name')->nullable()->comment('会社名');
            $table->string('zip_code')->comment('郵便番号');
            $table->integer('pref_id')->comment('都道府県ID');
            $table->string('address1')->comment('住所１');
            $table->string('address2')->nullable()->comment('住所2');
            $table->string('tel')->comment('電話番号');
            $table->string('fax')->comment('FAX番号')->nullable();
            $table->string('email')->unique()->comment('メールアドレス');
            $table->string('password')->comment('パスワード');
            $table->date('birthday')->nullable()->comment('生年月日');
            $table->string('gender')->nullable()->comment('性別:1 男性 2 女性');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
