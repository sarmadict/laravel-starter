<?php

namespace App\Models\Users;


use App\Types\Blog\PostStatus;

trait UserModifiers
{
    public function getDisplayNameAttribute($value)
    {
        return $value ?: $this->first_name . " " . $this->last_name;
    }

    public function getJCreatedAtAttribute()
    {
        return $this->created_at;
    }

    public function getJApprovedAtAttribute()
    {
        return $this->updated_at;
    }

    public function getJUpdatedAtAttribute()
    {
        return $this->approved_at ?: trans('admin.users.elements.User not approved');
    }
}