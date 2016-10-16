<?php

declare(strict_types=1);

namespace Wall\Application;

use DI\Container;
use DI\ContainerBuilder;

final class ContainerFactory
{
    public static function create(): Container
    {
        $builder = new ContainerBuilder();

        $builder->addDefinitions([
            'twig.template.path'           => __DIR__.'/../Http/Response/Template',
            'twig.cache.path'              => __DIR__.'/../../../var/cache',
            \Twig_Loader_Filesystem::class => function (Container $container) {
                return new \Twig_Loader_Filesystem($container->get('twig.template.path'));
            },
            \Twig_Environment::class => function (Container $container) {
                return new \Twig_Environment(
                    $container->get(\Twig_Loader_Filesystem::class),
                    [
                        'cache' => $container->get('twig.cache.path'),
                    ]
                );
            },
        ]);

        return $builder->build();
    }
}
