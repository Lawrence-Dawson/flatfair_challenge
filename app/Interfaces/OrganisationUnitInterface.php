<?php

namespace App\Interfaces;

interface OrganisationUnitInterface
{
    public function getConfig(): ?OrganisationUnitConfigInterface;
    
    public function setParent(OrganisationUnitInterface $parent): ?OrganisationUnitInterface;

    public function getParent(): ?OrganisationUnitInterface;

    public function getName(): String;
}