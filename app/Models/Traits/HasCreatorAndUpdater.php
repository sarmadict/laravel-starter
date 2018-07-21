<?php

namespace App\Models\Traits;


use App\Models\Users\User;

trait HasCreatorAndUpdater
{
    public static $CREATED_BY = 'created_by';

    public static $UPDATED_BY = 'updated_by';

    public function creator()
    {
        return $this->belongsTo(User::class, static::$CREATED_BY, 'id');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, static::$UPDATED_BY, 'id');
    }

    public function getCreatorNameAttribute()
    {
        return $this->creator ? $this->creator->display_name : null;
    }

    public function getUpdaterNameAttribute()
    {
        return $this->updater ? $this->updater->display_name : null;
    }
}