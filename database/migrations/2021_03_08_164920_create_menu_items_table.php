<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('img');
            $table->text('alt_img');
//            img - > unique
            $table->float('price_ht');
            $table->unsignedBigInteger('tva_id');
            $table->foreign('tva_id')->references('id')->on('tva_restaurants');
            $table->float('total_tva');
            $table->float('price_ttc');
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('section_menus');
            $table->boolean('menu');
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
        Schema::dropIfExists('menu_items');
    }
}
