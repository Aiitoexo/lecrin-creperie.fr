<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->index();
            $table->string('id_transaction')->nullable();
            $table->string('status');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('phone');
            $table->string('mail');
            $table->string('adresse')->nullable();
            $table->string('city')->nullable();
            $table->string('postal')->nullable();
            $table->longText('text')->nullable();
            $table->string('type_command');
            $table->longText('command');
            $table->decimal('price');
            $table->boolean('is_prepared')->default(false);
            $table->boolean('is_delivered')->default(false);
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
        Schema::dropIfExists('orders');
    }
}

