<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    public function blogCategory()
    {
        return $this->hasone(BlogCat::class, 'id', 'category_id');
    }

    public function blogComments()
    {
        return $this->hasMany(BlogComment::class, 'blog_id', 'id');
    }
}
