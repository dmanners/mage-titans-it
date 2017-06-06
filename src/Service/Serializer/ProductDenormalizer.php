<?php

namespace MageTitans\Workshop\Service\Serializer;

use MageTitans\Workshop\Domain\Product\Product;
use MageTitans\Workshop\Domain\Stock\Stock;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ProductDenormalizer extends ObjectNormalizer implements DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === Product::class;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $data['stock'] = parent::denormalize($data['stock'], Stock::class, $format, $context);
        return parent::denormalize($data, $class, $format, $context);
    }
}