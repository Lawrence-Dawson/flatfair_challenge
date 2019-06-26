<?php

namespace App\Interfaces;

interface OrganisationUnitConfigInterface
{
    public function isFixedFee(): ?bool;
    
    public function getFixedFee(): ?int;
}