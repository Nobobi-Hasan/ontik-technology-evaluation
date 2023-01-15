<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    // public function products()
    // {
    //     return $this->hasManyThrough(Product::class, Subcategory::class);
    // }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            Subcategory::class,
            'category_id',
            'subcategory_id',
            'id',
            'id'
        );
    }
}
