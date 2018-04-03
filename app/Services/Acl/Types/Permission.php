<?php

namespace App\Services\Acl\Types;

use App\Types\Enumeration;

class Permission extends Enumeration
{
    const PRIMARY = 1;

    const SECONDARY = 2;
}