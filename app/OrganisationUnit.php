<?php

namespace App;

use App\OrganisationUnitConfig;

class OrganisationUnit {

    private $config;

    public function __construct(OrganisationUnitConfig $config = null)
    {
        $this->config = $config;
    }

    public function getConfig(): ?OrganisationUnitConfig
    {
        return $this->config;
    }
}