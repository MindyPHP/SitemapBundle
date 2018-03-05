<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\SitemapBundle\DependencyInjection\Compiler;

use Mindy\Sitemap\Builder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class SitemapPass implements CompilerPassInterface
{
    const TAG = 'sitemap.provider';

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (false == $container->hasDefinition(Builder::class)) {
            return;
        }

        $definition = $container->getDefinition(Builder::class);
        foreach ($container->findTaggedServiceIds(self::TAG) as $id => $params) {
            $definition->addMethodCall('addProvider', [new Reference($id)]);
        }
    }
}
