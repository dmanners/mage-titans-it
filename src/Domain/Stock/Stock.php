<?php

namespace MageTitans\Workshop\Domain\Stock;

final class Stock implements StockInterface
{
    /**
     * @var bool
     */
    private $inStock;

    /**
     * @var int
     */
    private $stockLevel;

    /**
     * Stock constructor.
     *
     * @param bool $inStock
     * @param int $stockLevel
     */
    public function __construct(
        bool $inStock,
        int $stockLevel
    )
    {
        $this->inStock = $inStock;
        $this->stockLevel = $stockLevel;
    }

    /**
     * @return bool
     */
    public function getInStock(): bool
    {
        return $this->inStock;
    }

    /**
     * @return int
     */
    public function getStockLevel(): int
    {
        return $this->stockLevel;
    }
}