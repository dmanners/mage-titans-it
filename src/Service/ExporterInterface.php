<?php

namespace MageTitans\Workshop\Service;

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