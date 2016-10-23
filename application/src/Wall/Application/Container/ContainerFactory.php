<?php

declare(strict_types=1);

namespace Wall\Application\Container;

use DI\Container;
use DI\ContainerBuilder;
use Wall\Application\Container\Definitions\ApplicationDefinitions;
use Wall\Application\Container\Definitions\CommandBusDefinitions;
use Wall\Application\Container\Definitions\InfrastructureDefinition;
use Wall\Application\Container\Definitions\TwigDefinitions;

final class ContainerFactory
{
    public static function create(): Container
    {
        $builder = new ContainerBuilder();

        $builder->addDefinitions(ApplicationDefinitions::get());
        $builder->addDefinitions(CommandBusDefinitions::get());
        $builder->addDefinitions(InfrastructureDefinition::get());
        $builder->addDefinitions(TwigDefinitions::get());

        return $builder->build();
    }
}
