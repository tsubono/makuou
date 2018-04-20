<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name')->comment('会社名');
            $table->string('company_name_kana')->comment('会社名(カナ)')->nullable();
            $table->string('shop_name')->comment('ショップ名');
            $table->string('shop_name_kana')->comment('ショップ名(カナ)')->nullable();
            $table->string('zip_code')->comment('郵便番号');
            $table->integer('pref_id')->comment('都道府県ID');
            $table->string('address1')->comment('住所１');
            $table->string('address2')->comment('住所2');
            $table->string('tel')->comment('電話番号');
            $table->string('fax')->comment('FAX番号')->nullable();
            $table->string('business_hours')->comment('営業時間')->nullable();
            $table->string('email_from')->comment('送信元メールアドレス(From)');
            $table->text('message')->comment('メッセージ')->nullable();
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
        Schema::dropIfExists('shop');
    }
}
