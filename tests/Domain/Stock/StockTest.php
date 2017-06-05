<?php

namespace MageTitans\Workshop\Domain\Stock;

use PHPUnit\Framework\TestCase;

final class StockTest extends TestCase
{
    /**
     * @dataProvider getInStockProvider
     */
    public function testGetInStock($inStock, $expectedInStock)
    {
        $stock = new Stock(
            $inStock,
            100
        );
        $this->assertEquals($expectedInStock, $stock->getInStock());
    }

    public function getInStockProvider()
    {
        return [
            [true, true],
            [false, false],
            [1, 1],
            [0, 0]
        ];
    }

    /**
     * @dataProvider getStockLevelProvider
     */
    public function testGetStockLevel($stockLevel, $expectedStockLevel)
    {
        $stock = new Stock(
            true,
            $stockLevel
        );
        $this->assertEquals($expectedStockLevel, $stock->getStockLevel());
    }

    public function getStockLevelProvider()
    {
        return [
            [300, 300],
            [20, 20],
            [0, 0],
            [5, 5]
        ];
    }
}