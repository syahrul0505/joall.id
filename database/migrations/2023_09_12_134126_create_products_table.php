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
        // Schema::create('products', function (Blueprint $table) {
        //     // $table->id();
        //     // $table->string('name');
        //     // $table->string('slug');
        //     // $table->integer('stock');
        //     // $table->integer('price');
        //     // $table->longText('description');
        //     // $table->unsignedBigInteger('categories_id');
        //     // $table->softDeletes();
        //     // $table->timestamps();
        //     // $table->foreign("categories_id")->references("id")->on("categories");
        // });
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