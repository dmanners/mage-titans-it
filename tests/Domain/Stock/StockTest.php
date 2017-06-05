<?php

namespace MageTitans\Workshop\Domain\Stock;

use PHPUnit\Framework\TestCase;

final class StockTest extends TestCase
{
    public function testGetInStock()
    {
        $stock = new Stock(
            false,
            0
        );
        $this->assertFalse($stock->getInStock());
    }
}