<?php

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\SitemapBundle\Tests;

use Mindy\Sitemap\Builder;
use Mindy\Sitemap\SitemapProviderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Filesystem\Filesystem;

class KernelTest extends KernelTestCase
{
    protected function tearDown()
    {
        (new Filesystem())->remove(__DIR__.'/var');
    }

    protected static function createKernel(array $options = array())
    {
        return new Kernel('dev', true);
    }

    public function testFinders()
    {
        $kernel = $this->createKernel();
        $kernel->boot();

        $container = $kernel->getContainer();
        $builder = $container->get('sitemap.builder');
        $this->assertInstanceOf(Builder::class, $builder);

        $provider = $container->get(TestSitemapProvider::class);
        $this->assertInstanceOf(SitemapProviderInterface::class, $provider);
    }
}
