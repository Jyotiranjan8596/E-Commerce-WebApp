<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'description',
        'parentId',
        'slug'
    ];


    public function products(){
        return $this->hasMany(Product::class);
    }

    public function search_product(){
        return $this->hasMany('App\Models\Product','category_id');
    }


    public function parent()
    {
        return $this->belongsTo(self::class,'parentId');
    }

    public function children()
    {
        return $this->belongsTo(self::class,'parentId');
    }

    public function allChildren()
    {
        return $this->children()->with('allChild');
    }
}
