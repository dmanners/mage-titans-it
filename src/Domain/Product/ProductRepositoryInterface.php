<?php

namespace MageTitans\Workshop\Domain\Product;

interface ProductRepositoryInterface
{
    /**
     * @param array $ids
     *
     * @return ProductInterface[]
     */
    public function find(array $ids = []);

    /**
     * @param ProductInterface $product
     *
     * @return void
     */
    public function save(ProductInterface $product);
}