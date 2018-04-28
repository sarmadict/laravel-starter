<?php

namespace App\Models\Categories;


use App\Models\Posts\Post;

trait CategoryRelationships
{
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}