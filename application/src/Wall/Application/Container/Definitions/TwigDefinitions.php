<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions;

use DI;
use Wall\Application\Query\ClientStatisticsQuery;
use Wall\Application\Query\PublisherStatisticsQuery;
use Wall\Http\Response\Template\Extension\ClientStatisticsExtension;
use Wall\Http\Response\Template\Extension\PublisherStatisticsExtension;

final class TwigDefinitions implements Definitions
{
    public static function get(): array
    {
        return [
            'twig.template.path'                => __DIR__.'/../../../Http/Response/Template',
            'twig.cache.path'                   => __DIR__.'/../../../../../var/cache',
            PublisherStatisticsExtension::class => DI\object()
                ->constructor(DI\get(PublisherStatisticsQuery::class)),
            ClientStatisticsExtension::class => DI\object()
                ->constructor(DI\get(ClientStatisticsQuery::class)),
            \Twig_Loader_Filesystem::class => DI\object()
                ->constructor(DI\get('twig.template.path')),
            \Twig_Environment::class => DI\object()
                ->constructor(DI\get(\Twig_Loader_Filesystem::class))
                ->method('addFunction', new \Twig_SimpleFunction('asset', function ($asset) {
                    return sprintf('%s', ltrim($asset, '/'));
                }))
                ->method('addExtension', DI\get(PublisherStatisticsExtension::class))
                ->method('addExtension', DI\get(ClientStatisticsExtension::class)),
        ];
    }
}
