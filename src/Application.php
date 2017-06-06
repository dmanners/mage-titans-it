<?php

namespace MageTitans\Workshop;

use MageTitans\Workshop\Command\Product\Export;
use MageTitans\Workshop\Domain\Product\ProductRepository;
use MageTitans\Workshop\Service\Product\JsonFilesystemExporter;
use MageTitans\Workshop\Service\Serializer\Json;
use Symfony\Component\Console\Application as SymfonyApplication;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

final class Application extends SymfonyApplication
{
    const APPLICATION_NAME    = 'MageTitans IT Workshop';
    const APPLICATION_VERSION = '1.0.0';

    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct()
    {
        parent::__construct(self::APPLICATION_NAME, self::APPLICATION_VERSION);
        $this->initSerialize();
        $this->initCommands();
    }

    private function initSerialize()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    private function initCommands()
    {
        $exporter = new JsonFilesystemExporter(
            new ProductRepository(),
            new Json($this->serializer),
            new Filesystem()
        );
        $this->add(
            new Export($exporter)
        );
    }
}