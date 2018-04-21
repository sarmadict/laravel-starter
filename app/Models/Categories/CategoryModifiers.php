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

    public function getTypeNameAttribute()
    {
        return trans('admin.categories.elements.type_'. $this->type->getKey());
    }

    public function getParentTitleAttribute()
    {
        return $this->parent ? $this->parent->title : trans('admin.categories.elements.without_parent');
    }
}