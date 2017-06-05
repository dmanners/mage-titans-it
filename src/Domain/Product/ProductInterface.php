<?php

namespace MageTitans\Workshop\Domain\Product;

use MageTitans\Workshop\Domain\Stock\StockInterface;

interface ProductInterface
{
    /**
     * @return string
     */
    public function getSku();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return float
     */
    public function getPrice();

    /**
     * @return StockInterface
     */
    public function getStock();
}