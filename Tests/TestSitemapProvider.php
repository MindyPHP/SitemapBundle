<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\SitemapBundle\Tests;

use Mindy\Sitemap\Entity\LocationEntity;
use Mindy\Sitemap\SitemapProviderInterface;

class TestSitemapProvider implements SitemapProviderInterface
{
    /**
     * @param string $hostWithScheme
     *
     * @return \Generator
     */
    public function build($hostWithScheme)
    {
        yield (new LocationEntity())
            ->setLocation('/hello-world.html');
    }
}
