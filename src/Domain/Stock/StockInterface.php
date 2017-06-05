<?php

namespace MageTitans\Workshop\Domain\Stock;

interface StockInterface
{
    /**
     * @return bool
     */
    public function getInStock();

    /**
     * @return int
     */
    public function getStockLevel();
}