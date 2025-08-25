<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'products';
    protected $fillable = ['name','sku','price','stock','category_id','description'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
