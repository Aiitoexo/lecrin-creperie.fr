<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllergensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allergens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu');
            $table->foreign('menu_id')->references('id')->on('menu_items')->onDelete('cascade');
            $table->unsignedBigInteger('allergen');
            $table->foreign('allergen_id')->references('id')->on('all_allergens')->onDelete('cascade');
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
        Schema::dropIfExists('allergens');
    }
}
