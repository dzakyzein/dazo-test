<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesCollection extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $collection) {
            $collection->string('name');
            $collection->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
