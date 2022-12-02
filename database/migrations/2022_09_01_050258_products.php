<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('articles', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('title');
        //     $table->string('url');
        //     $table->text('comment')->nullable();
        //     $table->timestamps();

            Schema::create('articles', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigIncrements('company_id');
                $table->string('product_name');
                $table->string('price');
                $table->string('stock');
                $table->text('comment')->nullable();
                $table->string('img_path');
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
        Schema::dropIfExists('articles');
        //
    }
}