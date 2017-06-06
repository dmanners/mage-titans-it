<?php

namespace MageTitans\Workshop\Command\Product;

use MageTitans\Workshop\Service\ExporterInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Export extends Command
{
    /** @var ExporterInterface */
    private $exporter;

    /**
     * @param ExporterInterface $exporter
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    public function __construct(ExporterInterface $exporter)
    {
        parent::__construct();

        $this->exporter = $exporter;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('product:export')
            ->setDescription('Export product(s) to JSON format')
            ->addArgument(
                'identifier',
                InputArgument::IS_ARRAY,
                'Which product identifier would you like to export?',
                null
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $identifier = $input->getArgument('identifier');

        $this->exporter->setIdentifier($identifier);
        $this->exporter->execute();
    }
}