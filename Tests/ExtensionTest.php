<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Mindy\Bundle\SitemapBundle\Tests;

use Mindy\Bundle\SitemapBundle\DependencyInjection\Compiler\SitemapPass;
use Mindy\Bundle\SitemapBundle\DependencyInjection\SitemapExtension;
use Mindy\Bundle\SitemapBundle\SitemapBundle;
use Mindy\Sitemap\Builder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class ExtensionTest extends TestCase
{
    public function testConfiguration()
    {
        $ext = new SitemapExtension();
        $parameterBag = new ParameterBag([]);
        $builder = new ContainerBuilder($parameterBag);
        $ext->load([], $builder);
        $this->assertTrue($builder->hasDefinition(Builder::class));
        $definition = $builder->getDefinition(Builder::class);
        $this->assertEquals('https://example.com', $definition->getArgument(0));
        $this->assertEquals('%kernel.project_dir%/public', $definition->getArgument(1));

        $providerDefinition = new Definition(TestSitemapProvider::class);
        $providerDefinition->addTag(SitemapPass::TAG);

        $builder->setDefinition(TestSitemapProvider::class, $providerDefinition);

        $compiler = new SitemapPass();
        $compiler->process($builder);
        $this->assertCount(1, $definition->getMethodCalls());

        $builder = new ContainerBuilder($parameterBag);
        $ext->load([], $builder);
        $compiler = new SitemapPass();
        $compiler->process(new ContainerBuilder());
        $this->assertCount(0, $builder->getDefinition(Builder::class)->getMethodCalls());
    }

    public function testBundle()
    {
        $parameterBag = new ParameterBag([]);
        $builder = new ContainerBuilder($parameterBag);
        $ext = new SitemapExtension();
        $ext->load([], $builder);
        $bundle = new SitemapBundle();
        $bundle->build($builder);
        $definition = $builder->getDefinition(Builder::class);
        $this->assertCount(0, $definition->getMethodCalls());
    }
}
