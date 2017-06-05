<?php

namespace MageTitans\Service;

interface ExporterInterface
{
    /**
     * @param array $identifier
     */
    public function setIdentifier(array $identifier = []);

    /**
     * @return void
     */
    public function execute();
}