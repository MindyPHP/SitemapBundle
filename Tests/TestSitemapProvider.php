<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxim
 * Date: 25/12/2017
 * Time: 13:28
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
