<?php

namespace MageTitans\Workshop\Command\Product;

use MageTitans\Workshop\Service\ImporterInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Import extends Command
{
    /** @var ImporterInterface */
    private $importer;

    /**
     * @param ImporterInterface $importer
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    public function __construct(ImporterInterface $importer)
    {
        parent::__construct();

        $this->importer = $importer;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('product:import')
            ->setDescription('Import product(s) from JSON format');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->importer->execute();
    }
}