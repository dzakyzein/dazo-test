<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::connection('mongodb')->create('categories', function ($collection) {
            // kolom dibuat saat insert; cukup pastikan index
        });
        Schema::connection('mongodb')->table('categories', function ($collection) {
            $collection->index('name');
        });
    }
    public function down(): void
    {
        Schema::connection('mongodb')->drop('categories');
    }
};
