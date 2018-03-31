<?php

namespace App\Services\Alert\Types;

use App\Types\Enum;

class Severity extends Enum
{
    const SUCCESS = 1;

    const DEBUG = 2;

    const INFO = 3;

    const NOTICE = 4;

    const WARNING = 5;

    const ERROR = 6;

    const CRITICAL = 7;

    const ALERT = 8;

    const EMERGENCY = 9;
}