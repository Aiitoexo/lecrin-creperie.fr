<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPromosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_promos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('promos_id');
            $table->foreign('promos_id')->references('id')->on('promos');
            $table->unsignedBigInteger('menu_items_id');
            $table->foreign('menu_items_id')->references('id')->on('menu_items');
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
        Schema::dropIfExists('item_promos');
    }
}
