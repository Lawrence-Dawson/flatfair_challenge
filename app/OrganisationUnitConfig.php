<?php

namespace App;

use App\Interfaces\OrganisationUnitConfigInterface;

class OrganisationUnitConfig implements OrganisationUnitConfigInterface {

    private $isFixedFee;
    private $fixedFee;

    public function __construct($isFixedFee , $fixedFee )
    {
        $this->isFixedFee = $isFixedFee;
        $this->fixedFee = $fixedFee;
    }

    public function isFixedFee(): bool
    {
        return $this->isFixedFee;
    }

    public function getFixedFee(): int
    {
        return $this->fixedFee;
    }
}