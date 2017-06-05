<?php

namespace MageTitans\Workshop\Domain\Product;

use MageTitans\Workshop\Domain\Stock\StockInterface;

class Product implements ProductInterface
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
     * @var StockInterface
     */
    private $stock;

    /**
     * Product constructor.
     *
     * @param string $sku
     * @param string $title
     * @param float $price
     * @param StockInterface $stock
     */
    public function __construct(
        string $sku,
        string $title,
        float $price,
        StockInterface $stock
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
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return StockInterface
     */
    public function getStock()
    {
        return $this->stock;
    }
}