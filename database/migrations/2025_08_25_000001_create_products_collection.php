<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsCollection extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $collection) {
            $collection->string('name');
            $collection->string('variant');
            $collection->string('type');
            $collection->string('category_id');
            $collection->text('description')->nullable();
            $collection->string('status');
            $collection->integer('selling_price');
            $collection->integer('special_price')->nullable();
            $collection->string('imageUrl')->nullable();
            $collection->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
