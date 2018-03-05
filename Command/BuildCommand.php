<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\SitemapBundle\Command;

use Mindy\Sitemap\Builder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class BuildCommand extends Command
{
    protected static $defaultName = 'sitemap:build';

    /**
     * @var Builder
     */
    protected $builder;
    /**
     * @var KernelInterface
     */
    protected $kernel;

    /**
     * BuildCommand constructor.
     *
     * @param null    $name
     * @param Builder $builder
     */
    public function __construct($name = null, Builder $builder, KernelInterface $kernel)
    {
        $this->builder = $builder;
        $this->kernel = $kernel;
        parent::__construct($name);
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @throws \Exception
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sitemaps = $this->builder->build();
        foreach ($sitemaps as $sitemap) {
            $output->writeln($sitemap);
        }
    }
}
