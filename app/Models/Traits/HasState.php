<?php

namespace App\Models\Traits;

use App\Types\State;

trait HasState
{
    public function scopeEnabled($query)
    {
        $query->where('state', State::ENABLED);
    }

    public function scopeDisabled($query)
    {
        $query->where('state', State::DISABLED);
    }
}