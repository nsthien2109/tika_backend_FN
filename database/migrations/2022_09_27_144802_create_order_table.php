<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id_order');
            $table->integer('id_user');
            $table->string('addressProvince');
            $table->string('addressDistrict');
            $table->string('addressCommune');
            $table->string('addressSpecific');
            $table->string('orderEmail');
            $table->string('orderPhone');
            $table->string('orderName');
            $table->string('orderCoupon')->nullable();
            $table->double('orderDiscount')->nullable();
            $table->double('feeship');
            $table->double('orderTotal');
            $table->string('paymentMethod');
            $table->text('orderNotes')->nullable();
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
        Schema::dropIfExists('order');
    }
}
