<?php

namespace App\Models\Categories;


use App\Types\General\Category as CategoryType;

trait CategoryModifiers
{
    /**
     * Convert database type id to enum
     *
     * @param $value
     * @return CategoryType
     */
    public function getTypeAttribute($value)
    {
        return new CategoryType($value);
    }
}