<?php

namespace App\Models\Posts;


use App\Models\Users\User;
use App\Models\Categories\Category;

trait PostRelationships
{
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id', 'category');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'user');
    }
}