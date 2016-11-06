<?php

declare(strict_types=1);

namespace tests\integration\Wall\Http\Response\Template\Extension;

use tests\integration\IntegrationTestCase;
use Wall\Application\Query\ClientStatisticsQuery;
use Wall\Application\Query\PublisherStatisticsQuery;
use Wall\Application\Query\Result\ClientStatisticsResult;
use Wall\Http\Response\Template\Extension\ClientStatisticsExtension;

class ClientStatisticsExtensionTest extends IntegrationTestCase
{
    /** @var \Twig_Environment */
    private $twig;
    /** @var PublisherStatisticsQuery */
    private $query;
    /** @var ClientStatisticsExtension */
    private $extension;

    /** @test */
    public function it_can_render_sidebar_html()
    {
        $this->query->get()->willReturn(new ClientStatisticsResult('Mozilla', 'Mac'));

        $html = $this->extension->clientStatistics();

        $this->assertContains('Mozilla', $html);
        $this->assertContains('Mac', $html);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->twig      = $this->container()->get(\Twig_Environment::class);
        $this->query     = $this->prophesize(ClientStatisticsQuery::class);
        $this->extension = new ClientStatisticsExtension($this->query->reveal());
        $this->extension->initRuntime($this->twig);
    }

    protected function tearDown()
    {
        $this->twig      = null;
        $this->query     = null;
        $this->extension = null;

        parent::tearDown();
    }
}
