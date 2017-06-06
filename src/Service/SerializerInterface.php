<?php

namespace MageTitans\Workshop\Service;

interface SerializerInterface
{
    /**
     * @param object $data
     * @return string
     */
    public function serialize($data);

    /**
     * @param string $data
     * @param string $class
     * @return object
     */
    public function unserialize($data, $class);
}