<?php

namespace App;

class OrganisationUnitConfig {

    private $isFixedFee;

    public function __construct(bool $isFixedFee, $fixedFee)
    {
        $this->isFixedFee = $isFixedFee;
        $this->fixedFee = $fixedFee;
    }

    public function isFixedFee(): bool
    {
        return $this->isFixedFee;
    }

    public function getFixedFee(): bool
    {
        return $this->fixedFee;
    }
}