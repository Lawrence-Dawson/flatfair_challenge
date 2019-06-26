<?php

namespace App;

use App\OrganisationUnitConfig;
use App\Interfaces\OrganisationUnitInterface;

class OrganisationUnit implements OrganisationUnitInterface {

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
        if ($config = $this->config) {
            return $config;
	    }
	    return $this->getParent()->getConfig();
    }

    public function getName(): String
    {
        return $this->name;
    }

    public function setParent(OrganisationUnit $parent): ?OrganisationUnit
    {
        $this->parent = $parent;
        
        return $parent;
    }

    public function getParent(): ?OrganisationUnit
    {
        return $this->parent ?? null;
    }
}