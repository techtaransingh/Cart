<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}