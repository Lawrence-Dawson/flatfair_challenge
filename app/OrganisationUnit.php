<?php

namespace App;

use App\OrganisationUnitConfig;

class OrganisationUnit {

    private $config;
    private $name;
    private $parent;

    public function __construct(string $name, OrganisationUnitConfig $config = null)
    {
        $this->config = $config;
        $this->name = $name;
    }

    public function getConfig(): ?OrganisationUnitConfig
    {
        return $this->config;
    }

    public function getName(): String
    {
        return $this->name;
    }

    public function setParent(OrganisationUnit $parent): ?OrganisationUnit
    {
        return $this->parent = $parent;
    }

    public function getParent(): ?OrganisationUnit
    {
        return $this->parent ?? null;
    }
}