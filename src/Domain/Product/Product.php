<?php

namespace MageTitans\Workshop\Domain\Product;

use MageTitans\Workshop\Domain\Stock\Stock;

final class Product implements ProductInterface
{
    /**
     * @var string
     */
    private $sku;

    /**
     * @var string
     */
    private $title;

    /**
     * @var float
     */
    private $price;

    /**
     * @var Stock
     */
    private $stock;

    /**
     * Product constructor.
     *
     * @param string $sku
     * @param string $title
     * @param float $price
     * @param Stock $stock
     */
    public function __construct(
        string $sku,
        string $title,
        float $price,
        Stock $stock
    )
    {
        $this->sku = $sku;
        $this->title = $title;
        $this->price = $price;
        $this->stock = $stock;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return Stock
     */
    public function getStock(): Stock
    {
        return $this->stock;
    }
}