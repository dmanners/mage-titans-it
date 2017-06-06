<?php

namespace MageTitans\Workshop\Service\Product;

use MageTitans\Workshop\Service\ImporterInterface;
use MageTitans\Workshop\Domain\Product\ProductRepositoryInterface;
use MageTitans\Workshop\Service\SerializerInterface;

final class JsonFilesystemImporter implements ImporterInterface
{
    /** @var string */
    private $filename = 'products.json';

    /** @var ProductRepositoryInterface */
    private $productRepository;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        SerializerInterface $serializer
    )
    {
        $this->productRepository = $productRepository;
        $this->serializer = $serializer;
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pages = $this->serializer->unserialize(file_get_contents($this->filename), 'MageTitans\Workshop\Domain\Product\Product[]');

        foreach ($pages as $page) {
            $this->productRepository->save($page);
        }
    }
}