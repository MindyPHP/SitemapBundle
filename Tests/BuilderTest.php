<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\SitemapBundle\Tests;

use Mindy\Sitemap\Builder;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    public function testBuilder()
    {
        $builder = new Builder('http://example.com', sys_get_temp_dir());
        $builder->addProvider(new TestSitemapProvider());

        $this->assertCount(1, $builder->build());
    }
}
