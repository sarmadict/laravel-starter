<?php

namespace App\Models\Posts;


use App\Types\Blog\PostStatus;

trait PostModifiers
{
    /**
     * Convert database status id to enum
     *
     * @param $value
     * @return PostStatus
     */
    public function getStatusAttribute($value)
    {
        return new PostStatus($value);
    }

    public function getStatusNameAttribute()
    {
        return trans('admin.posts.elements.status_' . $this->status->getKey());
    }

    public function getExcerptAttribute($value)
    {
        return $value ?: str_limit(strip_tags($this->content), 70);
    }

    public function getJPublishedAtAttribute()
    {
        return $this->published_at;
    }

    public function getJExpiredAtAttribute()
    {
        return $this->expired_at;
    }

    public function getCategoryTitleAttribute()
    {
        return $this->category ? $this->category->title : trans('admin.posts.elements.uncategorized');
    }

    public function getUserNameAttribute($value)
    {
        return $value ?: $this->user->display_name;
    }
}