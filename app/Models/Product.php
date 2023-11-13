<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function other_images() {
        return $this->hasMany(ProductImage::class);
    }
    // public function product_category()
    // {
    //     return $this->hasone(ProductCategory::class, 'id', 'product_category_id');
    // }
}
