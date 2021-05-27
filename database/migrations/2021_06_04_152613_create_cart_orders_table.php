<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('menu_item_id')->nullable();
            $table->foreign('menu_item_id')->references('id')->on('menu_items');
            $table->string('name');
            $table->string('detail')->nullable();
            $table->decimal('tva');
            $table->decimal('price_ht');
            $table->decimal('total_tva');
            $table->decimal('price_ttc');
            $table->string('img');
            $table->integer('quantity');
            $table->decimal('total_price_ht');
            $table->decimal('total_price_tva');
            $table->decimal('total_price_ttc');
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
        Schema::dropIfExists('cart_orders');
    }
}
