<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['name', 'price', 'image', 'description', 'category_id'];
    public function getCategory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}