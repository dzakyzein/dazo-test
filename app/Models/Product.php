<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'products';

    protected $fillable = [
        'name',
        'category_id',
        'sku',
        'active',
        'stock',
        'cost',
        'price',
        'special_price',
        'imageUrl'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', '_id');
    }
}
