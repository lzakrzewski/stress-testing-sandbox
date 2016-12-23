<?php

declare(strict_types=1);

namespace tests\integration\Wall\Http\Response\Template\Extension;

use tests\integration\IntegrationTestCase;
use Wall\Application\Query\PublisherStatisticsQuery;
use Wall\Application\Query\Result\PublisherStatisticsResult;
use Wall\Http\Response\Template\Extension\PublisherStatisticsExtension;

class PublisherStatisticsExtensionTest extends IntegrationTestCase
{
    /** @var \Twig_Environment */
    private $twig;
    /** @var PublisherStatisticsQuery */
    private $query;
    /** @var PublisherStatisticsExtension */
    private $extension;

    /** @test */
    public function it_can_render_sidebar_html()
    {
        $this->query->get()->willReturn(new PublisherStatisticsResult(1234, 'john@doe.com'));

        $html = $this->extension->publisherStatistics();

        $this->assertContains('1234', $html);
        $this->assertContains('john@doe.com', $html);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->twig      = $this->container()->get(\Twig_Environment::class);
        $this->query     = $this->prophesize(PublisherStatisticsQuery::class);
        $this->extension = new PublisherStatisticsExtension($this->query->reveal());
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
