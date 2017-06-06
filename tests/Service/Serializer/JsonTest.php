<?php

namespace MageTitans\Workshop\Service\Serializer;

use MageTitans\Workshop\Domain\Product\Product;
use MageTitans\Workshop\Domain\Stock\Stock;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

final class JsonTest extends TestCase
{
    /**
     * @var Json
     */
    private $jsonSerializer;

    public function setUp()
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $this->jsonSerializer = new Json(
            $serializer
        );
    }

    public function testSerialize()
    {
        $stock = new Stock(
            true,
            120
        );
        $product = new Product(
            'sample-product-1',
            'Sample Product1',
            2.30,
            $stock
        );
        $result = $this->jsonSerializer->serialize($product);
        $json = '{"sku":"sample-product-1","title":"Sample Product1","price":2.3,"stock":{"inStock":true,"stockLevel":120}}';
        $this->assertEquals($json, $result);
    }

    public function testUnserialize()
    {
        $json = '{"sku":"sample-product-1","title":"Sample Product1","price":2.3,"stock":{"inStock":true,"stockLevel":120}}';
        /** @var Product $product */
        $product = $this->jsonSerializer->unserialize($json, Product::class);
        $this->assertEquals('sample-product-1', $product->getSku());
        $this->assertEquals('Sample Product1', $product->getTitle());
        $this->assertEquals(2.3, $product->getPrice());
        $this->assertEquals(true, $product->getStock()->getInStock());
        $this->assertEquals(120, $product->getStock()->getStockLevel());
    }
}