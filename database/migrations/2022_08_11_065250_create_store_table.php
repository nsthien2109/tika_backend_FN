<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store', function (Blueprint $table) {
            $table->increments('id_store');
            $table->string('storeName')->unique();
            $table->string('storeWebsite')->nullable();
            $table->string('storeDescription');
            $table->string('storeAddress');
            $table->string('storeCity');
            $table->string('storeCountry');
            $table->string('storePhone');
            $table->string('storeEmail')->unique();
            $table->string('storeBackgroundImage')->nullable();
            $table->integer('storeStatus');
            $table->integer('id_user')->unique();
            $table->string('storeAvatar')->nullable();
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
        Schema::dropIfExists('store');
    }
}
