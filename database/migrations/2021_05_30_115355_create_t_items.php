<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id');
            $table->string('name', 255);
            $table->string('description', 400);
            $table->decimal('unit_cost');
            $table->integer('VAT');
            $table->decimal('sale_price');
            $table->string('characteristics', 400);
            $table->string('composition', 400);
            $table->string('nutritional_values', 400);
            $table->string('ingredients', 400);
            $table->boolean('active');
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
        Schema::dropIfExists('t_items');
    }
}
