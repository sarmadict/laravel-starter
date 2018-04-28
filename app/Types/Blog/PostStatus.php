<?php

namespace App\Types\Blog;

use App\Types\Enumeration;

class PostStatus extends Enumeration
{
    const DRAFT = 1;

    const PENDING = 2;

    const PUBLISHED = 3;
}