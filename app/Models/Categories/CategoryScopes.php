<?php

namespace App\Models\Categories;


use App\Types\General\Category as CategoryType;

trait CategoryScopes
{
    public function scopeOfType($q, $type)
    {
        return $q->where('type', $type);
    }

    public function postType($q)
    {
        return $q->where('type', CategoryType::POST);
    }
}