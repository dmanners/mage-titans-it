<?php

namespace MageTitans\Workshop\Domain\Product;

use MageTitans\Workshop\Domain\Stock\Stock;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @param array $ids
     *
     * @return ProductInterface[]
     */
    public function find(array $ids = [])
    {
        return [
            new Product(
                'sample-product-1',
                'Sample Product1',
                2.3,
                new Stock(
                    true,
                    120
                )
            ),
            new Product(
                'sample-product-2',
                'Sample Product2',
                8.25,
                new Stock(
                    false,
                    0
                )
            )
        ];
    }

    /**
     * @param ProductInterface $product
     *
     * @return void
     */
    public function save(ProductInterface $product)
    {
        // TODO: Implement save() method.
    }
}