<?php

namespace MageTitans\Workshop\Service\Product;

use MageTitans\Workshop\Domain\Product\ProductRepository;
use MageTitans\Workshop\Service\Serializer\Json;
use MageTitans\Workshop\Service\Serializer\ProductDenormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;

class JsonFilesystemImporterTest extends TestCase
{
    public function testExecute()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ProductDenormalizer(), new ObjectNormalizer(), new ArrayDenormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $fs = new Filesystem();
        $jsonFilesystemExporter = new JsonFilesystemImporter(
            new ProductRepository(),
            new Json($serializer),
            $fs
        );
        $jsonFilesystemExporter->execute();
        $this->assertEquals('[{"sku":"sample-product-1","title":"Sample Product1","price":2.3,"stock":{"inStock":true,"stockLevel":120}},{"sku":"sample-product-2","title":"Sample Product2","price":8.25,"stock":{"inStock":false,"stockLevel":0}}]',file_get_contents('products.json'));
    }
}