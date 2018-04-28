<?php

namespace App\Models\Posts;

use App\Types\PostStatus;

trait PostScopes
{
    public function scopeOfStatus($query, $type)
    {
        return $query->where('status', $type);
    }

    public function scopePublished($query)
    {
        return $query->where('status', PostStatus::PUBLISHED);
    }

    public function scopeActive($query)
    {
        $now = date('Y-m-d H:i:s');

        return $query->enabled()->published()->where('published_at', '<=', $now)->where('expired_at', '>=', $now);
    }
}