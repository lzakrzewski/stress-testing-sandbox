<?php

declare(strict_types=1);

namespace Wall\Http\Response\Template\Extension;

use Wall\Application\Query\ClientStatisticsQuery;

class ClientStatisticsExtension extends \Twig_Extension
{
    /** @var \Twig_Environment */
    private $twig;

    /** @var ClientStatisticsQuery */
    private $clientStatistics;

    public function __construct(ClientStatisticsQuery $clientStatistics)
    {
        $this->clientStatistics = $clientStatistics;
    }

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->twig = $environment;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('clientStatistics', [$this, 'clientStatistics']),
        ];
    }

    public function clientStatistics(): string
    {
        $clientStatistics = $this->clientStatistics->get();

        return $this->twig->render(
            'clientStatistics.html.twig',
            [
                'clientStatistics' => $clientStatistics,
            ]
        );
    }
}
