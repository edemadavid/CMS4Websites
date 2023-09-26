<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCat extends Model
{
    use HasFactory;

    public function blog()
    {
        return $this->hasmany(BlogPost::class, 'category_id', 'id');
    }
}
