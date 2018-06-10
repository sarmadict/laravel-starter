<?php

namespace App\Models\Traits;


use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;

trait HasJalaliTimestamps
{
    public function toJalali($datetime)
    {
        if ($datetime) {
            return verta($datetime);
        }

        return null;
    }

    public function fromJalali($jalali)
    {
        if ($jalali) {
            $jalali = $jalali instanceof Verta ? $jalali : Verta::parse($jalali);

            return Carbon::instance($jalali->DateTime());
        }

        return null;
    }

    public function getJCreatedAtAttribute()
    {
        return $this->toJalali($this->{static::CREATED_AT});
    }

    public function getJUpdatedAtAttribute()
    {
        return $this->toJalali($this->{static::UPDATED_AT});
    }

    public function setJCreatedAtAttribute($value)
    {
        $this->{static::CREATED_AT} = $this->fromJalali($value);
    }

    public function setJUpdatedAtAttribute($value)
    {
        $this->{static::UPDATED_AT} = $this->fromJalali($value);
    }
}