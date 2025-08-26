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
        'variant',
        'type',
        'category_id',
        'description',
        'status',
        'selling_price',
        'special_price',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
