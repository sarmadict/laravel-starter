<?php

namespace App\Models\Users;


trait UserModifiers
{
    public function getDisplayNameAttribute($value)
    {
        return $value ?: $this->first_name . " " . $this->last_name;
    }

    public function getJApprovedAtAttribute()
    {
        return $this->toJalali($this->approved_at);
    }

    public function aetJApprovedAtAttribute($value)
    {
        $this->approved_at = $this->fromJalali($value);;
    }

    public function getImageLinkAttribute()
    {
        return $this->image_path ?: $this->getDefaultImagePath();
    }
}