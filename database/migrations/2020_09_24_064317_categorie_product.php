<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategorieProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('categorie_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categorie_id');
            $table->foreign('categorie_id')
                ->references('id')
                ->on('categories')->onDelete('cascade');


            $table->integer('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
