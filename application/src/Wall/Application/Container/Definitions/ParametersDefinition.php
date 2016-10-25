<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions;

use Symfony\Component\Yaml\Yaml;

final class ParametersDefinition implements Definition
{
    public static function get(): array
    {
        return Yaml::parse(file_get_contents(__DIR__.'/../../../../../config/parameters.yml'));
    }
}
