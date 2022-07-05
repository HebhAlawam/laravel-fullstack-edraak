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

            $table->string('name');
            $table->integer('category_id');
           // $table->unsignedInteger('subcategory_id');
            $table->string('description'); 
            $table->float('price',8,2);
            $table->enum('size',['S','M','L','XL','XXL'])->nullable(); //size-values are:S, M, L, XL, or XXL
            $table->string('image');
            $table->text('policy')->nullable();
            $table->softDeletes();
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
