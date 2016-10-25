<?php

declare(strict_types=1);

namespace Wall\Application\Container;

use DI\ContainerBuilder as DIContainerBuilder;
use Wall\Application\Container\Definitions\CommandBusDefinitions;
use Wall\Application\Container\Definitions\CommandDefinitions;
use Wall\Application\Container\Definitions\EventBusDefinitions;
use Wall\Application\Container\Definitions\HttpDefinitions;
use Wall\Application\Container\Definitions\InfrastructureDefinition;
use Wall\Application\Container\Definitions\ParametersDefinition;
use Wall\Application\Container\Definitions\SubscriberDefinitions;
use Wall\Application\Container\Definitions\TwigDefinitions;

final class ContainerBuilder
{
    public static function create(): DIContainerBuilder
    {
        $builder = new DIContainerBuilder();

        $builder->addDefinitions(CommandBusDefinitions::get());
        $builder->addDefinitions(CommandDefinitions::get());
        $builder->addDefinitions(HttpDefinitions::get());
        $builder->addDefinitions(EventBusDefinitions::get());
        $builder->addDefinitions(InfrastructureDefinition::get());
        $builder->addDefinitions(ParametersDefinition::get());
        $builder->addDefinitions(SubscriberDefinitions::get());
        $builder->addDefinitions(TwigDefinitions::get());

        return $builder;
    }
}
