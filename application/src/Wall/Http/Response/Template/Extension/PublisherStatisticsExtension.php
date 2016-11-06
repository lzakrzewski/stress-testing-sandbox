<?php

declare(strict_types=1);

namespace Wall\Http\Response\Template\Extension;

use Wall\Application\Query\PublisherStatisticsQuery;

class PublisherStatisticsExtension extends \Twig_Extension
{
    /** @var \Twig_Environment */
    private $twig;

    /** @var PublisherStatisticsQuery */
    private $publisherStatistics;

    public function __construct(PublisherStatisticsQuery $publisherStatistics)
    {
        $this->publisherStatistics = $publisherStatistics;
    }

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->twig = $environment;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('publisherStatistics', [$this, 'publisherStatistics']),
        ];
    }

    public function publisherStatistics(): string
    {
        $publisherStatistics = $this->publisherStatistics->get();

        return $this->twig->render(
            'publisherStatistics.html.twig',
            [
                'publisherStatistics' => $publisherStatistics,
            ]
        );
    }
}
