<?php

namespace App\Models\Roles;


trait RoleModifiers
{
    public function getDescriptionExcerptAttribute()
    {
        return $this->description ? str_limit($this->description) : '';
    }
}