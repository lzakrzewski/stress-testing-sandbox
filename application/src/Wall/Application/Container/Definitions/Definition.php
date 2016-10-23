<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions;

interface Definition
{
    public static function get(): array;
}
