<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('orders');

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('会員ID')->nullable();
            $table->tinyInteger('status')->comment('ステータス：NULL.カート 1.新規受付 2.決済処理中 3.入金待ち 4.入金済み 5.キャンセル 6.取り寄せ中 7.発送済み')->nullable();
            $table->integer('payment_id')->comment('支払い方法ID')->nullable();
            $table->integer('order_shipping_address_id')->comment('受注配送先ID')->nullable();
            $table->text('message')->comment('お問い合わせ')->nullable();
            $table->text('note')->comment('ショップ用メモ欄')->nullable();
            $table->integer('sub_total')->comment('小計')->nullable();
            $table->integer('discount')->comment('値引き')->nullable();
            $table->integer('shipping_cost')->comment('送料')->nullable();
            $table->integer('fee')->comment('手数料')->nullable();
            $table->integer('total')->comment('合計')->nullable();
            $table->integer('payment_total')->comment('支払い合計')->nullable();
            $table->dateTime('ordered_at')->comment('注文日')->nullable();
            $table->dateTime('payment_at')->comment('支払日')->nullable();
            $table->dateTime('shipping_at')->comment('発送日')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
