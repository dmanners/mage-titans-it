<?php

namespace MageTitans\Workshop\Domain\Stock;

class Stock implements StockInterface
{
    /**
     * @var boolean
     */
    private $inStock;

    /**
     * @var integer
     */
    private $stockLevel;

    /**
     * Stock constructor.
     * 
     * @param bool $inStock
     * @param int $stockLevel
     */
    public function __construct(
        boolean $inStock,
        integer $stockLevel
    )
    {
        $this->inStock = $inStock;
        $this->stockLevel = $stockLevel;
    }

    /**
     * @return boolean
     */
    public function getInStock()
    {
        return $this->inStock;
    }

    /**
     * @return integer
     */
    public function getStockLevel()
    {
        return $this->stockLevel;
    }
}