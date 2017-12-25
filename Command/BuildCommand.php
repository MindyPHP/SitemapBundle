<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\SitemapBundle\Command;

use Mindy\Sitemap\Builder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class BuildCommand extends Command
{
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * BuildCommand constructor.
     *
     * @param null    $name
     * @param Builder $builder
     */
    public function __construct($name = null, Builder $builder)
    {
        $this->builder = $builder;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setName('sitemap:build')
            ->addOption('path', '', InputOption::VALUE_REQUIRED, 'Path for save sitemaps', null);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getOption('path');
        if (false == is_dir($path)) {
            throw new \Exception(sprintf('%s isnt directory', $path));
        }

        $sitemaps = $this->builder->build();
        foreach ($sitemaps as $sitemap) {
            $output->writeln($sitemap);
        }
    }
}
