<?php

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\SitemapBundle\Tests;

use Mindy\Bundle\SitemapBundle\SitemapBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

/**
 * App Test Kernel for functional tests.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class Kernel extends BaseKernel
{
    public function registerBundles()
    {
        return [
            new SitemapBundle()
        ];
    }

    public function getProjectDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return $this->getProjectDir().'/var/cache';
    }

    public function getLogDir()
    {
        return $this->getProjectDir().'/var/logs';
    }

    /**
     * Loads the container configuration.
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        return $loader->load(__DIR__.'/conf.yaml');
    }
}
