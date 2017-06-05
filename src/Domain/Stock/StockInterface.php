<?php

namespace MageTitans\Workshop\Domain\Stock;

interface StockInterface
{
    /**
     * @return boolean
     */
    public function getInStock();

    /**
     * @return integer
     */
    public function getStockLevel();
}