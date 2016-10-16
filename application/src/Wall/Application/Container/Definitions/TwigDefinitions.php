<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions;

use DI\Container;

final class TwigDefinitions
{
    public static function get()
    {
        return [
            'twig.template.path'           => __DIR__.'/../../../Http/Response/Template',
            'twig.cache.path'              => __DIR__.'/../../../../../var/cache',
            \Twig_Loader_Filesystem::class => function (Container $container) {
                return new \Twig_Loader_Filesystem($container->get('twig.template.path'));
            },
            \Twig_Environment::class => function (Container $container) {
                $twig = new \Twig_Environment(
                    $container->get(\Twig_Loader_Filesystem::class),
                    [
                        'cache' => $container->get('twig.cache.path'),
                    ]
                );

                $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) {
                    return sprintf('%s', ltrim($asset, '/'));
                }));

                return $twig;
            },
        ];
    }
}
