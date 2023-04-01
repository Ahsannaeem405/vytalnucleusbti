<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('upc')->nullable();
            $table->text('name')->nullable();
            $table->text('qty')->nullable();
            $table->text('image')->nullable();
            $table->text('box_id')->nullable();
            $table->text('sku')->nullable();
            $table->text('tag')->nullable();
            $table->text('var')->nullable();
            $table->text('cat')->nullable();
            $table->text('read')->nullable();
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
