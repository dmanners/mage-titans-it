<?php

namespace MageTitans\Workshop\Domain\Product;

use MageTitans\Workshop\Domain\Stock\Stock;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $searchCriteria;

    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteria
    )
    {
        $this->productRepository = $productRepository;
        $this->searchCriteria = $searchCriteria;
    }

    /**
     * @param array $ids
     *
     * @return ProductInterface[]
     */
    public function find(array $ids = [])
    {
        /** @var \Magento\Framework\Api\SearchResults $results */
        $results = $this->productRepository->getList($this->searchCriteria->create());

        $products = [];

        foreach ($results->getItems() as $product) {
            $products[] = new Product(
                $product->getData('sku'),
                $product->getData('name'),
                $product->getData('price'),
                new Stock(
                    true,
                    100
                )
            );
        }
        return $products;

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