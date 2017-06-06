<?php

namespace MageTitans\Workshop;

use MageTitans\Workshop\Command\Product\Export;
use MageTitans\Workshop\Command\Product\Import;
use MageTitans\Workshop\Domain\Product\ProductRepository;
use MageTitans\Workshop\Service\Product\JsonFilesystemExporter;
use MageTitans\Workshop\Service\Product\JsonFilesystemImporter;
use MageTitans\Workshop\Service\Serializer\Json;
use MageTitans\Workshop\Service\Serializer\ProductDenormalizer;
use Symfony\Component\Console\Application as SymfonyApplication;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Magento\Framework\Console\Cli;
use Magento\Framework\App\ObjectManager;

final class Application extends SymfonyApplication
{
    const APPLICATION_NAME    = 'MageTitans IT Workshop';
    const APPLICATION_VERSION = '1.0.0';

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var Cli
     */
    private $coreCliApp;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct()
    {
        parent::__construct(self::APPLICATION_NAME, self::APPLICATION_VERSION);
        $this->initSerialize();
        $this->initMagento();
        $this->initCommands();
    }

    private function initSerialize()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ProductDenormalizer(), new ObjectNormalizer(), new ArrayDenormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    private function initMagento()
    {
        $projectRootDir = __DIR__ . '/../../../..';
        if (file_exists($projectRootDir . '/app/bootstrap.php')) {
            require $projectRootDir . '/app/bootstrap.php';
        }
        $this->coreCliApp    = new Cli();
        $this->objectManager = ObjectManager::getInstance();
    }

    private function getProductRepository()
    {
        return new ProductRepository(
            $this->objectManager->get(\Magento\Catalog\Api\ProductRepositoryInterface\Proxy::class),
            $this->objectManager->get(\Magento\Framework\Api\SearchCriteriaBuilder::class),
            $this->objectManager->get(\Magento\Catalog\Api\Data\ProductInterface::class)
        );
    }

    private function initCommands()
    {
        $exporter = new JsonFilesystemExporter(
            $this->getProductRepository(),
            new Json($this->serializer),
            new Filesystem()
        );
        $this->add(
            new Export($exporter)
        );
        $importer = new JsonFilesystemImporter(
            $this->getProductRepository(),
            new Json($this->serializer)
        );
        $this->add(
            new Import($importer)
        );
    }
}