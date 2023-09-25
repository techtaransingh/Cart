<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'product_name',
        'price',
        'quantity',
        'image',
        'product_id',
        'user_id'
    ];
    public function getProducts()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }
}