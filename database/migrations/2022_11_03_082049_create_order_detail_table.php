<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->increments('id_order_detail');
            $table->integer('id_order');
            $table->integer('id_product');
            $table->integer('id_size')->nullable();
            $table->integer('id_color')->nullable();
            $table->integer('quantity');
            $table->string('orderCoupon')->nullable();
            $table->double('orderDiscount')->nullable();
            $table->integer('status');
            $table->string('statusType');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_detail');
    }
}
