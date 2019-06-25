<?php

namespace App;

class OrganisationUnitConfig {

    private $fixedMembershipFee;

    public function __construct(bool $fixedMembershipFee)
    {
        $this->fixedMembershipFee = $fixedMembershipFee;
    }

    public function isFixedMembershipFee(): bool
    {
        return $this->fixedMembershipFee;
    }
}