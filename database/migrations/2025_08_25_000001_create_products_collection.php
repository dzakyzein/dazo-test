<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::connection('mongodb')->create('products', function ($collection) {});
        Schema::connection('mongodb')->table('products', function ($collection) {
            $collection->index('sku');
            $collection->index('category_id');
        });
    }
    public function down(): void
    {
        Schema::connection('mongodb')->drop('products');
    }
};
