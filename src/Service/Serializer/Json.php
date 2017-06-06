<?php

namespace MageTitans\Workshop\Service\Serializer;

use MageTitans\Workshop\Service\SerializerInterface;
use Symfony\Component\Serializer\Serializer;

final class Json implements SerializerInterface
{
    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param object $object
     * @return string
     * @throws \Symfony\Component\Serializer\Exception\UnexpectedValueException
     */
    public function serialize($object)
    {
        return $this->serializer->serialize($object, 'json');
    }

    /**
     * @param string $data
     * @param string $class
     * @return object
     * @throws \Symfony\Component\Serializer\Exception\UnexpectedValueException
     */
    public function unserialize($data, $class)
    {
        return $this->serializer->deserialize($data, $class, 'json');
    }
}