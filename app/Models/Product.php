<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'product_name',
        'product_size',
        'Product_price',
        'product_desc',
        'slug'
    ];

    public function images(){
        return $this->hasMany(Image::class);
    }
}
