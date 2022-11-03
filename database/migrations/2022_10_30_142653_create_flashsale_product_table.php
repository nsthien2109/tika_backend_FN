<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlashsaleProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flashsale_product', function (Blueprint $table) {
            $table->increments('id_flashsale_product');
            $table->integer('id_flashsale_frame');
            $table->date('sale_day');
            $table->integer('id_product');
            $table->integer('id_store');
            $table->decimal('salePercent');
            $table->integer('amount');
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
        Schema::dropIfExists('flashsale_product');
    }
}
