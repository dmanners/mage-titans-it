<?php

namespace MageTitans\Workshop\Service\Product;

use MageTitans\Workshop\Service\ExporterInterface;
use MageTitans\Workshop\Domain\Product\ProductRepositoryInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Serializer;

final class JsonFilesystemExporter implements ExporterInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var array
     */
    private $identifier;

    /**
     * @var string
     */
    private $filename = 'products.json';

    public function __construct(
        ProductRepositoryInterface $productRepository,
        Serializer $serializer,
        Filesystem $filesystem
    )
    {
        $this->productRepository = $productRepository;
        $this->serializer = $serializer;
        $this->filesystem = $filesystem;
    }

    /**
     * @param array $identifier
     */
    public function setIdentifier(array $identifier = [])
    {
        $this->identifier = $identifier;
    }

    public function execute()
    {
        $data = $this->productRepository->find($this->identifier);
        $jsonContent = $this->serializer->serialize($data, 'json');
        $this->filesystem->dumpFile($this->filename, $jsonContent);
    }
}