<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id_product');
            $table->string('productName');
            $table->string('productDescription');
            $table->decimal('productPrice');
            $table->string('productAmount');
            $table->string('productImage');
            $table->integer('purchases');
            $table->integer('likes');
            $table->integer('comments');
            $table->decimal('discount');
            $table->integer('productStatus');
            $table->integer('id_store');
            $table->integer('id_category');
            $table->integer('id_brand');
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
        Schema::dropIfExists('products');
    }
}
