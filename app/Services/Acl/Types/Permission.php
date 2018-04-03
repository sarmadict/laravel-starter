<?php

namespace App\Services\Acl\Types;

use App\Types\Enum;

class Permission extends Enum
{
    const PRIMARY = 1;

    const SECONDARY = 2;
}