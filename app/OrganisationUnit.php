<?php

namespace App;

use App\Interfaces\OrganisationUnitInterface;
use App\Interfaces\OrganisationUnitConfigInterface;

abstract class OrganisationUnit implements OrganisationUnitInterface {

    private $config;
    private $name;
    private $parent;

    public function __construct(string $name, OrganisationUnitConfigInterface $config = null)
    {
        $this->config = $config;
        $this->name = $name;
    }

    public function getConfig(): ?OrganisationUnitConfigInterface
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

    public function setParent(OrganisationUnitInterface $parent): ?OrganisationUnitInterface
    {
        $this->parent = $parent;
        
        return $parent;
    }

    public function getParent(): ?OrganisationUnitInterface
    {
        return $this->parent ?? null;
    }
}