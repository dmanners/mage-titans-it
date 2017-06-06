<?php

namespace MageTitans\Workshop\Service\Product;

use MageTitans\Workshop\Service\ExporterInterface;
use MageTitans\Workshop\Domain\Product\ProductRepositoryInterface;
use MageTitans\Workshop\Service\SerializerInterface;
use Symfony\Component\Filesystem\Filesystem;

final class JsonFilesystemExporter implements ExporterInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var SerializerInterface
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
        SerializerInterface $serializer,
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

    /**
     * @throws \Symfony\Component\Filesystem\Exception\IOException
     */
    public function execute()
    {
        $data = $this->productRepository->find($this->identifier);
        $jsonContent = $this->serializer->serialize($data);
        $this->filesystem->dumpFile($this->filename, $jsonContent);
    }
}