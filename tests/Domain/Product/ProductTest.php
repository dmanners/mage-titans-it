<?php

namespace MageTitans\Workshop\Domain\Product;

use MageTitans\Workshop\Domain\Stock\Stock;
use MageTitans\Workshop\Domain\Stock\StockInterface;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    public function testGetStock()
    {
        $stock = new Stock(
            true,
            100
        );
        $product = new Product(
            'sku',
            'title',
            3.5,
            $stock
        );
        $this->assertInstanceOf(StockInterface::class, $product->getStock());
        $this->assertEquals(true, $product->getStock()->getInStock());
        $this->assertEquals(100, $product->getStock()->getStockLevel());
    }

    /**
     * @dataProvider getSkuProvider
     */
    public function testGetSku($sku, $expectedSku)
    {
        $stock = new Stock(
            true,
            100
        );
        $product = new Product(
            $sku,
            'title',
            3.5,
            $stock
        );
        $this->assertEquals($expectedSku, $product->getSku());
    }

    public function getSkuProvider()
    {
        return [
            [300, 300],
            ['sku', 'sku'],
            ['', '']
        ];
    }

    /**
     * @dataProvider getSkuProvider
     */
    public function testGetTitle($title, $expectedTitle)
    {
        $stock = new Stock(
            true,
            100
        );
        $product = new Product(
            'sku',
            $title,
            3.5,
            $stock
        );
        $this->assertEquals($expectedTitle, $product->getTitle());
    }

    public function getTitleProvider()
    {
        return [
            [300, 300],
            ['Title', 'Title'],
            ['', '']
        ];
    }

    /**
     * @dataProvider getPriceProvider
     */
    public function testGetPrice($price, $expectedPrice)
    {
        $stock = new Stock(
            true,
            100
        );
        $product = new Product(
            'sku',
            'title',
            $price,
            $stock
        );
        $this->assertEquals($expectedPrice, $product->getPrice());
    }

    public function getPriceProvider()
    {
        return [
            [300, 300],
            [123.43, 123.43]
        ];
    }
}