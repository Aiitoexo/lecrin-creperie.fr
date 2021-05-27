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
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('type_items_id');
            $table->foreign('type_items_id')->references('id')->on('type_items');
            $table->string('name')->unique();
            $table->string('img');
            $table->text('alt_img');
//            img - > unique
            $table->unsignedBigInteger('category_drinks_id')->nullable();
            $table->foreign('category_drinks_id')->references('id')->on('category_drinks');
            $table->string('capacity_drink')->nullable();
            $table->decimal('price_ht');
            $table->unsignedBigInteger('tva_id');
            $table->foreign('tva_id')->references('id')->on('tva_restaurants');
            $table->decimal('total_tva');
            $table->decimal('price_ttc');
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
