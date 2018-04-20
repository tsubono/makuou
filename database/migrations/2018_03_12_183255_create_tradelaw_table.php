<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradelawTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradelaw', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seller')->comment('販売業者');
            $table->string('operation_manager')->comment('運営責任者');
            $table->string('zip_code')->comment('郵便番号');
            $table->integer('pref_id')->comment('都道府県ID');
            $table->string('address1')->comment('住所１');
            $table->string('address2')->comment('住所2');
            $table->string('tel')->comment('電話番号');
            $table->string('fax')->comment('FAX番号')->nullable();
            $table->string('email')->comment('メールアドレス');
            $table->text('other_price')->comment('商品代金以外の必要料金');
            $table->text('payment_method')->comment('支払方法');
            $table->text('payment_limit')->comment('支払期限');
            $table->text('delivery_time')->comment('引き渡し時期');
            $table->text('about_returned_exchange')->comment('返品・交換について');
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
        Schema::dropIfExists('tradelaw');
    }
}
