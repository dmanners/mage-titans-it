<?php

namespace MageTitans\Workshop\Domain\Product;

use MageTitans\Workshop\Domain\Stock\Stock;
use Magento\Framework\Exception\NoSuchEntityException;

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

    /**
     * @var \Magento\Catalog\Api\Data\ProductInterface
     */
    private $productFactory;

    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteria,
        \Magento\Catalog\Api\Data\ProductInterface $productFactory
    )
    {
        $this->productRepository = $productRepository;
        $this->searchCriteria = $searchCriteria;
        $this->productFactory = $productFactory;
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
    }

    /**
     * @param ProductInterface $product
     *
     * @return void
     */
    public function save(ProductInterface $product)
    {
        try {
            $productToSave = $this->productRepository->get($product->getSku());
        } catch (NoSuchEntityException $e) {
            $productToSave = $this->productFactory;
        }
        $productToSave->setSku($product->getSku())
            ->setName($product->getTitle())
            ->setPrice($product->getPrice());
        $this->productRepository->save(
            $productToSave
        );
    }
}