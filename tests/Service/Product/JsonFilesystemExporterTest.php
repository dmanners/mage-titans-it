<?php

namespace MageTitans\Workshop\Service\Product;

use MageTitans\Workshop\Domain\Product\ProductRepository;
use MageTitans\Workshop\Service\Serializer\Json;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class JsonFilesystemExporterTest extends TestCase
{
    public function testExecute()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $fs = new Filesystem();
        $jsonFilesystemExporter = new JsonFilesystemExporter(
            new ProductRepository(),
            new Json($serializer),
            $fs
        );
        $jsonFilesystemExporter->setIdentifier([]);
        $jsonFilesystemExporter->execute();
        $this->assertEquals('[{"sku":"sample-product-1","title":"Sample Product1","price":2.3,"stock":{"inStock":true,"stockLevel":120}},{"sku":"sample-product-2","title":"Sample Product2","price":8.25,"stock":{"inStock":false,"stockLevel":0}}]',file_get_contents('products.json'));
    }
}