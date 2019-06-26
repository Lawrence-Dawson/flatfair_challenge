<?php

namespace App\Interfaces;

use App\OrganisationUnitConfig;
use App\OrganisationUnit;

interface OrganisationUnitInterface
{
    public function getConfig(): ?OrganisationUnitConfig;
    
    public function setParent(OrganisationUnit $parent): ?OrganisationUnit;

    public function getParent(): ?OrganisationUnit;

    public function getName(): String;
}