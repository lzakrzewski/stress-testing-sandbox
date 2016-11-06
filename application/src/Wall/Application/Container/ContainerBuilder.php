<?php

declare(strict_types=1);

namespace Wall\Application\Container;

use DI\ContainerBuilder as DIContainerBuilder;
use Wall\Application\Container\Definitions\CommandBusDefinitions;
use Wall\Application\Container\Definitions\CommandDefinitions;
use Wall\Application\Container\Definitions\EventBusDefinitions;
use Wall\Application\Container\Definitions\HttpDefinitions;
use Wall\Application\Container\Definitions\Infrastructure\QueryDefinitions;
use Wall\Application\Container\Definitions\Infrastructure\RepositoryDefinitions;
use Wall\Application\Container\Definitions\ParametersDefinitions;
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
        $builder->addDefinitions(RepositoryDefinitions::get());
        $builder->addDefinitions(QueryDefinitions::get());
        $builder->addDefinitions(ParametersDefinitions::get());
        $builder->addDefinitions(SubscriberDefinitions::get());
        $builder->addDefinitions(TwigDefinitions::get());

        return $builder;
    }
}
