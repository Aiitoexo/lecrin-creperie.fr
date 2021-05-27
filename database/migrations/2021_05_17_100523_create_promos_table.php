<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->mediumText('description');
            $table->boolean('active')->default(true);
            $table->boolean('visible')->default(true);
            $table->boolean('type_code')->default(false);
            $table->boolean('type_quantity')->default(false);
            $table->integer('min_quantity')->nullable();
            $table->integer('max_quantity')->nullable();
            $table->boolean('type_price')->default(false);
            $table->decimal('min_price')->nullable();
            $table->boolean('promo_percentage')->default(false);
            $table->decimal('percentage_discount')->nullable();
            $table->boolean('promo_price')->default(false);
            $table->decimal('price_discount')->nullable();
            $table->boolean('promo_items')->default(false);
            $table->integer('min_items_discount')->nullable();
            $table->integer('max_items_discount')->nullable();
            $table->boolean('type_date')->default(false);
            $table->date('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();
            $table->boolean('type_days')->default(false);
            $table->boolean('mon')->default(false);
            $table->boolean('tue')->default(false);
            $table->boolean('wed')->default(false);
            $table->boolean('thu')->default(false);
            $table->boolean('fri')->default(false);
            $table->boolean('sat')->default(false);
            $table->boolean('sun')->default(false);
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
        Schema::dropIfExists('promos');
    }
}
