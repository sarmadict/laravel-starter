<?php

namespace App\Types;


use MyCLabs\Enum\Enum as BaseEnum;

class Enumeration extends BaseEnum
{
    public static function toFlipArray()
    {
        return array_flip(static::toArray());
    }

    public static function flipTrans($prefix = '')
    {
        return array_map(function ($item) use ($prefix) {
            return trans($prefix . $item);
        }, static::toFlipArray());
    }
}